<?php 
	include('sessionuser.php');
	if($_SERVER["REQUEST_METHOD"]=="POST")
   	{
   		$firstname = mysqli_real_escape_string($db,$_POST['firstname']);
    	$lastname = mysqli_real_escape_string($db,$_POST['lastname']);
    	$num = mysqli_real_escape_string($db,$_POST['contactno']);
    	$address = mysqli_real_escape_string($db,$_POST['address']);
    	$sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', phone = $num, preferedLocation = '$address' WHERE webmail = '".$_SESSION['login_user']."';";
    	$query = $db->query($sql);
    	if ($query) {
    		$_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['phone'] = $num;
            $_SESSION['preferedLocation'] = $address;
            $successmsg = "Profile Successfully Updated!!";
        } else {
            $errormsg = "Profile not updated !!";
        }
   	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <?php include('dashboard.php'); ?>
    <div class="main-panel" style="padding-top: 5%;">
	<div class="form-panel">
        <?php if (isset($successmsg)) {?>
            <div class="alert alert-success alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
            	<b>Well done!</b> <?php echo htmlentities($successmsg); ?>
            </div>
            <?php }?>
            <?php if (isset($errormsg)) {?>
            <div class="alert alert-danger alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <b>Oh snap!</b> </b> <?php echo htmlentities($errormsg); ?>
            </div>
            <?php }?>
            <form class="form-horizontal " method="post" name="profile" >
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="firstname" required="required" value="<?php echo htmlentities($_SESSION['firstname']); ?>" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="lastname" required="required" value="<?php echo htmlentities($_SESSION['lastname']); ?>" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">User Email </label>
                    <div class="col-sm-4">
                        <input type="email" name="useremail" required="required" value="<?php echo htmlentities($_SESSION['login_user']); ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Department </label>
                    <div class="col-sm-4">
                        <input type="text" name="department" value="<?php echo htmlentities($_SESSION['department']); ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Contact</label>
                    <div class="col-sm-4">
                        <input type="number" name="contactno" required="required" value="<?php echo htmlentities($_SESSION['phone']); ?>" class="form-control">
                    </div>
                </div>
                <div class = "form-group">
                    <label class="col-sm-4 control-label">Prefered Delivery Location </label>
                    <div class="col-sm-4">
                        <input type="text" name="address" value="<?php echo htmlentities($_SESSION['preferedLocation']); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10" style="width: 100%; padding-left: 50%; padding-top: 2%;">
                        <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
	<br>
</div>
</body>
</html>