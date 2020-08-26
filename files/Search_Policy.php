<?php
    session_start();

	if(!isset($_SESSION['Ee_id'])){
		//echo('Please Login first.');
		header('refresh:0; url=emp_IllegalAccess.php');
	}
	else{
?>
			<!DOCTYPE HTML>
			<html>
				<head>
					<title>Search Policy</title>
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
								<!-- Header -->
								<header id="header">
									<a href="emp_edit.php" class="logo"><strong>Back</strong></a>
									<ul class="icons">
									</ul>
								</header>
								
								<?php
								// 定义变量并默认为为空值
								$Policy_no_err = "";
								$pass = 0; // init pass to 0;
								
								function test_input($data)
								{
									$data = trim($data);
									$data = stripslashes($data);
									$data = htmlspecialchars($data);
									return $data;
								}
								
								$Policy_no = test_input($_POST["Policy_no"]);

								if ($_SERVER["REQUEST_METHOD"] == "POST")
								{
									// Policy_no检验
									if (empty($_POST["Policy_no"])|!preg_match("/^[0-9]*$/",$Policy_no)|(strlen($Policy_no) != 9))
									{
										$Policy_no_err = "Invalid Policy Number";
									}else{
										$pass += 1;
									}
								}
								?>

								<!-- <h2>Select Your Table and Command</h2>  -->    
								<section id="main page1">
										<h2>Search Policy</h2>
										<p><span class="error">* Required</span></p>
										<form method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
											<div class="row uniform">
												<div class="6u$ 12u$(xsmall)">
														<h4>Policy Number</h4>
														<input type="text" name="Policy_no"  value="<?php echo $Policy_no;?>" placeholder="123456789" required /> 
														<span class="error">* <?php echo $Policy_no_err;?></span><br /><br />
														<input type="submit">
												</div>
											</div>
										</form>                      
								</section>
									
									<?php
										// connect database
										require_once('db_setup.php');
										$sql = "USE szhang85_1;";
										if ($conn->query($sql) === TRUE) {
										//echo "using Database szhang85_1";
										} else {
										echo "Error using database: " . $conn->error;
										}
										
										// // Query:
										// $sql = "SELECT * FROM Policy;";
										// $result2 = $conn->query($sql);
										// $result = $result2;

										if ($pass == 1)
										{
											$sql = "SELECT * FROM Policy WHERE Policy_no = '$Policy_no';";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												//echo "Record deleted successfully";
												// $result = $result1;
												include 'form_search_policy.php';
												//header('refresh:3; url=Delete_Policy.php');
											} else {
												echo "Error: " . $sql . "<br>" . $conn->error;
											}
										}

										// if ($result->num_rows > 0 ) {
										// 	include 'form_policy.php';
										// } else {
										// 	echo "Nothing to display";
										// }
									?>       
							</div> 
						</div> 
						<?php
							include 'emp_sidebar.php';
						?>		  			 

					</div>
					<?php
						$conn->close();
					?> 
				</body>
			</html>

<?php
	}
?>