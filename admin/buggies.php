<?php include 'includes/header.php'; 
    include 'functions.php';
?>
<STYle>
      @media only screen and (max-width: 900px) {
            .big {
                display: none;
            }
        }
        /* .back{
            text-align: center;
        }
        @media only screen and (min-width: 900px) {
            .back {
                display: none; 
            }
        } */
</STYle>
<body>

    <div id="wrapper">
    
        <nav
        <!-- Navigation -->
        <?php include 'includes/nav.php';?>
            <!-- /.navbar-collapse -->
        </nav>
    
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12" style="padding: 0 2px;">
                        <h2 class="page-header text-center" style="color: #006236; margin-bottom: 0;">
                            Buggy requests
                        </h2>
                        
                        <!-- <a class='btn btn-primary' href="../buggy.php">New Request</a> -->
                    <?php

                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    }else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_post':
                            include 'includes/add_post.php';
                            break;

                        case 'edit_buggy':
                            include 'includes/edit_buggy.php';
                            break;

                        case '200':
                            echo 'Nice 200';
                            break;
                        
                        default:
                            include 'includes/view_all_buggies.php';
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
            <?php include 'includes/footer.php';?>
        </h6>
    </div>

    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
