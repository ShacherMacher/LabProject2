<?php
session_start();
// Start the session;
$servername = "localhost";
$username = "root";
$password = "";
$database = "2 la"; 


$conn = new mysqli($servername, $username, $password, $database);

$res = mysqli_query ($conn, "select * from users where email='".$_POST['email']."' and password='".$_POST['password']."'");
$result = mysqli_fetch_array($res);



if (is_array($result)) {

   			 $_SESSION['email'] = $result['email'];
			$_SESSION['password'] = $result['password'];

	header('Location: main.php');
}
else
{
	echo'
	<form action="signup.php" method="post">
       <input type="submit" value="Go to registration" class="btn">
   </form>';
}

?>