<?php
   include('sessionuser.php');

   //post method sent from html
   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
    	$password = mysqli_real_escape_string($db,$_POST['password']); 
        $newPassword = mysqli_real_escape_string($db,$_POST['newPassword']); 
    	$sql = "Select * FROM users WHERE webmail = '".$_SESSION['login_user']."'; ";
    	$result = $db->query($sql);
    	$count = mysqli_num_rows($result);
    	while($row = $result->fetch_assoc()) {
    		if (password_verify($password, $row["password"])) 
    		{
                $sql = "UPDATE users SET `password` = '".password_hash($newPassword, PASSWORD_DEFAULT)."' WHERE webmail = '".$_SESSION['login_user']."';";
                echo $sql;
                $query = $db->query($sql);
                if ($query) {
                    header("Location: ../users/");
                } else {
                    $errormsg = "Unable to change Password";
                }
    		}
    		else
    		{
    			$errormsg = "Incorrect Password";
    		}
    	}
   }
?>

<html>
	<head>
		<title>Change Password</title>
	</head>
	<body bgcolor = "#FFFFFF">
        <?php include('dashboard.php'); ?>
    <div class="main-panel" style="padding-top: 5%;">
		<div align = "center">
            <?php if (isset($errormsg)) {?>
            <div class="alert alert-danger alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <b>Oh snap!</b> </b> <?php echo htmlentities($errormsg); ?>
            </div>
            <?php }?>
			<form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Password:</label>
                    <div class="col-sm-4">
                        <input type="password" name="password" required="required" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">New Password:</label>
                    <div class="col-sm-4">
                        <input type="password" name="newPassword" required="required" class="form-control" >
                    </div>
                </div>
				<input type="submit" value="Change Password" class = "btn btn-primary"/><br>
			</form>
		</div>
    </div>
	</body>
</html>