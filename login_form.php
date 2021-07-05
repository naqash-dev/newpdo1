<?php 
include "conn.php";
include "function.php";
include "header.php";
include "footer.php";
session_start();
$_SESSION['msg']="";
if(isset($_SESSION['username'])){
    echo "<h2>Already Login:".$_SESSION['username']."</h2>";
    echo '<br><a href="logout.php"><button class="btn btn-primary">Logout</button></a>'; 
} 
if(isset($_POST['login']))
{
  $email = $_POST['email'];
  $pass = $_POST['pwd'];
  $data = passverify($email); 
  if($data === false){
    $_SESSION['msg']="Incorrect email";
  }else{
    $validpassword = password_verify($pass, $data['password']);
    if($validpassword){
    $_SESSION['user_id']=$data['id'];
    $_SESSION['username']=$data['username'];
    $_SESSION['password']=$data['password'];
    header("location:welcome.php");
    }else{
    $_SESSION['msg']="Incorrect Email password";
    }
 }
}
?>
<div class="container">
<?php echo "<h2>".$_SESSION['msg']."</h2>"?>
    <form action="#" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" placeholder="Enter password" name="pwd">
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember me
            </label>
        </div>
        <div class="col-md-4 bg-light">
        <button type="submit" class="btn btn-primary" name="login">Log In</button><br>
        </div>
        </form>
       <div>
        <h6 class="col-md-4 bg-light">Forget Password<br><a href="forget_form.php"><button class="btn btn-primary">Click Here</button></a></h>
       </div>
    
</div>
