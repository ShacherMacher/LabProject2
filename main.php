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
<div class="header">
        <tr>
            <th><img src="img\flooop.png" height="100" width="100"></th>
            <th><form method="post" action="http://localhost/signup.php">
    <input type="submit" name="SignUpButton" value="Sign Up" class="btn">
</form></th>
       </tr>
</div>
<div class="container">
<table class="iksweb">
	<tbody>
		<tr>
			<th>#</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
</div>

</body>
</html>