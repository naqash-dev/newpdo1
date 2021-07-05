<?php 
include "conn.php";
include "function.php";
include "header.php";
include "footer.php";
session_start();
$_SESSION['msg']="";

if(isset($_SESSION['username'])){
    echo "<h6>Already Login: ".$_SESSION['username']."</h6>";
    echo '<br><a href="logout.php"><button class="btn btn-primary">Logout</button></a>';
} 

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $getresult=isuserexist($email);
    if($getresult){
        $username=$getresult['username'];
        $token=$getresult['token'];
        sendforgetemail($email,$token,$username);
    }else{
        $_SESSION['msg']="No Email Found";
    }
}


?>
<div class="container">
<?php echo "<h2>".$_SESSION['msg']."</h2>"?>
    <form action="#" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email">
        </div><br>
        <div class="col-md-4 bg-light">
        <button class="btn btn-primary" name="submit">Send Email</button></a></h6>
        </div>
    </form>
</div>
