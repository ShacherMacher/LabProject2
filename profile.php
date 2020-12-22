<?php session_start(); ?>
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
        table.iksweb{
            text-decoration: none;
            border-collapse:collapse;
            width:100%;
            text-align:center;
        }
	    table.iksweb th{
            font-weight:normal;
            font-size:21px; 
            color:#ffffff;
            background-color:#4a4a4a;
            }
	    table.iksweb td{
            font-size:18px;
            color:#000000;
            }
	    table.iksweb td,table.iksweb th{
            white-space:pre-wrap;
            padding:27px 5px;
            line-height:18px;
            vertical-align: middle;
            border: 1px solid #000000;
            }	
            table.iksweb tr:hover{
                background-color:#f9fafb
                }
	    table.iksweb tr:hover td{
            color:#2a7539;
            cursor:default;
            }
   </style>
</head>
<body>
<div class="top-content">
</div>
<div class="form-div">
<?php
if(isset($_GET['id']))
{
$servername = "localhost";
$username = "root";
$password = "";
$database = "2 la";
$userType = 0; 

$conn = new mysqli($servername, $username, $password, $database);

$is_admin = false;
	
	
	if(isset($_SESSION['email']) && isset($_SESSION['password']))	
	{
        echo "You are authorized.<br><br>";
        $userType = 1;
		$result_for_rights = mysqli_query($conn, "SELECT role_id FROM users WHERE email='". $_SESSION['email'] ."';");
		if ($result_for_rights)
		{
			
			while ($row = mysqli_fetch_assoc($result_for_rights))
			{
				if($row['role_id'] == 1)
				{
                    $is_admin = true;
                    $userType = 2;
				}
			}
			
			mysqli_free_result($result_for_rights);
		}
	}
	else
		echo "You are not authorized.<br><br>";
		if($userType == 2 || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']))
		$sql = "SELECT * FROM users WHERE id='". $_GET['id'] ."';";
	else
		$sql = "SELECT id, first_name, last_name, email, photo, role_id FROM users WHERE id='". $_GET['id'] ."';"; // остальные НЕ получают пароль
	
	$res = mysqli_query($conn, $sql);
	if ($res)
	{
		$row = mysqli_fetch_array($res);
		if(is_array($row))
		{
			echo 	"You are viewing user profile ID: ". $row['id'] ."<br><br><br>";
			
			
					
			echo	"<img src='".$row['photo']."' style='max-width: 300px;' alt='User hasn`t unloaded an image yet'><br>
					<form action='ed.php' method='post' id='reg-form' enctype='multipart/form-data'>";
			
				if($userType == 2 || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']))
					echo "<input type='file' name='fileToUpload' id='fileToUpload' value='Upload photo' class='btn' style='text-align: center;'>";
			
			
				echo	"<br><br>
						<input type='text' name='firstname' placeholder='First name' value='". $row['first_name'] ."' ".
							(($userType == 2 || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']))?"required":"disabled") ."><br>
						<input type='text' name='lastname' placeholder='Last name' value='". $row['last_name'] ."' ".
							(($userType == 2 || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']))?"required":"disabled") ."><br>
						<input type='email' name='email' placeholder='Email' value='". $row['email'] ."' disabled><br>";
						if($userType==2) // админ может менять роль
						{
							echo "<select class='form-fields' name='role' required>
								<option value=''>Select role</option>
								<optgroup label='Select role'>";
							
							$result_role = mysqli_query($conn, "SELECT * FROM roles;");
							$row_role = mysqli_fetch_array($result_role);
							while(is_array($row_role))
							{
								// вывод ролей
								echo "<option value='".$row_role['id']."' ". ($row_role['id']== $row['role_id']? "selected" : "") .">". $row_role['title'] ."</option>";
								$row_role = mysqli_fetch_array($result_role);
							}
							echo	"</select><br>";
						}
						else 
						{
							$result_role = mysqli_query($conn, "SELECT title FROM roles WHERE id=".$row['role_id'].";");
							$row_role = mysqli_fetch_array($result_role);
							if(is_array($row_role))
								echo "<input type='text' value='". $row_role['title'] ."' disabled><br>";
							else
								echo "<input type='text' value='Sorry. Error :(' disabled><br>";
						}
						
						
					if($userType == 2 || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']))
					{
						echo	"<input type='password' name='password' placeholder='Password' value='". $row['password'] ."' required><br>
								<input type='password' name='password2' placeholder='Repeat password' value='". $row['password'] ."' required><br>
								<input type='submit' class='btn' value='Edit'>";
					}
					echo "</form>";
					
					if($userType == 2 || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']))
					{
						echo 	"<form action='del.php' method='post' id='reg-form'>
									<input type='submit' class='btn' value='Delete'>
								</form>";
						$_SESSION['delete_user_id'] = $_GET['id'];
					}
					
			$_SESSION['edit_user_id'] = $_GET['id'];
			
		}
		
		mysqli_free_result($res);
	}
	
	if(isset($_SESSION['email']) && isset($_SESSION['password']))
	{
		echo	"<br>
				<form action='logOut.php' method='post'>
					<input type='submit' class='btn' value='Log Out'>
				</form>";
	}

    mysqli_close($conn);
}
        ?>
</div>
</body>
</html>