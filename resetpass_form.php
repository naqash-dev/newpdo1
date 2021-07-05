<?php
include "conn.php";
include "function.php";
include "header.php";
include "footer.php";
session_start();
 
 

if(isset($_SESSION['username'])){
    echo "<h6>Already Login: ".$_SESSION['username']."</h6>";
    echo '<br><a href="logout.php"><button class="btn btn-primary">Logout</button></a>';
} 

if(isset($_POST['update_pass'])){
    if($_GET['token']){
        $token =$_GET['token'];
        $new_pass = $_POST['npassword'];
        $confirm_pass=$_POST['upassword'];
        if($new_pass === $confirm_pass){
            $password =password_hash($new_pass,PASSWORD_BCRYPT);
            $res = updatepassword($token,$password);
            if($res){
                echo "your password has been updated you can login Now";
                header("Location:login_form.php");
            }else{
                 echo "Sorry Password updated Unseccessful";
                 header("Location:resetpass_form.php");
            }
            
        }else{
                 echo "Sorry your password is not match please put again";
        }

    }else{
          echo "No Token found";
    }

}
 

?>
<div class="container">
    <form action="#" method="post">
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" class="form-control" placeholder="Enter New Password" name="npassword">
        </div>
        <div class="form-group">
            <label for="password">Confirm Password:</label>
            <input type="password" class="form-control" placeholder="Enter confirm password" name="upassword">
        </div><br>
        <div class="col-md-4 bg-light">
        <button class="btn btn-primary" name="update_pass">Update</button></a></h6>
        </div>
    </form>
</div>