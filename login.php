<?php
$username = $_POST['username'];
$password = $_POST['password'];
	
//Database connection
$con = new mysqli("localhost","root","","website");
if($con->connect_error){
	die("Failed to connect : ".$con->connect_error);
}else{
	$stmt = $con->prepare("select * from register where username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	if($stmt_result->num_rows > 0) {
		$data = $stmt_result->fetch_assoc();
		if($data['password'] === $password){
			header('Location: homepage.html');
		}else{
			header('Location: Loginpagedeny.html');
		}
	} else{
		header('Location: Loginpagedeny.html');
	}
}
?>