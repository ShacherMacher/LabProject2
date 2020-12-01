<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "lab2";
$path = 'public\images';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 // Загрузка файла и вывод сообщения
 if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
 echo 'Что-то пошло не так';
 else
 echo 'Загрузка удачна';
}

$conn = new mysqli($servername, $username, $password, $database);
if(!$conn) {
    echo 'Not connected to server!';
}
if(!mysqli_select_db($conn,'lab2')) {
    echo 'Database not selected!';
}
$FName = $_POST['first_name'];
$LName = $_POST['last_name'];
$RSelect = $_POST['role_select'];
$psw = $_POST['psw'];
$sql = "INSERT INTO users (first_name, last_name, password, photo, role_id) VALUES ('$FName', '$LName', '$RSelect', '$path', '$psw')";


if(!mysqli_query($conn,$sql))
{
    echo 'Data not inserted';
}
else {
    echo 'Data inserted';
}

?>