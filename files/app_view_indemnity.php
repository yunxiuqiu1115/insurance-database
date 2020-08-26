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
                    <title>View Your Indemnity</title>
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
                                        $sql = "USE szhang85_1;";
                                        if ($conn->query($sql) === TRUE) {
                                        // echo "using Database tbiswas2_company";
                                        } else {
                                        echo "Error using  database: " . $conn->error;
                                        }
                                        // Query:
                                        $App_ssn = $_SESSION['App_ssn'];
                                        $sql = "SELECT * FROM Indemnity, Policy WHERE Policy.App_ssn = '$App_ssn' and Policy.Policy_no = Indemnity.Policy_no;";
                                        $result = $conn->query($sql);
                                        if($result->num_rows > 0){
                                            include 'form_indemnity.php';
                                        }
                                        else {
                                            echo "Nothing to display";
                                        }
                                    ?>            
                                </div>
                            </div>
                            
                                    <!-- Sidebar -->
                                        <div id="sidebar">
                                            <div class="inner">
                                                <nav id="menu">
                                                    <header class="major">
                                                        <h2>Tables</h2>
                                                    </header>
                                                    <ul>
                                                        <li>
                                                            <span class="opener">Insurance</span>
                                                            <ul>
                                                                <li><a href="app_view_insurance.php">View</a></li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <span class="opener">Applicant</span>
                                                            <ul>
                                                                <li><a href="app_view_applicant.php">View</a></li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <span class="opener">Policy</span>
                                                            <ul>
                                                                <li><a href="app_view_policy.php">View</a></li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <span class="opener">Indemnity</span>
                                                            <ul>
                                                                <li><a href="app_view_indemnity.php">View</a></li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <span class="opener">Employee</span>
                                                                <ul>
                                                                    <li><a href="app_view_employee.php">View</a></li>
                                                                </ul>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div> 

                        </div>
                        
                        <?php
                        $conn->close();
                        ?> 
                    <!-- Scripts -->
                    <script src="assets/js/jquery.min.js"></script>
                    <script src="assets/js/skel.min.js"></script>
                    <script src="assets/js/util.js"></script>
                    <script src="assets/js/main.js"></script>

                </body>
            </html>
<?php
    }
?>

