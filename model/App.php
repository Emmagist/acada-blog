<?php

class App{
	private $conn;
	
	function __construct($db) {
		$this->conn = $db;
	}
	
	//function to check if change is made to display error or success
	function checkError(){
		if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
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

	function loop_blog_index(){

		$record_per_page = 6;
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

		$sql = "SELECT * FROM bloglist WHERE deleted='0' AND status='0' ORDER BY date_created desc LIMIT $start, $record_per_page";
		//$sql="SELECT *, bloglist.entity_guid AS tid, bloglist.status AS sta, blog_category.entity_guid AS gid FROM bloglist LEFT JOIN blog_category ON blog_category.entity_guid=bloglist.category WHERE bloglist.deleted='0' ORDER BY bloglist.date_created DESC LIMIT $start, $record_per_page";
		$query = $this->conn->query($sql);
		if($query->num_rows>0){
			$output['bloglist']='';
			while($row = $query->fetch_assoc()){
				//$type = ($row['type']==1) ? 'Individual' : 'Business' ;
				$content = html_entity_decode($row['content']);
			  $output['bloglist']=$output['bloglist'].'

				<div class="col-lg-4 mb-4">
					<div class="entry2 border">
						<a href="single.php?blog='.$row['entity_guid'].'"><img src="'.$row['image'].'" alt="Image" class="img-fluid card-image" style="height:200px; width:370px"></a>
						<div class="excerpt">
					
							<h5 style="color:black"><a href="single.php?blog='.$row['entity_guid'].'" style="color:black">'.$row['title'].'</a></h5>
							<p>'.substr($content, 0, 80).'...</p>
							<div class="post-meta align-items-center text-left clearfix">
								<figure class="author-figure mb-0 mr-3 float-left"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
								<span class="d-inline-block mt-1">By <a style="cursor:pointer">'.$row['author'].'</a></span>
								<span>&nbsp;-&nbsp; '.date('M d, Y', strtotime($row['ddate'])).'</span>
							</div>

						</div>
					</div>
				</div>
			  ';
			}

			$sql = "SELECT * FROM bloglist WHERE deleted='0' AND status='0' ORDER BY date_created DESC";
			$query = $this->conn->query($sql);
			$v_page = $query->num_rows;
			$total_pages = ceil($v_page/$record_per_page);
			for($i = 1; $i <= $total_pages; $i++){
				if(!isset(${$class.$i})){
					${$class.$i}="";
				}
				if ($page==$i) {
					$output['result']=$output['result']."<span class='paginationn ".${'comp'.$i}."' id = '".$i."'>".$i."</span>";
				} else {
					$output['result']=$output['result']."<a href='#' class='paginationn ".${'comp'.$i}."' id = '".$i."'>".$i."</a>";
				}
				
				
			}

		}else{
			$output['bloglist']='';
		}

		echo json_encode($output);
                  
	}

	function loop_blog_search(){
		$searchstring=$_POST['searchstring'];

		$record_per_page = 6;
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

		$sql = "SELECT * FROM bloglist WHERE deleted='0' AND status='0' AND tags LIKE ('%$searchstring%') ORDER BY date_created DESC LIMIT $start, $record_per_page";
		//$sql="SELECT *, bloglist.entity_guid AS tid, bloglist.status AS sta, blog_category.entity_guid AS gid FROM bloglist LEFT JOIN blog_category ON blog_category.entity_guid=bloglist.category WHERE bloglist.deleted='0' ORDER BY bloglist.date_created DESC LIMIT $start, $record_per_page";
		$query = $this->conn->query($sql);
		if($query->num_rows>0){
			$output['bloglist']='';
			while($row = $query->fetch_assoc()){
				//$type = ($row['type']==1) ? 'Individual' : 'Business' ;
				
			  $output['bloglist']=$output['bloglist'].'


				<div class="col-lg-4 mb-4">
				<div class="entry2">
				<a href="single.php?blog='.$row['entity_guid'].'"><img src="'.$row['image'].'" alt="Image" class="img-fluid rounded"></a>
				<div class="excerpt">
				
				<h2><a href="single.php?blog='.$row['entity_guid'].'">'.$row['title'].'</a></h2>
				<div class="post-meta align-items-center text-left clearfix">
				<figure class="author-figure mb-0 mr-3 float-left"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
				<span class="d-inline-block mt-1">By <a href="#">'.$row['author'].'</a></span>
				<span>&nbsp;-&nbsp; '.date('M d, Y', strtotime($row['ddate'])).'</span>
				</div>

				</div>
				</div>
				</div>
			  ';
			}

			$sql = "SELECT * FROM bloglist WHERE deleted='0' AND status='0' AND tags LIKE ('%$searchstring%') ORDER BY date_created DESC";
			$query = $this->conn->query($sql);
			$v_page = $query->num_rows;
			$total_pages = ceil($v_page/$record_per_page);
			for($i = 1; $i <= $total_pages; $i++){
				if(!isset(${$class.$i})){
					${$class.$i}="";
				}
				if ($page==$i) {
					$output['result']=$output['result']."<span class='paginationn ".${'comp'.$i}."' id = '".$i."'>".$i."</span>";
				} else {
					$output['result']=$output['result']."<a href='#' class='paginationn ".${'comp'.$i}."' id = '".$i."'>".$i."</a>";
				}
				
				
			}

		}else{
			$output['bloglist']='No match';
			$output['result']='';
		}

		echo json_encode($output);
                  
	}

	function loop_blog_category($cat){

		$record_per_page = 6;
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

		$sql = "SELECT * FROM bloglist WHERE deleted='0' AND status='0' AND blog_category='$cat' ORDER BY date_created DESC LIMIT $start, $record_per_page";
		$query = $this->conn->query($sql);
		if($query->num_rows>0){
			$output['bloglist']='';
			while($row = $query->fetch_assoc()){
				//$type = ($row['type']==1) ? 'Individual' : 'Business' ;
				
			  $output['bloglist']=$output['bloglist'].'


				<div class="col-lg-4 mb-4">
				<div class="entry2">
				<a href="single.php?blog='.$row['entity_guid'].'"><img src="'.$row['image'].'" alt="Image" class="img-fluid rounded"></a>
				<div class="excerpt">
				
				<h2><a href="single.php?blog='.$row['entity_guid'].'">'.$row['title'].'</a></h2>
				<div class="post-meta align-items-center text-left clearfix">
				<figure class="author-figure mb-0 mr-3 float-left"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
				<span class="d-inline-block mt-1">By <a href="#">'.$row['author'].'</a></span>
				<span>&nbsp;-&nbsp; '.date('M d, Y', strtotime($row['ddate'])).'</span>
				</div>

				</div>
				</div>
				</div>
			  ';
			}

			$sql = "SELECT * FROM bloglist WHERE deleted='0' AND status='0' ORDER BY date_created DESC";
			$query = $this->conn->query($sql);
			$v_page = $query->num_rows;
			$total_pages = ceil($v_page/$record_per_page);
			for($i = 1; $i <= $total_pages; $i++){
				if(!isset(${$class.$i})){
					${$class.$i}="";
				}
				if ($page==$i) {
					$output['result']=$output['result']."<span class='paginationn ".${'comp'.$i}."' id = '".$i."'>".$i."</span>";
				} else {
					$output['result']=$output['result']."<a href='#' class='paginationn ".${'comp'.$i}."' id = '".$i."'>".$i."</a>";
				}
				
				
			}

		}else{
			$output['bloglist']='';
		}

		echo json_encode($output);
                  
	}

	function getBloginfo($id){
		$sql="SELECT * FROM bloglist WHERE bloglist.entity_guid='$id'";
		$query=$this->conn->query($sql);
		$row=$query->fetch_assoc();
		$this->title=$row['title'];
		$this->content=$row['content'];
		$this->author=$row['author'];
		$this->ddate=$row['ddate'];
		$this->tags=$row['tags'];
		$this->image=$row['image'];
		$category=$row['category'];
		$sql="SELECT * FROM blog_category WHERE entity_guid='$category'";
		$query=$this->conn->query($sql);
		$row=$query->fetch_assoc();
		$this->category=$row['name'];
	}
	function addnew(){

		if($this->treat(isset($_POST['action']))){
			$name = $this->treat($_POST['name']);
			$xid=$_SESSION['ustcode'];
			$error=array();

			//
			$sql="SELECT name FROM accounttype";
			$query=$this->conn->query($sql);
			while($row=$query->fetch_assoc()){
				if (strtolower($row['name'])==strtolower($name)) {
					$error['err']="You have Added this account type already";
				}
			}
			if(empty($error)){
				$sql = "INSERT INTO accounttype (entity_guid, name, user_guid) VALUES (uuid(), '$name', '$xid')";
				if($this->conn->query($sql)){
					$_SESSION['success'] = 'Account Type added successfully';
				}
				else{
					$_SESSION['error'] = $this->conn->error;
				}
			}else{
				$_SESSION['error'] = $error['err'];
			}
		}	
		else{
			$_SESSION['error'] = 'Fill up add form first';
		}

		header('location: ../view/accounttype.php');
	}


	function get(){
		$id = $this->treat($_POST['id']);
		$sql = "SELECT * FROM accounttype WHERE `entity_guid`='$id'";
		$query = $this->conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}

	function getCommentNum($blog){
		$id = $this->treat($blog);
		$sql = "SELECT * FROM blog_comment WHERE `blog`='$id'";
		//$row = $query->fetch_assoc();
		$query = $this->conn->query($sql);
		return $query->num_rows;
	}
	function loop_Comments($blog){
                  
		$sql = "SELECT * FROM blog_comment WHERE blog='$blog' AND deleted='0'";
		$query = $this->conn->query($sql);
		while($row = $query->fetch_assoc()){
		  echo '

			<li class="comment">

			<div class="vcard">
			<img src="images/user.png" alt="Image placeholder">
			</div>

			<div class="comment-body">
			<h3>'.$row['name'].'</h3>
			<div class="meta">'.date('M d, Y - h:i:a', strtotime($row['date_created'])).'</div>
			<p>'.$row['text'].'</p>
			<p><span style="cursor: pointer;" id="'.$row['entity_guid'].'" class="reply rounded" onclick="repli(`'.$row['entity_guid'].'`)">Reply</span></p>
			</div>
			'.$this->loop_Replies($row['entity_guid']).'

			</li>
		  ';
		}
                  
	}

	function loop_Replies($comment){
                  
		$sql = "SELECT * FROM blog_comment_reply WHERE comment='$comment' AND deleted='0'";
		$query = $this->conn->query($sql);
		if ($query->num_rows>0) {
			
			$replies='<ul class="children">';
			while($row = $query->fetch_assoc()){
			  $replies=$replies. '
				
				<li class="comment">

				<div class="vcard">
				<img src="images/user.png" alt="Image placeholder">
				</div>
				<div class="comment-body">
				<h3>'.$row['name'].'</h3>
				<div class="meta">'.date('M d, Y - h:i:a', strtotime($row['date_created'])).'</div>
				<p>'.$row['text'].'</p>
				</div>


				</li>
				
			  ';
			}
			$replies=$replies.'ul';
		} else {
			$replies='';
		}
		return $replies;                
	}
	function post_comment(){

	    if($this->treat(isset($_POST['action']))){
	        $blog = $this->treat($_POST['blog']);
	        $name = $this->treat($_POST['name']);
	        $message = $this->treat($_POST['message']);
	        $email = $this->treat($_POST['email']);
	        $error = array();
			$output = array();

			if (empty($email)) {
				// $output = $error['error'] = true;
				$output['error'] = $error['email'] = "This field can not be empty!";
			}

			if (empty($name)) {
				// $output['error'] = true;
				$output['error'] = $error['name'] = "This field can not be empty!";
			}

			if (empty($message)) {
				// $output['error'] = true;
				$output['error'] = $error['message'] = "This field can not be empty!";
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// $output['error'] = true;
				$output['error'] = $error['mail'] = "Ivalid Email Address!";
			}

			if (empty($error)) {

				$sql= "INSERT INTO `blog_comment` SET `name`='$name', `blog`='$blog', `text`='$message', `email`='$email', `entity_guid`=uuid()";
				
				if($this->conn->query($sql)){

				  //$_SESSION['message'] = 'Account Activated. Login again to continue';
				  $output['message'] = 'Comment Posted successfully.';
				}
				else{
				  $output['error'] = true;
				  $output['message'] = $this->conn->error;
				}

			}else{
			//   $output['error'] = true;
			  $output['message'] = $error['error'] = "Fill the required fields properly!";
			  
			}

	    }else{
	    //   $output['error'] = true;
	      $output['error'] = $error['error']= 'Fill the required fields properly!';
	    }
	    echo json_encode($output);
	}

	function post_reply(){

	    if($this->treat(isset($_POST['action']))){
	        $comment = $this->treat($_POST['comment']);
	        $name = $this->treat($_POST['name']);
	        $message = $this->treat($_POST['message']);
	        $email = $this->treat($_POST['email']);
	        $error = array();
			$output = array();

			if (empty($email)) {
				// $output = $error['error'] = true;
				$output['error'] = $error['email'] = "This field can not be empty!";
			}

			if (empty($name)) {
				// $output['error'] = true;
				$output['error'] = $error['name'] = "This field can not be empty!";
			}

			if (empty($message)) {
				// $output['error'] = true;
				$output['error'] = $error['message'] = "This field can not be empty!";
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// $output['error'] = true;
				$output['error'] = $error['mail'] = "Ivalid Email Address!";
			}

			if (empty($error)) {

				$sql= "INSERT INTO `blog_comment_reply` SET `name`='$name', `comment`='$comment', `text`='$message', `email`='$email', `entity_guid`=uuid()";
				
				if($this->conn->query($sql)){

				  //$_SESSION['message'] = 'Account Activated. Login again to continue';
				  $output['message'] = 'Reply Posted successfully.';
				}
				else{
					//   $output['error'] = true;
					$output['error'] = $error['error']= 'Fill the required fields properly!';
				}

			}else{
				//   $output['error'] = true;
				$output['error'] = $error['error']= 'Fill the required fields properly!';
			  
			}

	    }else{
	    	//   $output['error'] = true;
			$output['error'] = $error['error']= 'Fill the required fields properly!';
	    }
	    echo json_encode($output);
	}
	function loop_relatedPosts($blog){
					
		$sql = "SELECT * FROM bloglist WHERE entity_guid!='$blog' AND deleted='0' AND status='0' ORDER BY ddate DESC LIMIT 7";
		$query = $this->conn->query($sql);
		while($row = $query->fetch_assoc()){
			echo '

			<li>
			<a href="single.php?blog='.$row['entity_guid'].'">
			<img src="'.$row['image'].'" alt="Image placeholder" class="mr-4">
			<div class="text">
			<h4>'.$row['title'].'</h4>
			<div class="post-meta">
			<span class="mr-2">'.date('M d, Y', strtotime($row['ddate'])).'</span>
			</div>
			</div>
			</a>
			</li>
			';
		}
					
	}

		// function getDeletedPost(){
			
		// 	return $output;
		// }

}




?>