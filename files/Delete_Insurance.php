<?php
    session_start();
    $Ins_id = $_SESSION['Ins_id'];
?>
            <!DOCTYPE HTML>
            <html>
                <head>
                    <title>Delete Insurance</title>
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
                                                <!-- <a href="emp_edit.php" class="logo"><strong>Back</strong></a> -->
                                                <ul class="icons">
                                                </ul>
                                            </header>

                                            <?php                               
                                                require_once('db_setup.php');
                                                $sql = "USE insurance_data;";
                                                if ($conn->query($sql) === TRUE) {
                                                // echo "using Database insurance_data";
                                                } else {
                                                echo "Error using  database: " . $conn->error;
                                                }

                                                // Delete
                                                $sql = "DELETE FROM Insurance WHERE Ins_id = '$Ins_id';";
                                                $result = $conn->query($sql);
                                                if ($result === TRUE && $conn->affected_rows > 0) {
                                                    echo "Record deleted successfully";
                                                    //$Ins_id = "";
                                                    header('refresh:3; url=Search_Insurance.php');
                                                } else {
                                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                                }

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