<?php
    session_start();

	if(!isset($_SESSION['App_ssn'])){
		header('refresh:0; url=app_IllegalAccess.php');
	}
    else{
?>
            <!DOCTYPE HTML>
            <html>
                <head>
                    <title>View Your Manager</title>
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
                                                <a href="app_view.php" class="logo"><strong>Back</strong></a>
                                                <ul class="icons">
                                                </ul>
                                            </header>

                                            <?php
                                            require_once('db_setup.php');
                                            $sql = "USE insurance_data;";
                                            if ($conn->query($sql) === TRUE) {
                                                // echo "using Database tbiswas2_company";
                                            } else {
                                                echo "Error using  database: " . $conn->error;
                                            }
                                            // Query:
                                            $App_ssn = $_SESSION['App_ssn'];
                                            $sql = "SELECT * FROM Employee, Applicant WHERE Applicant.Mgr_id = Employee.Ee_id and Applicant.App_ssn = '$App_ssn';";
                                            $result = $conn->query($sql);

                                            if($result->num_rows > 0){
                                                include 'form_employee.php';
                                            }
                                            else {
                                                echo "Nothing to display";
                                            }
                                            ?>
       
                                </div>
                            </div>
                            
                            <?php
                                include 'app_sidebar.php';
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
