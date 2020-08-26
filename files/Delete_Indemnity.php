<?php
    session_start();
    $Indem_no = $_SESSION['Indem_no'];
?>
            <!DOCTYPE HTML>
            <html>
                <head>
                    <title>Delete Indemnity</title>
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
                                                $sql = "USE szhang85_1;";
                                                if ($conn->query($sql) === TRUE) {
                                                // echo "using Database szhang85_1";
                                                } else {
                                                echo "Error using  database: " . $conn->error;
                                                }

                                                // Delete
                                                $sql = "DELETE FROM Indemnity WHERE Indem_no = '$Indem_no';";
                                                $result = $conn->query($sql);
                                                if ($result === TRUE && $conn->affected_rows > 0) {
                                                    echo "Record deleted successfully";
                                                    //$Indem_no = "";
                                                    header('refresh:3; url=Search_Indemnity.php');
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