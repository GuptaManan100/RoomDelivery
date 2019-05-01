<link href="../users/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="../users/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
<link href="../users/assets/css/style.css" rel="stylesheet" />
<script src="../users/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../users/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<div class="sidebar" data-color="orange" data-image="../users/assets/img/sidebar-5.jpg">
	<div class="sidebar-wrapper">
        <div class="logo">
            <a href="/roomDelivery/vendor/" class="simple-text">
                <?php echo $_SESSION['firstname']?>
            </a>
        </div>

        <ul class="nav">
					<li>
							<a href="/roomDelivery/vendor/pendingOrders.php">
									<p>Pending Orders</p>
							</a>
					</li>

						<li>
                <a href="/roomDelivery/vendor/purchaseList.php">
                    <p>Purchase List</p>
                </a>
            </li>
            <li>
                <a href="/roomDelivery/vendor/orderList.php">
                    <p>Products</p>
                </a>
            </li>
            <li>
                <a href="/roomDelivery/vendor/addOrder.php">
                    <p>Add Product</p>
                </a>
            </li>
						<li>
								<a href="/roomDelivery/vendor/">
										<p>All Orders</p>
								</a>
						</li>
            <li>
                <a href="/roomDelivery/vendor/logout.php">
                    <p>Sign Out</p>
                </a>
            </li>
        </ul>
	</div>
</div>
<div style="width: 100%; height: 7vh; background-color:orange;"></div>
