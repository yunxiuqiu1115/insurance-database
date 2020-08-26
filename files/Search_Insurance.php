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
					<title>Search Insurance</title>
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
												$Ins_id_err = "";
												$pass = 0; // init pass to 0;
												
												function test_input($data)
												{
													$data = trim($data);
													$data = stripslashes($data);
													$data = htmlspecialchars($data);
													return $data;
												}
												
												$Ins_id = test_input($_POST["Ins_id"]);

												if ($_SERVER["REQUEST_METHOD"] == "POST")
												{
													// ins_id检验
													if (empty($_POST["Ins_id"])|!preg_match("/^[a-z0-9]*$/",$Ins_id)|(strlen($Ins_id) != 4))
													{
														$Ins_id_err = "Invalid Insurance ID";
													}else{
														$pass += 1;
													}
												}
											?>

											<!-- <h2>Select Your Table and Command</h2>  -->    
											<section id="main page1">
													<h2>Search Insurance</h2>
													<p><span class="error">* Required</span></p>
													<form method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
														<div class="row uniform">
															<div class="6u$ 12u$(xsmall)">
																	<h4>Insurance ID</h4>
																	<input type="text" name="Ins_id"  value="<?php echo $Ins_id;?>" placeholder="c001" required /> 
																	<span class="error">* <?php echo $Ins_id_err;?></span><br /><br />
																	<input type="submit">
															</div>
														</div>
													</form>                      
											</section>
												
											<?php
												// connect database
												require_once('db_setup.php');
												$sql = "USE insurance_data;";

												if ($conn->query($sql) === TRUE) {
													//echo "using Database insurance_data";
												} else {
													echo "Error using database: " . $conn->error;
												}
												
												// // Query:
												// $sql = "SELECT * FROM Insurance;";
												// $result2 = $conn->query($sql);
												// $result = $result2;
																				
												if ($pass == 1)
												{
													$sql = "SELECT * FROM Insurance WHERE Ins_id = '$Ins_id';";
													$result = $conn->query($sql);
													if ($result->num_rows > 0) {
														include 'form_search_insurance.php';
													} else {
														echo "Error: " . $sql . "<br>" . $conn->error;
													}
												}

												// if ($result->num_rows > 0 ) {
												// 	include 'form_insurance.php';
												// 	} else {
												// 		echo "Nothing to display";
												// 	}
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

