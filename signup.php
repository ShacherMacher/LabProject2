<?php
    session_start();
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
   <style>
       .container {
           width: 300px;
       }
       .header{
           height: 100px; 
           margin: 50px;
           margin-top: 10px;
       }
   </style>
</head>
<body>
<div class="header">
       <img src="img\flooop.png" height="100" width="100">
</div>
<div class="container">
        <div class="input-field col s12">
       <form action="reg.php" method="post" enctype="multipart/form-data">
       First Name: <input type="text" name="first_name" required="required"><br>
       Last Name: <input type="text" name="last_name" required="required"><br>
       Role: 
       <select class="browser-default" name="role_select" required="required">
    <option value="" disabled selected>Choose your role</option>
    <option value="1">Admin</option>
    <option value="2">User</option>
  </select>
      <br>
      <input type="file" name="picture" required="required">
       Password: <input type="password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required"><br>
       Repeat Password: <input type="password" name="rep_password" required="required"><br>
       <input type="submit" class="btn">
       </form>
       </div>
</div>
</body>
</html>