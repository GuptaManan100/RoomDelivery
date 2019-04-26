<?php 
	include "../mysqlConfig.php";
    session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST")
   	{
   		$firstname = mysqli_real_escape_string($db,$_POST['firstname']);
    	$lastname = mysqli_real_escape_string($db,$_POST['lastname']);
    	$num = mysqli_real_escape_string($db,$_POST['contactno']);
    	$address = mysqli_real_escape_string($db,$_POST['address']);
        $enrollmentnumber = mysqli_real_escape_string($db,$_POST['enrollmentnumber']);
        $webmail = mysqli_real_escape_string($db,$_POST['webmail']);
        $dept = mysqli_real_escape_string($db,$_POST['department']);
        $password = mysqli_real_escape_string($db,$_POST['pass']);
        $isStu = 0;
        if(isset($_POST['isStu']))
            $isStu = 1;
    	$sql = "INSERT INTO users VALUES ('$webmail', '$enrollmentnumber','".password_hash($password, PASSWORD_DEFAULT)."','$firstname','$lastname',$num,'$dept', $isStu,'$address');";
    	$query = $db->query($sql);
    	if ($query) {
            $_SESSION['login_user'] = $webmail;
            $_SESSION['enrollnum'] = $enrollmentnumber;
            $_SESSION['department'] = $dept;
            $_SESSION['isStudent'] = $isStu;
    		$_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['phone'] = $num;
            $_SESSION['preferedLocation'] = $address;
            header("Location: ../users/");
        } else {
            $errormsg = "Unable to SignUp!! Incorrect Info Provided";
        }
   	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="form-panel">
            <?php if (isset($errormsg)) {?>
            <div class="alert alert-danger alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <b>Oh snap!</b> </b> <?php echo htmlentities($errormsg); ?>
            </div>
            <?php }?>
            <form class="form-horizontal style-form" method="post" name="profile" >
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="firstname" required="required" class="form-control" >
                    </div>
                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="lastname" required="required" class="form-control" >
                    </div>
                    <label class="col-sm-2 col-sm-2 control-label">Webmail </label>
                    <div class="col-sm-4">
                        <input type="text" name="webmail" required="required" class="form-control">
                    </div>
                    <label class="col-sm-2 col-sm-2 control-label">Enrollment Number </label>
                    <div class="col-sm-4">
                        <input type="number" name="enrollmentnumber" required="required" class="form-control" min = "100000000" max = "999999999">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Contact</label>
                    <div class="col-sm-4">
                        <input type="number" name="contactno" required="required" class="form-control">
                    </div>
                    <label class="col-sm-2 col-sm-2 control-label">Prefered Delivery Location </label>
                    <div class="col-sm-4">
                    	<input type="text" name="address" class="form-control">
                    </div>
                    <label class="col-sm-2 col-sm-2 control-label">Password </label>
                    <div class="col-sm-4">
                        <input type="password" name="pass" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Department </label>
                    <div class="col-sm-4">
                        <select name="department" class="form-control" >
                            <option value="CSE" selected>CSE</option>
                            <option value="EEE">EEE</option>
                            <option value="DD">DD</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                    <label class="col-sm-2 col-sm-2 control-label">Are you a student ? </label>
                        <input type="checkbox" id="isStu" name="isStu" value="1" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10" style="padding-left:25% ">
                        <button type="submit" name="submit" class="btn btn-primary">Sign Up!</button>
                    </div>
                </div>
            </form>
        </div>
	<br>
	<h2><a href = "../login">Back</a></h2>
</body>
</html>