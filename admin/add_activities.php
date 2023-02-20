<?php session_start(); ?>
<?php include 'includes/header.php'; 
    include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<style>
     body{
        width: 90%;
        margin: 20px auto;
    }

   form{
    width: 40%;
    margin: 0 auto;
   }
   .button{
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            background-color: #006236;
        }
        .button:hover{
            background-color: #468D73;
        }
        .cl{
            color: #006236;
        }
</style>
<body >

        <?php
            
            if (isset($_POST['submit_activity'])) {
                $active_name = mysqli_real_escape_string($conn, $_POST['active_name']);
                $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
                $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
                $active_date = mysqli_real_escape_string($conn, $_POST['active_date']);

                $today = date("Y-m-d");

                $statment = $conn->prepare("INSERT INTO activities (active_name, start_time, end_time, active_date, date_enter) VALUES (?, ?, ?, ?, ?)");

                $statment->bind_param("sssss", $active_name, $start_time, $end_time, $active_date, $today);

                $statment->execute();

                $statment->close();

            }
            mysqli_close($conn);
        ?>


    <div id="wrapper" >

        <nav>
        <!-- Navigation -->
        <?php include 'includes/nav.php';?>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-center cl">
                            Add Activities
                        </h3>
                        
                        <div class="col-xs-12" >
             
                        <div class="tbl">

                            <!-- add pre buggy -->
                            <form action="" method="POST" style="width: 280px;" >
                        <div class="form-group">
                            <label for="cat_title" class="cl">Name Location</label>
                            <input type="text" id="active_name" class="form-control" name="active_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="cat_title" class="cl">Start Time</label>
                            <input type="time" id="active_date" class="form-control" name="start_time">
                        </div>

                        <div class="form-group">
                            <label for="cat_title" class="cl">End Time</label>
                            <input type="time" id="active_date" class="form-control" name="end_time">
                        </div>

                        <div class="form-group">
                            <label for="cat_title" class="cl">Date</label>
                            <input type="date" id="active_date" class="form-control" name="active_date">
                        </div>
                      
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary button" name="submit_activity" value="Add Activity">
                        </div>
                            </form>
                            </div>
                            
                        </div>  
                        
                        
                        </div>
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Bookings
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

    </div>
    <!-- /#wrapper -->
    <h6 style="color: #fff; padding-top: 10px;">
            <?php include 'includes/footer.php';?>
        </h6>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
