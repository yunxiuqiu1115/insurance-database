<?php 
	header('Content-type:text/html; charset=utf-8');
	// 开启Session
    session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Customer Logout</title>
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
									<h2>Successfully logout</h2>
									<ul class="icons">
									</ul>
                                </header>

                            <?php

                                    // 清除session和cookie信息
                                    $App_ssn = $_SESSION['App_ssn'];
                                    $_SESSION = array();
                                    session_destroy();
                                    
                                    setcookie('App_ssn','',time()-99);
                                    setcookie('code','',time()-99);

                                    echo "Successfully logout."."<br />";
                                    echo "Jump to login page in 3 seconds.";
                                    header('refresh:3; url=WelcomeCustomer.html');
                            ?>
                        </div>
                    </div>
            </div>
	</body>
</html>

