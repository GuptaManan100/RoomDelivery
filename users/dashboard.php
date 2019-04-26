<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
<link href="assets/css/style.css" rel="stylesheet" />
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
	<div class="sidebar-wrapper">
        <div class="logo">
            <a href="/roomDelivery/users/" class="simple-text">
                <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'] ?>
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="/roomDelivery/users/">
                    <p>User Profile</p>
                </a>
            </li>
            <li>
                <a href="/roomDelivery/users/placeorder.php">
                    <p>Place Order</p>
                </a>
            </li>
            <li>
                <a href="/roomDelivery/users/changepassword.php">
                    <p>Change Password</p>
                </a>
            </li>
            <li>
                <a href="/roomDelivery/users/logout.php">
                    <p>Sign Out</p>
                </a>
            </li>
        </ul>
	</div>
</div>
<div style="width: 100%; height: 7vh; background-color:#9400D3;"></div>
