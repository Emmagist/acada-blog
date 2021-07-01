<?php

class Bloglist{
	private $conn;
	private $table='bloglist';
	
	function __construct($db) {
		$this->conn = $db;
	}

    function treat($data){
      $data=mysqli_real_escape_string($this->conn, trim($data));
      $data=htmlspecialchars($data);
      return $data;
    }
    function treat_file($data){
      $data=str_replace("/", "_", $data);      
      return $data;
    }
    function getStatus($value){
      switch ($value) {
        case '1':
          $options='Disabled';
          break;
        case '0':
          $options='Enabled';
          break;
      }
      return $options;
    }

	function loop_bloglist(){

		$record_per_page = 20;
		$page = "";
		if(ISSET($_POST['page'])){
			$page = $_POST['page'];
			
			${$class . $page}= "active";
		}else{
			$page =  1;
			${$class . $page}= "active";
		}
	
		$start = ($page - 1) * $record_per_page;
		$output['result']='';

		$sql = "SELECT *, bloglist.entity_guid AS tid, bloglist.status AS sta, blog_category.entity_guid AS gid FROM bloglist LEFT JOIN blog_category ON blog_category.entity_guid=bloglist.category WHERE bloglist.deleted='0' ORDER BY bloglist.date_created ASC LIMIT $start, $record_per_page";
		$query = $this->conn->query($sql);
		if($query->num_rows>0){
			$output['bloglist']='';
			while($row = $query->fetch_assoc()){
				
			  $output['bloglist']=$output['bloglist']."
			    <tr>
			      <td>".$row['title']."</td>
			      <td>".$this->getFromblogcat($row['category'])."</td>
			      <td>".$row['author']."</td>
			      <td>".$row['ddate']."</td>
			      <td>".$this->getStatus($row['sta'])."</td>
			      <td>
			        <a href='add_blog?blog=".$row['tid']."' class='btn btn-warning btn-xs btn-flat'><i class='fa fa-edit'></i></a>
			        <a class='btn btn-danger btn-xs btn-flat delete' onclick=delet('".$row['tid']."'); data-id='".$row['tid']."'><i class='fa fa-trash'></i></a>
			      </td>
			    </tr>
			  ";
			}

			$sql = "SELECT *, bloglist.entity_guid AS tid, bloglist.status AS sta, blog_category.entity_guid AS gid FROM bloglist LEFT JOIN blog_category ON blog_category.entity_guid=bloglist.category WHERE bloglist.deleted='0' ORDER BY bloglist.date_created ASC";
			$query = $this->conn->query($sql);
			$v_page = $query->num_rows;
			$total_pages = ceil($v_page/$record_per_page);
			for($i = 1; $i <= $total_pages; $i++){
				if(!isset(${$class.$i})){
					${$class.$i}="";
				}
				$output['result']=$output['result']."<button class='btn btn-info paginationn ".${'comp'.$i}."' type='button' id = '".$i."'>".$i."</button>";
			}

		}else{
			$output['bloglist']='';
		}

		echo json_encode($output);
                  
	}

