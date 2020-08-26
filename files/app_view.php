<?php
    session_start();

	if(!isset($_SESSION['App_ssn'])){
		header('refresh:0; url=app_IllegalAccess.php');
	}
	else{
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Customer View</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>

	<body>

		<!-- Wrapper -->
		<div id="wrapper">
				
			<!-- Main -->
			<div id="main">
				<div class="inner">
					<header id="header">
						<!-- <a href="index.html" class="logo"><strong>Back to Main Page</strong></a> -->
						<ul class="icons">
								<a href="app_logout.php" class="logo">Logout</a>
						</ul>
					</header>
					<section>
							<div>
								<header class="major"><h2>Instruction</h2></header>
									<div>
										<h3>In this database, you can tab the botton on the left, choose the table you want to view and search.</h3><br />
									</div>
							</div>
					</section>                
				</div>                       
			</div>
			
			<?php
				include 'app_sidebar.php';
			?>

		</div>

	</body>
</html>

<?php
	}
?>