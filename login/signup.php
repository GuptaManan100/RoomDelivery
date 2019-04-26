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
	<title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signupcss.css">
</head>
<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>
                    <form method="POST">
                        <?php if(isset($errormsg))
                        {
                            echo "<div style=\"padding-botton: 10px;\"><p style=\" color: #ed4956;\">$errormsg</p></div>";
                        }
                        ?>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="firstname" required="required">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="lastname" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">webmail</label>
                                    <input class="input--style-4" type="text" name="webmail" required="required">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Enrollment Number</label>
                                    <input class="input--style-4" type="number" name="enrollmentnumber" required="required" class="form-control" min = "100000000" max = "999999999">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Prefered Delivery Location</label>
                                    <input class="input--style-4" type="text" name="address">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="number" name="contactno" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="pass" required="required">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Are you a student ?</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Yes
                                            <input type="checkbox" checked="checked" id="isStu" name="isStu" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">Department</label>
                            <div class="rs-select2 select--no-search">
                                <select name="department">
                                    <option value="CSE" selected>CSE</option>
                                    <option value="EEE">EEE</option>
                                    <option value="DD">DD</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" style="width: 100%;" type="submit">Sign Up!!</button>
                        </div>
                    </form>
                    <div class="p-t-15" align="center">
                        <a class="btn btn--radius-2 btn--blue" style="width: 100%;" href="../login" >Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>