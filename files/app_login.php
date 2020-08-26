<?php 
	header('Content-type:text/html; charset=utf-8');
	// 开启Session
    session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Customer Login</title>
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
									<h2>Login failed</h2></a>
									<ul class="icons">
									</ul>
                                </header>

                            <?php
                                    $App_ssn_err = $App_pass_err = "";
                                    $pass = 0;    // init pass to 0;

                                    function test_input($data)
                                    {
                                        $data = trim($data);
                                        $data = stripslashes($data);
                                        $data = htmlspecialchars($data);
                                        return $data;
                                    }
    
                                    $App_ssn = test_input($_POST["App_ssn"]);
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
                                        
                                        //App_pass检验（字母，数字，下划线）
                                        if (empty($_POST["App_pass"])|!preg_match("/^[\w]*$/",$App_pass)|(strlen($App_pass) != 6))
                                        {
                                            $App_pass_err = "Invalid Applicant Password";
                                        }else{
                                            $pass += 1;
                                        }
                                    }

                                    // 数据库登录
                                    require_once('db_setup.php');
                                    $sql = "USE insurance_data;";
                                    if ($conn->query($sql) === TRUE) {
                                    //echo "using Database insurance_data";
                                    } else {
                                    echo "Error using database: " . $conn->error;
                                    }

                                    if ($pass = 2)
                                    {
                                        $sql = "SELECT App_ssn FROM Applicant where App_ssn = '$App_ssn' and App_pass = '$App_pass';";
                                        $result = $conn->query($sql);

                                        # 判断是否有输出结果
                                        if  ($result->num_rows > 0)
                                        {
                                            # 用户名和密码都正确,将用户信息存到Session中
                                            $_SESSION['App_ssn'] = $App_ssn;
                                            $_SESSION['islogin'] = 1;
                                            setcookie('App_ssn',$App_ssn, time()-99);
                                            setcookie('code',md5($App_ssn.md5($App_pass)),time()-99);

                                            // 处理完附加项后跳转到登录成功的首页
                                            header('location:app_view.php');
                                        } else {
                                            header('refresh:3; url=WelcomeCustomer.html');
                                            echo "Username or Password wrong!"."<br />";
                                            echo "Jump to login page after 3 seconds.";
                                            exit;
                                        }
                                    }      
                            ?>
                        </div>
                    </div>
            </div>
	</body>
</html>

