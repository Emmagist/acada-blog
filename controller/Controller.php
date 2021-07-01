<?php
error_reporting(0);
require_once("../includes/session.php");
include_once '../model/App.php';

$execute=new App($db);
//$_POST['action']=25;
if(isset($_POST['action'])) {
	session_start();
	$action=$_POST['action']; 
}else{ 
	$action=0; 
}

if($action==25){
	$execute->loop_blog_index();
}
if($action==255){
	$cat='d2a31618-15b4-11ea-a81f-84349797f683';
	$execute->loop_blog_category($cat);
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
if($action==200){
  $execute->post_comment();
}
if($action==201){
  $execute->post_reply();
}
if($action==257){
	$execute->loop_blog_search();
}
?>