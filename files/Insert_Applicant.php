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
                    <title>Insert Applicant</title>
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
                                                $App_ssn_err = $App_name_err = $App_age_err = $App_gender_err = $App_career_err = $Mgr_id_err = $App_pass_err = "";
                                                $pass = 0; // init pass to 0;
                                                
                                                function test_input($data)
                                                {
                                                    $data = trim($data);
                                                    $data = stripslashes($data);
                                                    $data = htmlspecialchars($data);
                                                    return $data;
                                                }
                                                
                                                $App_ssn = test_input($_POST["App_ssn"]);
                                                $App_name = test_input($_POST["App_name"]);
                                                $App_age = test_input($_POST["App_age"]);
                                                $App_gender = test_input($_POST["App_gender"]);
                                                $App_career = test_input($_POST["App_career"]);
                                                $Mgr_id = test_input($_POST["Mgr_id"]);
                                                $App_pass = test_input($_POST["App_pass"]);

                                                if ($_SERVER["REQUEST_METHOD"] == "POST")
                                                {
                                                    // App_ssn检验(9位数字)
                                                    if (empty($_POST["App_ssn"])|!preg_match("/^[0-9]{9}$/",$App_ssn)|(strlen($App_ssn) != 9))
                                                    {
                                                        $App_ssn_err = "Invalid Applicant SSN";
                                                    }else{
                                                        $pass += 1;
                                                    }
                                                    
                                                    //App_name检验（只有能字母和空格连字符）
                                                    if (empty($_POST["App_name"])|!preg_match("/^[a-zA-Z\- ]*$/",$App_name)|(strlen($App_name) > 40))
                                                    {
                                                        $App_name_err = "Invalid Applicant name";
                                                    }else{
                                                        $pass += 1;
                                                    }
                                                    
                                                    //App_age检验(0-149)
                                                    if (empty($_POST["App_age"])|!preg_match("/^[1]{1}[0-4]{1}[0-9]{1}|[0-9]{1,2}$/",$App_age)|(strlen($App_age) > 3))
                                                    {
                                                        $App_age_err = "Invalid Applicant age";
                                                    }else{
                                                        $pass += 1;
                                                    }
                                                    
                                                    //App_gender检验(F M)
                                                    if (empty($_POST["App_gender"])|!preg_match("/^[M|F]*$/",$App_gender)|(strlen($App_gender) != 1))
                                                    {
                                                        $App_gender_err = "Invalid Applicant gender";
                                                    }else{
                                                        $pass += 1;
                                                    }
                                                    
                                                    //App_career检验(A-F)
                                                    if (empty($_POST["App_career"])|!preg_match("/^[A-F]*$/",$App_career)|(strlen($App_career) != 1))
                                                    {
                                                        $App_career_err = "Invalid Applicant career";
                                                    }else{
                                                        $pass += 1;
                                                    }

                                                    //Mgr_id检验(4位数字)
                                                    if (empty($_POST["Mgr_id"])|!preg_match("/^[0-9]*$/",$Mgr_id)|(strlen($Mgr_id) != 4))
                                                    {
                                                        $Mgr_id_err = "Invalid Manager ID";
                                                    }else{
                                                        $pass += 1;
                                                    }

                                                    //App_pass检验（字母，数字，下划线）
                                                    if (empty($_POST["App_pass"])|!preg_match("/^[\w]*$/",$App_pass)|(strlen($App_pass) != 6))
                                                    {
                                                        $App_pass_err = "Invalid Applicant Password";
                                                    }else{
                                                        $pass += 1;
                                                    }
                                                }
                                            ?>

                                            <!-- <h2>Select Your Table and Command</h2>  -->    
                                            <section id="main page1">
                                                    <h2>Insert Applicant</h2>
                                                    <p><span class="error">* Required</span></p>
                                                    <form method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                        <div class="row uniform">
                                                            <div class="6u$ 12u$(xsmall)">
                                                                    <h4>Applicant SSN</h4>
                                                                    <input type="text" name="App_ssn"  value="<?php echo $App_ssn;?>" placeholder="123456789" required /> 
                                                                    <span class="error">* <?php echo $App_ssn_err;?></span><br /><br />

                                                                    <h4>Applicant Name</h4>
                                                                    <input type="text" name="App_name"  value="<?php echo $App_name;?>" placeholder="Ethan Hunt" required />
                                                                    <span class="error">* <?php echo $App_name_err;?></span><br /><br />

                                                                    <h4>Applicant Age</h4>
                                                                    <input type="text" name="App_age"  value="<?php echo $App_age;?>" placeholder="0-149" required />
                                                                    <span class="error">* <?php echo $App_age_err;?></span><br /><br />

                                                                    <h4>Applicant Gender</h4>
                                                                    <input type="text" name="App_gender"  value="<?php echo $App_gender;?>" placeholder="M/F" required />
                                                                    <span class="error">* <?php echo $App_gender_err;?></span><br /><br />

                                                                    <h4>Applicant Career</h4>
                                                                    <input type="text" name="App_career"  value="<?php echo $App_career;?>" placeholder="A-F" required />
                                                                    <span class="error">* <?php echo $App_career_err;?></span><br /><br />

                                                                    <h4>Manager ID</h4>
                                                                    <input type="text" name="Mgr_id"  value="<?php echo $Mgr_id;?>" placeholder="1234" required />
                                                                    <span class="error">* <?php echo $Mgr_id_err;?></span><br /><br />

                                                                    <h4>Applicant Password</h4>
                                                                    <input type="text" name="App_pass"  value="<?php echo $App_pass;?>" placeholder="AZaz_6" required />
                                                                    <span class="error">* <?php echo $App_pass_err;?></span><br /><br />
                                                                    <input type="submit">
                                                            </div>
                                                        </div>
                                                    </form>                      
                                            </section>

                                            <?php                               
                                                require_once('db_setup.php');
                                                $sql = "USE szhang85_1;";
                                                if ($conn->query($sql) === TRUE) {
                                                // echo "using Database szhang85_1";
                                                } else {
                                                echo "Error using  database: " . $conn->error;
                                                }

                                                // Insert
                                                if ($pass == 7)
                                                {
                                                    $sql = "INSERT INTO Applicant values ('$App_ssn', '$App_name', '$App_age','$App_gender', '$App_career', '$Mgr_id', '$App_pass');";
                                                    $result = $conn->query($sql);
                                                    if ($result === TRUE && $conn->affected_rows > 0) {
                                                        echo "New records inserted successfully";
                                                        $App_ssn = "";
                                                        $App_name = "";
                                                        $App_age = "";
                                                        $App_gender = "";
                                                        $App_career = "";
                                                        $Mgr_id = "";
                                                        $App_pass = "";
                                                        header('refresh:3; url=Insert_Applicant.php');
                                                    } else {
                                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                                    }
                                                }

                                                // // Query:
                                                // $sql = "SELECT * FROM Applicant;";
                                                // $result = $conn->query($sql);

                                                // if ($result->num_rows > 0) {
                                                //     include 'form_applicant.php';                              
                                                // } else {
                                                //     echo "Nothing to display";
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