<?php
include 'includes/header.php';
include 'includes/db.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'sp') {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<style>
     .butt{
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            background-color: #006236;
        }
        .butt:hover{
            background-color: #468D73;
        }
        
</style>
<body >

    <!-- Navigation -->
    <?php 
        include 'includes/nav.php';
    ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- buggy form -->
                <div class="well">
                    <h3><a href="admin/buggies.php" style="color:#006236;"> Buggy Requests</a></h3>
                    <form action="" method="POST">

                        <div class="form-group">
                            <label for="author">Villa</label>
                            <input type="text" name="villa" class="form-control" required autofocus>
                        </div>

                        <div class="form-group">
                        <label for="email">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                        <label for="from">From</label><br>
                           <select name="from" id="">
                            <?php
                                $query = "SELECT * FROM location ";
                                $select_location = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($select_location)) {
                                $location_id = $row['location_id'];
                                $location_name = ucwords($row['location_name']);

                                echo "<option value='{$location_name}'>{$location_name}</option>";
                                }
                            ?>
                           
                           </select>
                        </div>
 
                        <button type="submit" class="btn btn-primary butt" name="submit">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->     
                <?php
                        $requestedby = $_SESSION['username'];
                        $time_zone = date_default_timezone_set("Asia/Dhaka");

                        if (isset($_POST['submit'])) {
                           
                            $p_id = $_GET['p_id'];

                            $villa = mysqli_real_escape_string($conn, $_POST['villa']) ;
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $from = mysqli_real_escape_string($conn, $_POST['from']);
                            $Requested = date('H:i:s');
                            $today = date('Y-m-d');

                            if (empty($name)) {
                                $name = 'Guest Name';
                            }else {$name = mysqli_real_escape_string($conn, $_POST['name']);}
                           
                            if (!empty($villa)) {

                            $query = "INSERT INTO buggy (villa, name, r_from, rtime, e_date, req_by) VALUES (?, ?, ?, ?, ?, ?)";

                            // $insert_buggy = mysqli_query($conn, $query);

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("isssss", $villa, $name, $from, $Requested, $today, $requestedby);
                            $stmt->execute();
                            $stmt->close();
                            } else{
                                echo "<script>alert('Fields cannot be empty')</script>";
                            }

                            header('Location: buggies.php');
                        }
                        mysqli_close($conn);
                    ?>

            </div> <!-- keep this closing tag -->

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
    
    <?php
        include 'includes/footer.php';
    ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
