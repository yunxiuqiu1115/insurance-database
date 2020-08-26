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
					<title>Insert Indemnity</title>
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
									$Indem_no_err = $Policy_no_err = $Indem_date_err = $Real_benefit_err = "";
									$pass = 0; // init pass to 0;
									
									function test_input($data)
									{
										$data = trim($data);
										$data = stripslashes($data);
										$data = htmlspecialchars($data);
										return $data;
									}
									
									$Indem_no = test_input($_POST["Indem_no"]);
									$Policy_no = test_input($_POST["Policy_no"]);
									$Indem_date = test_input($_POST["Indem_date"]);
									$Real_benefit = test_input($_POST["Real_benefit"]);

									if ($_SERVER["REQUEST_METHOD"] == "POST")
									{
										// Indem_no检验(9位数字)
										if (empty($_POST["Indem_no"])|!preg_match("/^[0-9]*$/",$Indem_no)|(strlen($Indem_no) != 9))
										{
											$Indem_no_err = "Invalid Indemnity ID";
										}else{
											$pass += 1;
										}
										
										//Policy_no检验（9位数字）
										if (empty($_POST["Policy_no"])|!preg_match("/^[0-9]*$/",$Policy_no)|(strlen($Policy_no) != 9))
										{
											$Policy_no_err = "Invalid Policy number";
										}else{
											$pass += 1;
										}
										
										//Indem_date检验(日期匹配1900-2099年)
										if (empty($_POST["Indem_date"])|!preg_match("/^((((19|20)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((19|20)\d{2})-(0?[469]|11)-(0?[1-9]|[12]\d|30))|(((19|20)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|((((19|20)([13579][26]|[2468][048]|0[48]))|(2000))-0?2-(0?[1-9]|[12]\d)))$/",$Indem_date)|(strlen($Indem_date) > 10))
										{
											$Indem_date_err = "Invalid Indemnity date";
										}else{
											$pass += 1;
										}
										
										//Real_benefit检验（不超过10位，小数点后两位）
										if (empty($_POST["Real_benefit"])|!preg_match("/^[0-9]{0,7}+(\.[0-9]{2})?$/",$Real_benefit)|(strlen($Real_benefit) > 10))
										{
											$Real_benefit_err = "Invalid Real benefit";
										}else{
											$pass += 1;
										}
									}
								?>

								<!-- <h2>Select Your Table and Command</h2>  -->    
								<section id="main page1">
										<h2>Insert Indemnity</h2>
										<p><span class="error">* Required</span></p>
										<form method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
											<div class="row uniform">
												<div class="6u$ 12u$(xsmall)">
														<h4>Indemnity Number</h4>
														<input type="text" name="Indem_no"  value="<?php echo $Indem_no;?>" placeholder="123456789" required /> 
														<span class="error">* <?php echo $Indem_no_err;?></span><br /><br />

														<h4>Policy Number</h4>
														<input type="text" name="Policy_no"  value="<?php echo $Policy_no;?>" placeholder="123456789" required />
														<span class="error">* <?php echo $Policy_no_err;?></span><br /><br />

														<h4>Indemnity Date</h4>
														<input type="text" name="Indem_date"  value="<?php echo $Indem_date;?>" placeholder="2018-01-01" required />
														<span class="error">* <?php echo $Indem_date_err;?></span><br /><br />

														<h4>Real Benefit</h4>
														<input type="text" name="Real_benefit"  value="<?php echo $Real_benefit;?>" placeholder="1234567.89" required />
														<span class="error">* <?php echo $Real_benefit_err;?></span><br /><br />
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
										if ($pass == 4)
										{
											$sql = "INSERT INTO Indemnity values ('$Indem_no', '$Policy_no', '$Indem_date','$Real_benefit');";
											$result = $conn->query($sql);
											if ($result === TRUE && $conn->affected_rows > 0) {
												echo "New records inserted successfully";
												$Indem_no = "";
												$Policy_no = "";
												$Indem_date = "";
												$Real_benefit = "";
												header('refresh:3; url=Insert_Indemnity.php');
											} else {
												echo "Error: " . $sql . "<br>" . $conn->error;
											}
										}

										// // Query:
										// $sql = "SELECT * FROM Indemnity;";
										// $result = $conn->query($sql);

										// if ($result->num_rows > 0 ) {
										// 	include 'form_indemnity.php';
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