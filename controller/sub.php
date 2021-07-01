<?php

require_once("../includes/session.php");
confirm_logged_in();

if (isset($_GET['formdata'])) {
	$email = mysqli_real_escape_string($db, $_POST['email']);
	if (!empty($_POST['email'])) {
		$sql = "INSERT INTO sbcribe(email) VALUES('$email')"; var_dump($sql);exit;
		mysqli_query($db, $sql);
		echo json_encode("Subscribed");
	}
}

?>