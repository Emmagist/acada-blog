<?php
//error_reporting(0);
require_once("../includes/session.php");
confirm_logged_in();
//include_once '../config/Database.php';
include_once '../model/blog_list.php';

$bloglist=new Bloglist($db);

//$_POST['action']=29;
//$_POST['id']='eba18bb5-0226-11ea-a1ad-84349797f683';
if(isset($_POST['action'])) {
	$action=$_POST['action']; 
}else{ 
	$action=0; 
}

if($action==25){
	$bloglist->loop_bloglist();
}

if($action==20){
	$bloglist->addnew();
}

if($action==21){
	$bloglist->edit();
}
if($action==22){
	$bloglist->delete();
}
if($action==23){
	$bloglist->get();
}

if (isset($_GET['data'])) {
	$data = $_GET['data'];
	
	$sql = "UPDATE `bloglist` SET deleted= '0' WHERE entity_guid = '$data'";
	mysqli_query($db, $sql);
	echo json_encode("Blog Enabled Successfully...");
}

if (isset($_GET['cat_data'])) {
	$cat_data = $_GET['cat_data'];

	$sql = "UPDATE `blog_category` SET deleted= '0' WHERE entity_guid = '$cat_data'";
	mysqli_query($db, $sql);
	echo json_encode("Category Enabled Successfully...");
}

if (isset($_GET['formdata'])) {
	echo $_POST['email']; exit;
	echo $email = mysqli_real_escape_string($db, $_POST['email']);exit;
	if (!empty($_POST['email'])) {
		$sql = "INSERT INTO sbcribe(email) VALUES('$email')"; var_dump($sql);exit;
		mysqli_query($db, $sql);
		echo json_encode("Subscribed");
	}
}

?>