	function addnew(){

		if($this->treat(isset($_POST['action']))){
			$title =$this->treat($_POST['title']);
			$author =$this->treat($_POST['author']);
			$category =$this->treat($_POST['category']);
			$tags =$this->treat($_POST['tags']);
			$content = $this->treat($_POST['content']);
			$ddate = $this->treat($_POST['ddate']);
			$status = $this->treat($_POST['status']);

			//$cdate=date('Y-m-d');
			$xid=$_SESSION['ustcode'];
			$error=array();

			if (!empty($_FILES["file"]["name"])) {
				if($_FILES["file"]["error"]>0){
					$error['err']="Return Code".$_FILES["file"]["error"]."<br>";
				}else{
					$f=rand(1000,9999);
					if(file_exists(CLIENT_FOLDER2."/blog_attach/".$f.$_FILES["file"]["name"])){
						$error['err']="File already exist";
					}
				}
			}

			if (empty($author)) {
				$error['err']="Author is Required";
			}

			if (empty($content)) {
				$error['err']="content is Required";
			}

			if (empty($ddate)) {
				$error['err']="Date Created is Required";
			}

			if (empty($title)) {
				$error['err']="Title is Required";
			}
			if(empty($error)){

				if (!empty($_FILES["file"]["name"])) {
					$gotten=$_FILES["file"]["tmp_name"];
					//create Folder
					if (!file_exists(CLIENT_FOLDER2.'/blog_attach')) {
					    mkdir(CLIENT_FOLDER2.'/blog_attach', 0777, true);
					}
					$dest=CLIENT_FOLDER2."/blog_attach/".$f.$_FILES["file"]["name"];

					move_uploaded_file($gotten, $dest);
					$sql="INSERT INTO bloglist SET `title`='$title', `author`='$author', `tags`='$tags', `category`='$category', `ddate`='$ddate', `content`='$content', `status`='$status', image='$dest', user_guid='$xid', entity_guid=uuid()";
				}else{
					$sql="INSERT INTO bloglist SET `title`='$title', `author`='$author', `tags`='$tags', `category`='$category', `ddate`='$ddate', `content`='$content', `status`='$status', user_guid='$xid', entity_guid=uuid()";
				}

				if($this->conn->query($sql)){
					$last_id = $this->conn->insert_id;
					if ($last_id!=0) {
						$sql = "SELECT entity_guid FROM bloglist WHERE id='$last_id'";
						$query=$this->conn->query($sql);
						$row=$query->fetch_assoc();
						$output['currid']=$row['entity_guid'];
					}
					$output['message'] = 'Saved successfully';
				}
				else{
					$output['error'] = true;
					$output['message'] = $this->conn->error;
				}
			}else{
				$output['error'] = true;
				$output['message'] = $error['err'];
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Fill up add form first';
		}


		echo json_encode($output);
	}

	function edit(){

		if($this->treat(isset($_POST['action']))){
			$id=$this->treat($_POST['id']);
			$title =$this->treat($_POST['title']);
			$author =$this->treat($_POST['author']);
			$tags =$this->treat($_POST['tags']);
			$category =$this->treat($_POST['category']);
			$content = $this->treat($_POST['content']);
			$ddate = $this->treat($_POST['ddate']);
			$status = $this->treat($_POST['status']);

			//$cdate=date('Y-m-d');
			$xid=$_SESSION['ustcode'];
			$error=array();

			if (!empty($_FILES["file"]["name"])) {
				if($_FILES["file"]["error"]>0){
					$error['err']="Return Code".$_FILES["file"]["error"]."<br>";
				}else{
					$f=rand(1000,9999);
					if(file_exists(CLIENT_FOLDER2."/blog_attach/".$f.$_FILES["file"]["name"])){
						$error['err']="File already exist";
					}
				}
			}

			if (empty($author)) {
				$error['err']="Author is Required";
			}

			if (empty($content)) {
				$error['err']="Content is Required";
			}

			if (empty($ddate)) {
				$error['err']="Date Created is Required";
			}

			if (empty($title)) {
				$error['err']="Title is Required";
			}
			if(empty($error)){

				if (!empty($_FILES["file"]["name"])) {
					$gotten=$_FILES["file"]["tmp_name"];
					//create Folder
					if (!file_exists(CLIENT_FOLDER2.'/blog_attach')) {
					    mkdir(CLIENT_FOLDER2.'/blog_attach', 0777, true);
					}
					$dest=CLIENT_FOLDER2."/blog_attach/".$f.$_FILES["file"]["name"];

					move_uploaded_file($gotten, $dest);
					$sql="UPDATE bloglist SET `title`='$title', `author`='$author', `category`='$category', `tags`='$tags', `ddate`='$ddate', `content`='$content', `image`='$dest', `status`='$status', user_guid='$xid' WHERE entity_guid='$id'";
				}else{
					$sql="UPDATE bloglist SET `title`='$title', `author`='$author', `category`='$category', `tags`='$tags', `ddate`='$ddate', `content`='$content', `status`='$status', user_guid='$xid' WHERE entity_guid='$id'";
				}

				if($this->conn->query($sql)){
					$output['currid']=$id;
					$output['message'] = 'Saved successfully';
				}
				else{
					$output['error'] = true;
					$output['message'] = $this->conn->error;
				}
			}else{
				$output['error'] = true;
				$output['message'] = $error['err'];
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Fill up add form first';
		}


		echo json_encode($output);
	}


	function delete(){
		if($this->treat(isset($_POST['action']))){
			$id = $this->treat($_POST['id']);
			$xid=$_SESSION['ustcode'];
			$error=array();
			$output=array('error'=>false);
			$sql = "UPDATE bloglist SET `deleted`='1', user_guid='$xid' WHERE entity_guid='$id'";
			if($this->conn->query($sql)){
				$output['message'] = 'Deleted successfully';
			}else{
				$output['error'] = true;
				$output['message'] = $this->conn->error;
			}
		}	
		else{
			$output['error'] = true;
			$output['message'] = 'Fill up add form first';
		}

		echo json_encode($output);
	}

	function get(){
		$id = $this->treat($_POST['id']);
		$sql = "SELECT *, bloglist.entity_guid AS tid, bloglist.status AS sta FROM bloglist LEFT JOIN blog_category ON blog_category.entity_guid=bloglist.category WHERE bloglist.entity_guid = '$id'";
		$query = $this->conn->query($sql);
		$row = $query->fetch_assoc();
		extract($row);

		$output=array(
			'tid'=>$tid,
			'title'=>$title,
			'author'=>$author,
			'tags'=>$tags,
			'category'=>$category,
			'ddate'=>$ddate,
			'content'=>html_entity_decode($content),
			'status'=>$sta
		);


    	echo json_encode($output);
	}

	function getEmployees(){

    $sql = "SELECT * FROM employees WHERE deleted='0'";
    $query = $this->conn->query($sql);
    while($srow = $query->fetch_assoc()){
      echo "<option value='".$srow['entity_guid']."'>".$srow['firstname'].' '.$srow['lastname']."</option>";
    }
	}

	function getFromblogcategory(){

    $sql = "SELECT * FROM blog_category WHERE deleted='0'";
    $query = $this->conn->query($sql);
    while($srow = $query->fetch_assoc()){
      echo "<option value='".$srow['entity_guid']."'>".$srow['name']."</option>";
    }
	}

	function getFromblogcat($id){

    $sql = "SELECT * FROM blog_category WHERE entity_guid='$id'";
    $query = $this->conn->query($sql);
		$srow = $query->fetch_assoc();
    return $srow['name'];
	}
}




?>