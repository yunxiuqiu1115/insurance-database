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
					<title>Insert Insurance</title>
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
									$Ins_id_err = $Ins_name_err = $Ins_type_err = $Policy_period_err = $Min_premium_err = $Max_insured_err = "";
									$pass = 0; // init pass to 0;
									
									function test_input($data)
									{
										$data = trim($data);
										$data = stripslashes($data);
										$data = htmlspecialchars($data);
										return $data;
									}
									
									$Ins_id = test_input($_POST["Ins_id"]);
									$Ins_name = test_input($_POST["Ins_name"]);
									$Ins_type = test_input($_POST["Ins_type"]);
									$Policy_period = test_input($_POST["Policy_period"]);
									$Min_premium = test_input($_POST["Min_premium"]);
									$Max_insured = test_input($_POST["Max_insured"]);

									if ($_SERVER["REQUEST_METHOD"] == "POST")
									{
										// ins_id检验(4位 字母，数字)
										if (empty($_POST["Ins_id"])|!preg_match("/^[a-z0-9]*$/",$Ins_id)|(strlen($Ins_id) != 4))
										{
											$Ins_id_err = "Invalid Insurance ID";
										}else{
											$pass += 1;
										}
										
										//Ins_name检验(字母/数字/空格/连字符)
										if (empty($_POST["Ins_name"])|!preg_match("/^[a-zA-Z0-9\- ]*$/",$Ins_name)|(strlen($Ins_name) > 50))
										{
											$Ins_name_err = "Invalid Insurance name";
										}else{
											$pass += 1;
										}
										
										//Ins_type检验(字母/数字/空格/连字符)
										if (empty($_POST["Ins_type"])|!preg_match("/^[a-zA-Z0-9 ]*$/",$Ins_type)|(strlen($Ins_type) > 10))
										{
											$Ins_type_err = "Invalid Insurance type";
										}else{
											$pass += 1;
										}
										
										//Policy_period检验(5位数字)
										if (empty($_POST["Policy_period"])|!preg_match("/^[0-9]*$/",$Policy_period)|(strlen($Policy_period) != 5))
										{
											$Policy_period_err = "Invalid Policy period";
										}else{
											$pass += 1;
										}
										
										//Min_premium检验（不超过10位，小数点后两位）
										if (empty($_POST["Min_premium"])|!preg_match("/^[0-9]{0,7}+(\.[0-9]{2})?$/",$Min_premium)|(strlen($Min_premium) > 10))
										{
											$Min_premium_err = "Invalid Mininuml premium";
										}else{
											$pass += 1;
										}

										//Max_insured检验（不超过10位，小数点后两位）
										if (empty($_POST["Max_insured"])|!preg_match("/^[0-9]{0,7}+(\.[0-9]{2})?$/",$Max_insured)|(strlen($Max_insured) > 10))
										{
											$Max_insured_err = "Invalid Maximum insured";
										}else{
											$pass += 1;
										}
									}
								?>

								<!-- <h2>Select Your Table and Command</h2>  -->    
								<section id="main page1">
										<h2>Insert Insurance</h2>
										<p><span class="error">* Required</span></p>
										<form method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
											<div class="row uniform">
												<div class="6u$ 12u$(xsmall)">
														<h4>Insurance ID</h4>
														<input type="text" name="Ins_id"  value="<?php echo $Ins_id;?>" placeholder="c001" required /> 
														<span class="error">* <?php echo $Ins_id_err;?></span><br /><br />

														<h4>Insurance Name</h4>
														<input type="text" name="Ins_name"  value="<?php echo $Ins_name;?>" placeholder="Collision Protection" required />
														<span class="error">* <?php echo $Ins_name_err;?></span><br /><br />

														<h4>Insurance Type</h4>
														<input type="text" name="Ins_type"  value="<?php echo $Ins_type;?>" placeholder="auto(car)" required />
														<span class="error">* <?php echo $Ins_type_err;?></span><br /><br />

														<h4>Policy Period</h4>
														<input type="text" name="Policy_period"  value="<?php echo $Policy_period;?>" placeholder="10000" required />
														<span class="error">* <?php echo $Policy_period_err;?></span><br /><br />

														<h4>Minimum Premium</h4>
														<input type="text" name="Min_premium"  value="<?php echo $Min_premium;?>" placeholder="1234567.89" required />
														<span class="error">* <?php echo $Min_premium_err;?></span><br /><br />

														<h4>Maximum Insured</h4>
														<input type="text" name="Max_insured"  value="<?php echo $Max_insured;?>" placeholder="1234567.89" required />
														<span class="error">* <?php echo $Max_insured_err;?></span><br /><br />
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
										
										// Insert
										if ($pass == 6)
										{
											$sql = "INSERT INTO Insurance values ('$Ins_id', '$Ins_name', '$Ins_type','$Policy_period', '$Min_premium', '$Max_insured');";
											$result = $conn->query($sql);
											if ($result === TRUE && $conn->affected_rows > 0) {
												echo "New records inserted successfully";
												$Ins_id = "";
												$Ins_name = "";
												$Ins_type = "";
												$Policy_period = "";
												$Min_premium = "";
												$Max_insured = "";
												header('refresh:3; url=Insert_Insurance.php');
											} else {
												echo "Error: " . $sql . "<br>" . $conn->error;
											}
										}

										// // Query:
										// $sql = "SELECT * FROM Insurance;";
										// $result = $conn->query($sql);

										// if ($result->num_rows > 0 ) {
										// 	include 'form_insurance.php';									
										// } else {
										// 	echo "Nothing to display";
										// }
									?>

									<?php
										$conn->close();
									?>                   
							</div>         
						</div>
						<?php
							include 'emp_sidebar.php';
						?>
					</div>

				</body>
			</html>
<?php
    }
?>