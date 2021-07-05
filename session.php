<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "function.php";
session_start();
if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
       $session_user =$_SESSION['username'];
       $session_Password = $_SESSION['password'];
       $data = sessioncheck($session_user,$session_Password);
       if($session_Password === $data['password']){
       echo "<h2>Login: ".$_SESSION['username']."</h2><br><br>";
       echo '<a href="logout.php"><button class="btn btn-primary">Logout</button></a>';
       }
      
    }else{
      header("Location:login_form.php");
}

?> 