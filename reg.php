<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "2 la";
$path = 'public/images/';
$target_file = $path . basename($_FILES["picture"]["name"]);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 // Загрузка файла и вывод сообщения
 if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
 echo 'File not uploaded ';
 else
 echo 'File uploaded ';
}

$conn = new mysqli($servername, $username, $password, $database);
if(!$conn) {
    echo 'Not connected to server!';
}
if(!mysqli_select_db($conn,'2 la')) {
    echo 'Database not selected!';
}
$FName = $_POST['first_name'];
$LName = $_POST['last_name'];
$RSelect = $_POST['role_select'];
$psw = $_POST['psw'];
$pswr = $_POST['rep_password'];
$email = $_POST['email'];
if(strcasecmp($psw, $pswr) != 0)
{
    echo "Password not identical";
    exit();
}
$res = mysqli_query($conn, "SELECT id FROM users WHERE email='$email';");
      if(mysqli_num_rows($res) > 0)
      {
        echo "The email $email is already taken.<br></div>";
        exit();
      }
$sql = "INSERT INTO users (first_name, last_name, email, password, photo, role_id) VALUES ('$FName', '$LName', '$email', '$psw', '$target_file', '$RSelect')";


if(!mysqli_query($conn,$sql))
{
    echo 'Data not inserted';
}
else {
    echo 'Data inserted';
    $_SESSION['password'] = $password;
	$_SESSION['email'] = $email;
    header('Location: main.php');
}

?>