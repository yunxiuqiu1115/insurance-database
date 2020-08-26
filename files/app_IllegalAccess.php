<!DOCTYPE HTML>
<html>
    <head>
        <title>Illegal Access</title>
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
                        <h2>Illegal Access</h2>
                        <ul class="icons">
                        </ul>
                    </header>		
                    
                    <?php
                    echo "Please Login first."."<br />";
                    echo "This page will jump to Login Page in 3 seconds.";
                    header('refresh:3; url=WelcomeCustomer.html');
                    ?>
                </div>                          
            </div>  

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>

