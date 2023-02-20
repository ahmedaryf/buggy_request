<?php include 'includes/header.php'; 
     include 'functions.php';
?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/nav.php';?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header" style="color: #734002;">
                            Welcome to users page     
                        </h3>
                        
                    <?php

                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    }else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_user':
                            include 'includes/add_user.php';
                            break;

                        case 'edit_user':
                            include 'includes/edit_user.php';
                            break;

                        case 'user_profile':
                            echo 'user_profile.php';
                            break;
                        
                        default:
                            include 'includes/view_all_users.php';
                            break;
                    }
                    ?>
                    
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <h6 style="color: #fff; padding-top: 10px;">
    <?php
        include 'includes/footer.php';
    ?>
    </h6>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
