<?php
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];


if (!empty($email) && !empty($username) && !empty($password) && !empty($gender)){
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "website";
	
	//create connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
	if (mysqli_connect_error()) {
		die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
	} else {
		$SELECT = "SELECT email From register Where email = ? Limit 1"; //So every user has a unique email
		$INSERT = "INSERT Into register (email, username, password, gender) values(?, ?, ?, ?)";
		
		//Prepare Statement
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		
		if ($rnum==0) {
			$stmt->close();
			
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("ssss", $email, $username, $password, $gender); // There are 4 s's because all the variables are strings it would be and i for intager
			$stmt->execute();
			header('Location: Registerpagesuccess.html');
		} else {
			header('Location: Registerpagedeny.html');
		}
		$stmt->close();
		$conn->close();
	}
	
} else{
	echo "All fields are required to be filled out";
	die();
}
 

?>