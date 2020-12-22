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
        <tr>
        
            <th><img src="img\flooop.png" height="100" width="100"></th>
            <th><form method="post" action="http://localhost/signup.php">
    <input type="submit" name="SignUpButton" value="Sign Up" class="btn">
</form></th>
<th>
<form method="post" action="http://localhost/signin.php">
    <input type="submit" name="SignInButton" value="Sign in" class="btn">
</form>
</th>
       </tr>
</div>
<div class="form-div">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "2 la"; 

$conn = new mysqli($servername, $username, $password, $database);

$is_admin = false;
	
	
	if(isset($_SESSION['email']) && isset($_SESSION['password']))	
	{
		echo "You are authorized.<br><br>";
		$result_for_rights = mysqli_query($conn, "SELECT role_id FROM users WHERE email='". $_SESSION['email'] ."';");
		if ($result_for_rights)
		{
			
			while ($row = mysqli_fetch_assoc($result_for_rights))
			{
				if($row['role_id'] == 1)
				{
					$is_admin = true;
				}
			}
			
			mysqli_free_result($result_for_rights);
		}
	}
	else
		echo "You are not authorized.<br><br>";
	
	$sql = ($is_admin) ?
		"SELECT * FROM users" 
		:
		"SELECT id, first_name, last_name, email, role_id FROM users"; 
	
	$res = mysqli_query($conn, $sql);
	if ($res)
	{
		echo "<table cellpadding='7' cellspacing='0' border='2' align='center'>
			<tr style='background-color: #757575'><td>ID</td><td>First name</td><td>Last name</td><td>Email</td>";
		if($is_admin)	echo "<td>Password</td>";
		echo "<td>Role</td></tr>";
		
		$row = mysqli_fetch_array($res);
		$colorVar=1;
		while (is_array($row))
		{
			echo "<tr align='left'".(($colorVar%2==0)?"style='background-color: #d1d1d1'":"").">";

			echo 	"<td align='center'><a style='color: grey; text-decoration: underline;' 
						href='profile.php?id=". $row['id'] ."'>". $row['id'] ."</a></td>
					<td>". $row['first_name'] ."</td>
					<td>". $row['last_name'] ."</td>
					<td>". $row['email'] ."</td>";
			if($is_admin)
				echo "<td>". $row['password'] ."</td>";
			
			$result_role = mysqli_query($conn, "SELECT title FROM roles WHERE id='". $row['id']. "';");
			$row_role = mysqli_fetch_array($result_role);
			if(is_array($row_role))
			{
				echo "<td>".$row_role['title']."</td>";
			}
			else
				echo "<td>Error while accessing the role info</td>";
				
			echo "</tr>";
			$row = mysqli_fetch_array($res);
			
			$colorVar++;
		}
		echo "</table>";
		
		
		mysqli_free_result($res);
	}
	
	if($is_admin==true)
	{
		echo	"<br>
				<form action='signup.php' method='post'>
					<input type='submit' class='btn' value='Add User'>
				</form>";
	}
	if(isset($_SESSION['email']) && isset($_SESSION['password']))
	{
		echo	"<br>
				<form action='logOut.php' method='post'>
					<input type='submit' class='btn' value='Log Out'>
				</form>";
	}

	mysqli_close($conn);
        ?>
</div>
</body>
</html>