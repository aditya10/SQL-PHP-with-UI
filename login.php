<?php
   include("connect.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT position FROM airport_staff WHERE staff_name like '%$myusername%' and license_num = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         header("location:admin.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
	<head>
        <title>Team 11 - CPSC 304 - Login</title>
        <link rel="stylesheet" href="css/login.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <table>
                    <tr>
                        <td id="title"><h2>Airport Database</h2></td>
                    </tr>
                </table>
            </div>
            <div class="login-form">
            	<h3>Login</h3>
				<br>
				<form action="" method="post">
					<label for="username">Name:</label>
					<input type="text" id="username" name="username">
					<br>
					<br>
					<label for="password">Licence no:</label>
					<input type="password" id="password" name="password">
					<br>
					<br>
					<div id="lower">
						<input type="checkbox"><label class="check" for="checkbox">Administrator login</label>
						<br>
						<br>
						<input type="submit" value="Submit">
					</div><!--/ lower-->
				</form>
				<br>
				<?php
					echo $error;
				?>
			</div>
		</div>
	</body>
</html>