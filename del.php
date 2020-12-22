<?php
session_start();
// Start the session;
if(isset($_SESSION['delete_user_id']))
{
$servername = "localhost";
$username = "root";
$password = "";
$database = "2 la"; 


$conn = new mysqli($servername, $username, $password, $database);

$sql = "DELETE FROM users WHERE id=". $_SESSION['delete_user_id'];
    
if (mysqli_query($conn, $sql))
		echo "Deleted successfully<br>";
	else
	{
		echo "Error: $sql<br>". mysqli_error($conn);
		exit();
	}
		header('Location: logOut.php');
	
    mysqli_close($conn);
}
else
	echo "Select a user to delete them.<br>";

?>