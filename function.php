<?Php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "conn.php";

function isuserexist($email){
	global $conn;
	$sql = "SELECT * FROM stulogin WHERE email = :email";
	$query = $conn->prepare($sql);
	$query->bindValue(':email',$email);
	$query->execute();
	$row=$query->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function insertuser($data){
	global $conn;
	$sql = "INSERT INTO stulogin (username,email,password,token,status) VALUES (:uname,:email,:psw,:token,:status)";
	$query=$conn->prepare($sql);
	$query->bindValue(':uname',$data['uname']);
	$query->bindValue(':email',$data['email']);
	$query->bindValue(':psw',$data['psw']);
	$query->bindValue(':token',$data['token']);
	$query->bindValue(':status',$data['status']);
    $res=$query->execute();
	return $res;

}


function sendmail($email,$token,$username){
	$subject = "Account activate";
	$body = "Hi, $username Click here to activate your account
	http://localhost/pdo/newpdo1/activate.php?token=$token";
	$headers = "From:alinaqash71@gmail.com";
	if(mail($email, $subject, $body, $headers)){
	// $_SESSION['msg'] ="Check you email to activate Account.";
	header("Location:login_form.php");
	} else {
	$msg= "Email sending failed...";
	}	
}

function accountactivate($data){
	global $conn;
	$sql = "UPDATE stulogin SET status=:status WHERE token=:token";
	$query = $conn->prepare($sql);
	$query->bindValue(':status',$data['status']);
	$query->bindValue(':token',$data['token']);
	$result = $query->execute();
	return($result);
}

function passverify($email){
	global $conn;
	$sql = "SELECT * FROM stulogin WHERE email = :email and status = 'active'";
	$query = $conn->prepare($sql);
	$query->bindValue(':email',$email);
	$query->execute();
	$user = $query->fetch(PDO::FETCH_ASSOC);
	return $user;
}

function sendforgetemail($email,$token,$username){
	$subject = "Forget Password";
	$body ="Hi,$username Click here to reset your password
	http://localhost/pdo/newpdo1/resetpass_form.php?token=$token";
	$header ="alinaqash71@gmail.com";
	if(mail($email,$subject,$body,$header)){
		header("Location:forget_form.php");
	}else{
        // $_SESSION['msg']="Email Sending failed";
		header("Location:forget_form.php");
	}
}

 function updatepassword($token,$password){
	global $conn;
	$sql = "UPDATE stulogin SET password = :upwd WHERE token = :tkn";
	$query = $conn->prepare($sql);
	$query->bindValue(':upwd',$password);
	$query->bindValue(':tkn',$token);
	$result=$query->execute();
	return $result;
}

function sessioncheck($session_user,$session_Password){
		global $conn;
		$sql = "SELECT * FROM stulogin WHERE username = :username and password = :password";
		$query = $conn->prepare($sql);
		$query->bindValue(':username',$session_user);
		$query->bindValue(':password',$session_Password);
		$query->execute();
		$user = $query->fetch(PDO::FETCH_ASSOC);
		return $user;
}
?>