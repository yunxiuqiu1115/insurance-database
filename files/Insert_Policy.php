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
					<title>Insert Policy</title>
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
									$Policy_no_err = $App_ssn_err = $Ins_id_err = $Eff_date_err = $Real_premium_err = $Real_insured_err = "";
									$pass = 0; // init pass to 0;
									
									function test_input($data)
									{
										$data = trim($data);
										$data = stripslashes($data);
										$data = htmlspecialchars($data);
										return $data;
									}
									
									$Policy_no = test_input($_POST["Policy_no"]);
									$App_ssn = test_input($_POST["App_ssn"]);
									$Ins_id = test_input($_POST["Ins_id"]);
									$Eff_date = test_input($_POST["Eff_date"]);
									$Real_premium = test_input($_POST["Real_premium"]);
									$Real_insured = test_input($_POST["Real_insured"]);

									if ($_SERVER["REQUEST_METHOD"] == "POST")
									{
										// Policy_no检验(9位数字)
										if (empty($_POST["Policy_no"])|!preg_match("/^[0-9]*$/",$Policy_no)|(strlen($Policy_no) != 9))
										{
											$Policy_no_err = "Invalid Policy Number";
										}else{
											$pass += 1;
										}
										
										//App_ssn检验(9位数字)
										if (empty($_POST["App_ssn"])|!preg_match("/^[0-9]*$/",$App_ssn)|(strlen($App_ssn) != 9))
										{
											$App_ssn_err = "Invalid Applicant SSN";
										}else{
											$pass += 1;
										}
										
										//Ins_id检验(4位数字/字母)
										if (empty($_POST["Ins_id"])|!preg_match("/^[a-z0-9]*$/",$Ins_id)|(strlen($Ins_id) != 4))
										{
											$Ins_id_err = "Invalid Insurance ID";
										}else{
											$pass += 1;
										}
										
										//Eff_date检验(日期匹配1900-2099年)
										if (empty($_POST["Eff_date"])|!preg_match("/^((((19|20)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((19|20)\d{2})-(0?[469]|11)-(0?[1-9]|[12]\d|30))|(((19|20)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|((((19|20)([13579][26]|[2468][048]|0[48]))|(2000))-0?2-(0?[1-9]|[12]\d)))$/",$Eff_date))//|(strlen($Eff_date) != 10)
										{
											$Eff_date_err = "Invalid Effective date";
										}else{
											$pass += 1;
										}

										//Real_premium检验
										if (empty($_POST["Real_premium"])|!preg_match("/^[0-9]{0,7}+(\.[0-9]{2})?$/",$Real_premium)|(strlen($Real_premium) > 10))
										{
											$Real_premium_err = "Invalid Real premium";
										}else{
											$pass += 1;
										}

										//Real_insured检验
										if (empty($_POST["Real_insured"])|!preg_match("/^[0-9]{0,7}+(\.[0-9]{2})?$/",$Real_insured)|(strlen($Real_insured) > 10))
										{
											$Real_insured_err = "Invalid Real insured";
										}else{
											$pass += 1;
										}
									}
								?>

								<!-- <h2>Select Your Table and Command</h2>  -->    
								<section id="main page1">
										<h2>Insert Policy</h2>
										<p><span class="error">* Required</span></p>
										<form method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
											<div class="row uniform">
												<div class="6u$ 12u$(xsmall)">
														<h4>Policy Number</h4>
														<input type="text" name="Policy_no"  value="<?php echo $Policy_no;?>" placeholder="123456789" required /> 
														<span class="error">* <?php echo $Policy_no_err;?></span><br /><br />

														<h4>Applicant SSN</h4>
														<input type="text" name="App_ssn"  value="<?php echo $App_ssn;?>" placeholder="123456789" required />
														<span class="error">* <?php echo $App_ssn_err;?></span><br /><br />

														<h4>Insurance ID</h4>
														<input type="text" name="Ins_id"  value="<?php echo $Ins_id;?>" placeholder="c001" required />
														<span class="error">* <?php echo $Ins_id_err;?></span><br /><br />

														<h4>Effective Date</h4>
														<input type="text" name="Eff_date"  value="<?php echo $Eff_date;?>" placeholder="2018-01-01" required />
														<span class="error">* <?php echo $Eff_date_err;?></span><br /><br />

														<h4>Real Premium</h4>
														<input type="text" name="Real_premium"  value="<?php echo $Real_premium;?>" placeholder="1234567.89" required />
														<span class="error">* <?php echo $Real_premium_err;?></span><br /><br />

														<h4>Real Insured</h4>
														<input type="text" name="Real_insured"  value="<?php echo $Real_insured;?>" placeholder="1234567.89" required />
														<span class="error">* <?php echo $Real_insured_err;?></span><br /><br />
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
										
										// Insert
										if ($pass == 6)
										{
											$sql = "INSERT INTO Policy values ('$Policy_no', '$App_ssn', '$Ins_id','$Eff_date', '$Real_premium', '$Real_insured');";
											$result = $conn->query($sql);
											if ($result === TRUE && $conn->affected_rows > 0) {
												echo "New records inserted successfully";
												$Policy_no = "";
												$App_ssn = "";
												$Ins_id = "";
												$Eff_date = "";
												$Real_premium = "";
												$Real_insured = "";
												header('refresh:3; url=Insert_Policy.php');
											} else {
												echo "Error: " . $sql . "<br>" . $conn->error;
											}
										}

										// // Query:
										// $sql = "SELECT * FROM Policy;";
										// $result = $conn->query($sql);

										// if ($result->num_rows > 0 ) {
										// 	include 'form_policy.php';
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