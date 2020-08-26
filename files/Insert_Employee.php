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
					<title>Insert Employee</title>
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
									$Ee_id_err = $Ee_name_err = $Ee_pass_err = "";
									$pass = 0; // init pass to 0;
									
									function test_input($data)
									{
										$data = trim($data);
										$data = stripslashes($data);
										$data = htmlspecialchars($data);
										return $data;
									}
									
									$Ee_id = test_input($_POST["Ee_id"]);
									$Ee_name = test_input($_POST["Ee_name"]);
									$Ee_pass = test_input($_POST["Ee_pass"]);

									if ($_SERVER["REQUEST_METHOD"] == "POST")
									{
										// Ee_id检验(4位数字)
										if (empty($_POST["Ee_id"])|!preg_match("/^[0-9]*$/",$Ee_id)|(strlen($Ee_id) != 4))
										{
											$Ee_id_err = "Invalid Employee ID";
										}else{
											$pass += 1;
										}
										
										//Ee_name检验（字母/数字/连字符/空格，小于50）
										if (empty($_POST["Ee_name"])|!preg_match("/^[a-zA-Z\- ]*$/",$Ee_name)|(strlen($Ee_name) > 50))
										{
											$Ee_name_err = "Invalid Employee name";
										}else{
											$pass += 1;
										}
										
										//Ee_pass检验（6位，字母数字）
										if (empty($_POST["Ee_pass"])|!preg_match("/^[a-zA-Z0-9]*$/",$Ee_pass)|(strlen($Ee_pass) != 6))
										{
											$Ee_pass_err = "Invalid Employee password";
										}else{
											$pass += 1;
										}
									}
								?>

								<!-- <h2>Select Your Table and Command</h2>  -->    
								<section id="main page1">
										<h2>Insert Employee</h2>
										<p><span class="error">* Required</span></p>
										<form method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
											<div class="row uniform">
												<div class="6u$ 12u$(xsmall)">
														<h4>Employee ID</h4>
														<input type="text" name="Ee_id"  value="<?php echo $Ee_id;?>" placeholder="1234" required /> 
														<span class="error">* <?php echo $Ee_id_err;?></span><br /><br />

														<h4>Employee Name</h4>
														<input type="text" name="Ee_name"  value="<?php echo $Ee_name;?>" placeholder="Ethan Hunt" required />
														<span class="error">* <?php echo $Ee_name_err;?></span><br /><br />

														<h4>Employee Password</h4>
														<input type="text" name="Ee_pass"  value="<?php echo $Ee_pass;?>" placeholder="AZaz_6" required />
														<span class="error">* <?php echo $Ee_pass_err;?></span><br /><br />
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
										if ($pass == 3)
										{
											$sql = "INSERT INTO Employee values ('$Ee_id', '$Ee_name', '$Ee_pass');";
											$result = $conn->query($sql);
											if ($result === TRUE && $conn->affected_rows > 0) {
												echo "New records inserted successfully";
												$Ee_id = "";
												$Ee_name = "";
												$Ee_pass = "";
												header('refresh:3; url=Insert_Employee.php');												
											} else {
												echo "Error: " . $sql . "<br>" . $conn->error;
											}
										}

										// // Query:
										// $sql = "SELECT * FROM Employee;";
										// $result = $conn->query($sql);

										// if ($result->num_rows > 0 ) {
										// 	include 'form_employee.php';
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