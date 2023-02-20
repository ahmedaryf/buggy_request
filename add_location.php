<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/header.php';
include 'includes/db.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
}
?>

<body>

    <!-- Navigation -->
    <?php 
        include 'includes/nav.php';
    ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Entries Column -->
            <div class="col-md-6">
        
            <div class="well">
                    <h3><a href="admin/buggies.php" style="color:#006236;">Add Location</a></h3>
                    <form role="form" action="" method="POST">

                        <div class="form-group">
                        <label for="email">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                
                        <button type="submit" class="btn btn-primary butt" name="submit">Submit</button>
                    </form>
                </div>
 
            </div>
                    <?php
                

                        if (isset($_POST['submit'])) {
                           
                           $p_id = $_GET['p_id'];

                           $location_name = mysqli_real_escape_string($conn, $_POST['name']);
                           
                           $query = "INSERT INTO location (location_name) VALUES ('$location_name')";
                           $insert_location = mysqli_query($conn, $query);

                           if (!$insert_location) {
                            die("query failled". mysqli_error($conn));
                            
                            }
                            header('Location: add_location.php');
                        }
                    ?>
            <div class="col-md-4">
            <h3>Locations</h3>
            <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            $query = "SELECT * FROM location ";
                            $select_location = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($select_location)) {
                            $location_id = $row['location_id'];
                            $location_name = ucwords($row['location_name']);
                            

                            if (isset($_GET['delete'])) {
                            
                                $delete_id = $_GET['delete'];
    
                                $query = "DELETE FROM location WHERE location_id = '$delete_id'";
    
                                $delete_location_query = mysqli_query($conn, $query);
                                header('Location: add_location.php');
                            }

                            echo "<tr>";
                             echo "<td>$location_id</td>";
                             echo "<td>$location_name</td>";
                             echo "<td><a class='delete' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='add_location.php?delete={$location_id}'>Delete</a></td>";
                        }
                            ?>
                            

                            </tbody>
            </table>

            </div>
        </div> <!-- /.row -->

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
