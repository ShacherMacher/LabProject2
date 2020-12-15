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
           width: 600px;
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
        <form action="auth.php" method="post">
            Email: <input type="email" name="email" required="required"><br>
            Password: <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"><br>
            <input type="submit" class="btn">
        </form>
       </div>
</div>

</body>
</html>