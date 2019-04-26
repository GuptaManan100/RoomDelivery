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
            $errormsg = "Incorrect Username or Password";
    		//header("Location: ../login/?Error= Incorrect Username or Password");
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
                $errormsg = "Incorrect Username or Password";
                //header("Location: ../login/?Error= Incorrect Username or Password");
    		}
    	}
   }
?>

<html>
	<head>
		<title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="loginutil.css">
	</head>
	<body bgcolor = "#FFFFFF">
        <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form" action="" method="POST">
                    <span class="login100-form-title p-b-49">
                        Login
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                        <span class="label-input100">Webmail</span>
                        <input class="input100" type="text" name="webmail" placeholder="Type your webmail">
                        <span class="focus-input100" data-symbol="&#9832;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#9763;"></span>
                    </div>
                    <?php 
                        if(isset($errormsg))
                        {
                            echo "<div style=\"padding-top: 5px; padding-left: 10px;\"><p style=\" color: #ed4956;\">Sorry, your password was incorrect.</p></div>";
                        }
                    ?>
                                        
                    <div class="container-login100-form-btn p-t-155">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex-col-c p-t-65">
                        <span class="txt1 p-b-17">
                            Or Sign Up Using
                        </span>

                        <a href="/roomDelivery/login/signup.php" class="txt2">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
	</body>
</html>