<?php include 'includes/header.php'; ?>
<?php include 'widget_function.php';?>
<?php include 'functions.php';?>

<style>
    .st{
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
    }
</style>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/nav.php';?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

<div class="container">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <h2 class="page-header text-center" style="color: #00512D;">
                Welcome 
                <?php echo ucwords($_SESSION['lastname']) ; ?>
            </h2>
            <h4 class="text-center" style="color: #00512D;"><?php echo date('d F Y') ;?></h4>
        </div>
    </div>
    <!-- /.row dashboard -->
   
    <div class="row">

    <div class="col-12 col-md-6 col-lg-5">
        <div class="panel panel-success st ">
            <div class="panel-heading ">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-car fa-5x "></i>
                    </div>
                    <div class="col-xs-9 text-right">

                     <div class='huge'><?php buggy_count(); ?></div>
                      <div>BUGGY REQUEST</div>
                    </div>
                </div>
            </div>
            <a href="buggies.php">
                <div class="panel-footer">
                    <span class="pull-left text-success">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right text-success"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-5">
        <div class="panel panel-primary st">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <div class='huge'><?php user_count(); ?></div>
                        <div> USERS</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div> <!-- keep this dive -->
                <!-- /.row -->

     <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    <!-- Footer -->
    
    <?php
        include 'includes/footer.php';
    ?>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- <script src="js/script.js"></script> -->

</body>

</html>
