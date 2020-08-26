<?php 
	header('Content-type:text/html; charset=utf-8');
	// 开启Session
    session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Employee Login</title>
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

                                    $Ee_id_err = $Ee_pass_err = "";
                                    $pass = 0; // init pass to 0;

                                    function test_input($data)
                                    {
                                        $data = trim($data);
                                        $data = stripslashes($data);
                                        $data = htmlspecialchars($data);
                                        return $data;
                                    }

                                    $Ee_id = test_input($_POST["Ee_id"]);
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
                                        
                                        //Ee_pass检验（6位，字母数字）
                                        if (empty($_POST["Ee_pass"])|!preg_match("/^[a-zA-Z0-9]*$/",$Ee_pass)|(strlen($Ee_pass) != 6))
                                        {
                                            $Ee_pass_err = "Invalid Employee password";
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
                                        $sql = "SELECT Ee_id FROM Employee where Ee_id = '$Ee_id' and Ee_pass = '$Ee_pass';";
                                        $result = $conn->query($sql);
                                        
                                        # 判断是否有输出结果
                                        if  ($result->num_rows > 0)
                                        {
                                            # 用户名和密码都正确,将用户信息存到Session中
                                            $_SESSION['Ee_id'] = $Ee_id;
                                            $_SESSION['islogin'] = 1;
                                            setcookie('Ee_id',$Ee_id, time()-99);
                                            setcookie('code2',md5($Ee_id.md5($Ee_pass)),time()-99);
    
                                            // 处理完附加项后跳转到登录成功的首页
                                            header('location:emp_edit.php');
                                        } else {
                                            header('refresh:3; url=WelcomeEmployee.html');
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

