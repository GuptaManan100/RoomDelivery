<?php
   include "../mysqlConfig.php";
   session_start();

   //post method sent from html
   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
   		$webmail = mysqli_real_escape_string($db,$_POST['webmail']);
    	$password = mysqli_real_escape_string($db,$_POST['password']); 

    	$sql = "Select * FROM users WHERE webmail = '$webmail'; ";
    	$result = $db->query($sql);
    	$count = mysqli_num_rows($result);
    	if($count==0)
    	{
    		header("Location: ../login/?Error= Incorrect Username or Password");
    	}
    	while($row = $result->fetch_assoc()) {
    		if (password_verify($password, $row["password"])) 
    		{
         		$_SESSION['login_user'] = $webmail;
            $_SESSION['enrollnum'] = $row["enrollnum"];
            $_SESSION['firstname'] = $row["firstname"];
            $_SESSION['lastname'] = $row["lastname"];
            $_SESSION['phone'] = $row["phone"];
            $_SESSION['department'] = $row["department"];
            $_SESSION['preferedLocation'] = $row["preferedLocation"];
            $_SESSION['isStudent'] = $row["isStudent"];
         		if($webmail=='vendor')
         		{
         			header("Location: ../vendor/");
         		}
         		else
         		{
         			header("Location: ../users/");
         		}
    		}
    		else
    		{
    			header("Location: ../login/?Error= Incorrect Username or Password");
    		}
    	}
   }
?>

<html>
	<head>
		<title>Login Page</title>
	</head>
	<body bgcolor = "#FFFFFF">
		<div align = "center">
			<?php 
				if(isset($_GET['Error']))
				{
					echo "<h2>Incorrect Username or Password</h2>";
				}
			?>
		</div>
		<div align = "center">
			<form action="" method="POST">
				<label>Webmail	:</label><input type="text" name="webmail"/><br><br>
				<label>Password 	:</label><input type="password" name="password"/><br><br>
				<input type="submit" value="Submit"/><br>
			</form>
		</div>
	</body>
</html>