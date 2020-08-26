<?php
    session_start();

	if(!isset($_SESSION['Ee_id'])){
		header('refresh:0; url=emp_IllegalAccess.php');
	}
	else{
?>
		<!DOCTYPE HTML>
		<html>

			<head>
				<title>Employee Edit</title>
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
										<a href="emp_logout.php" class="logo">Logout</a>
								</ul>
							</header>
							<section>
									<div>
										<header class="major"><h2>Instruction</h2></header>
											<div>
												<h3>In this database, you can tab the botton on the left, choose the table you want to edit.</h3><br />
												<h3>You can insert,delete or search the information from the tables.</h3>
											</div>
										</div>
							</section>                
						</div>                       
					</div>

					<?php 
						include 'emp_sidebar.php'
					?>				
				</div>

			</body>

		</html>
		
<?php
	}
?>