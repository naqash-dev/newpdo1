<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "conn.php";
include "function.php";
include "header.php";
include "footer.php";
session_start();
$msg="";
if(isset($_POST['signup'])){
  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['pwd'];
  $cpassword=$_POST['cpwd'];
  $token = bin2hex(random_bytes(15));
  if(isuserexist($email)>0){
  $msg = "Email already Exist Please login";
  }else{
  if($password === $cpassword){
  $pass =password_hash($password,PASSWORD_BCRYPT);
  $data = array("uname"=>$username,
      "email"=>$email,
      "psw"=>$pass,
      "token"=>$token,
      "status"=>'inactive' );                   
  $result = insertuser($data);
  if($result){
  sendmail($email,$token,$username);
  }else{
  $msg="Not Register";}
  }else{
  $msg = "Password is not matched";
  }
 }
}
?>
<div class="container">
<?php echo "<h2>$msg</h2>"; ?>
    <form action="#" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="username" class="form-control" placeholder="Enter Username" name="username">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" placeholder="Enter password" name="pwd">
        </div>
        <div class="form-group">
            <label for="conform_pwd">Conform Password:</label>
            <input type="password" class="form-control" placeholder="Enter Conform password" name="cpwd">
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember me
            </label>
        </div>
        <div class="col-md-4 bg-light">
        <button type="submit" class="btn btn-primary"  name="signup">Sign Up</button>
        </div>
    </form>
    <?php
            if(isset($_SESSION['username'])){
            echo "<h2>Login: ".$_SESSION['username']."</h2><br><br>";
            echo '<a href="logout.php"><button class="btn btn-primary">Logout</button></a>';
            }else{
            echo '<h6 class="col-md-4 bg-light">If you are already Registered then login Now <br><a href="login_form.php"><button class="btn btn-primary">Login</button></a></h6>';
            }
          
    ?>
</div>
 