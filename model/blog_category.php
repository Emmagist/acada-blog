<?php

class Blog_category{
	private $conn;
	private $table='blog_category';
	
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

	function loop_blog_category(){
                  
		$sql = "SELECT * FROM $this->table WHERE deleted='0'";
		$query = $this->conn->query($sql);
		while($row = $query->fetch_assoc()){
		  echo "
		    <tr>
		      <td class='hidden'></td>
		      <td>".$row['name']."</td>
		      <td>
		        <button class='btn btn-warning btn-xs btn-flat edit' data-id='".$row['entity_guid']."'><i class='fa fa-edit'></i> Edit
		        </button>
		        <button class='btn btn-danger btn-xs btn-flat delete' data-id='".$row['entity_guid']."'><i class='fa fa-trash'></i> Delete</button>
		      </td>
		    </tr>
		  ";
		}
                  
	}

	function loopCategoryDelete(){
                  
		$sql = "SELECT * FROM $this->table WHERE deleted='1'";
		$query = $this->conn->query($sql);
		$row = mysqli_num_rows($query);

		if ($row > 0) {
			while($row = $query->fetch_assoc()){
				echo "
					<tr>
					<td class='hidden'></td>
					<td>".$row['name']."</td>
					<td>
						<button class='btn btn-success btn-xs btn-flat deletedEntity' data-id='".$row['entity_guid']."'> Enable
						</button>
					</td>
					</tr>
				";
			}
		}else {
			echo "<p style='color:pink;font-size:20;font-weight:bold;position:absolute;margin-top:50px;'>No Deleted Category!</p>";
		}
                  
	}

	function deletedCatButton(){
		$sql = "SELECT * FROM $this->table WHERE deleted='1'";
		$query = $this->conn->query($sql);
		$row = mysqli_num_rows($query);
		if ($row > 1) {
			echo '<a href="cat-deleted" class="btn btn-danger btn-sm btn-flat">Deleted Categories</a>';
		}elseif ($row == 1) {
			echo '<a href="cat-deleted" class="btn btn-danger btn-sm btn-flat">Deleted Category</a>';
		}elseif ($row < 1) {
			echo '';
		}
		
	}

	function addnew(){

		if($this->treat(isset($_POST['action']))){
			$name = $this->treat($_POST['name']);
			$xid=$_SESSION['ustcode'];
			$error=array();

			//
			$sql="SELECT name FROM $this->table";
			$query=$this->conn->query($sql);
			while($row=$query->fetch_assoc()){
				if (strtolower($row['name'])==strtolower($name)) {
					$error['err']="You have Added this Category already";
				}
			}
			if(empty($error)){
				$sql = "INSERT INTO $this->table (entity_guid, name, user_guid) VALUES (uuid(), '$name', '$xid')";
				if($this->conn->query($sql)){
					$_SESSION['success'] = 'Category added successfully';
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

		header('location: ../view/blog-category.php');
	}


	function edit(){

		if($this->treat(isset($_POST['action']))){
			$id=$this->treat($_POST['id']);
			$name = $this->treat($_POST['name']);
			$xid=$_SESSION['ustcode'];
			$sql="SELECT name FROM $this->table";
			$query=$this->conn->query($sql);
			while($row=$query->fetch_assoc()){
				if (strtolower($row['name'])==strtolower($name)) {
					$error['err']="You have Added this Category already";
				}
			}

			if(empty($error)){
				$sql = "UPDATE $this->table SET `name` = '$name', user_guid='$xid' WHERE entity_guid = '$id'";
				if($this->conn->query($sql)){
					$_SESSION['success'] = 'Category updated successfully';
				}
				else{
					$_SESSION['error'] = $this->conn->error;
				}
			}else{
				$_SESSION['error']=$error['err'];
			}
		}	
		else{
			$_SESSION['error'] = 'Fill up add form first';
		}

		header('location: ../view/blog-category.php');
	}

	function delete(){
		if($this->treat(isset($_POST['action']))){
			$id = $this->treat($_POST['id']);
			$xid=$_SESSION['ustcode'];
			$sql = "UPDATE $this->table SET `deleted`='1', user_guid='$xid' WHERE entity_guid='$id'";
			if($this->conn->query($sql)){
				$_SESSION['success'] = 'Category deleted successfully';
			}
			else{
				$_SESSION['error'] = $this->conn->error;
			}
		}
		else{
			$_SESSION['error'] = 'Select item to delete first';
		}

		header('location: ../view/blog-category.php');
	}

	function get(){
		$id = $this->treat($_POST['id']);
		$sql = "SELECT * FROM $this->table WHERE `entity_guid`='$id'";
		$query = $this->conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}

}




?>