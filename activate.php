<?php
include "conn.php";
include "function.php";
session_start();
if(isset($_SESSION['username'])){
	echo "<h2>Already login: ".$_SESSION['username']."</h2>";
	echo '<br><a href = "logout.php">Logout</a>';
}

if(isset($_GET['token'])){
	$token = $_GET['token'];
	$data = array("token"=>$token,
                  "status"=>'active'
                  );
	$res = accountactivate($data);
	if($res){
		$_SESSION['msg'] = "Account activated succeesfully";
		header("Location:login_form.php");
	}else{
		$_SESSION['msg'] = "Account activated unseccussful";
		header("Location:signup_form.php");
	}
}
?>