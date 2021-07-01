<?php
error_reporting(0);
  require_once("../includes/session.php");
  confirm_logged_in();
include_once '../model/blog_category.php';

// $database=new Database();
// $db=$database->connect();
$execute=new Blog_category($db);

if(isset($_POST['action'])) {
	session_start();
	$action=$_POST['action']; 
}else{ 
	$action=0; 
}
if($action==1){
	$execute->addnew();
}
if($action==2){
	$execute->edit();
}
if($action==3){
	$execute->delete();
}
if($action==4){
	$execute->get();
}

?>