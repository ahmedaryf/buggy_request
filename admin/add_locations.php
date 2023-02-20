<?php include 'includes/header.php'; 
    include 'functions.php';

    session_start();

if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
}
?>

<style>
     body{
        width: 90%;
        margin: 20px auto;
    }
    .on{
            background-color: #999;
            padding: 5px 8px;
            border-radius: 5px;
            color: #fff;
           
        }
        .on:hover{
            text-decoration: none;
            color: #fff;
            background-color: #555;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
     
        .delete{
            background-color: #999;
            padding: 5px 8px;
            border-radius: 5px;
            color: #fff;
           
        }
        .delete:hover{
            background-color: #db0909;
            color: #fff;
            text-decoration: none;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
     th{
            background-color: #999;
            
            color: #fff;
        }
        tr{
            background-color: #eee;
            padding: 5px 10px;
            color: #000;
        }
        tr:hover{
            background-color: #aaa;  
        }
</style>

<body >

        <nav>
        <!-- Navigation -->
        <?php include 'includes/nav.php';?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

            <div class="col-md-4">
        
        <div class="well" style="margin: 60px 10px ;">
                <h3>Add Location</h3>
                <form role="form" action="" method="POST" >

                    <div class="form-group">
                    <label for="email">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <button type="submit" class="btn on butt" name="submit">Submit</button>
                </form>
            </div>

        </div>
        <?php
                if (isset($_POST['submit'])) {
                   
                   $p_id = $_GET['p_id'];

                   $location_name = mysqli_real_escape_string($conn, $_POST['name']);
                   
                   $query = "INSERT INTO location (location_name) VALUES (?)";

                   $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $location_name);
                    $stmt->execute();
                    $stmt->close();

                    header('Location: add_locations.php');
                }
            ?>
        <div class="col-md-6">
            <h3 class="text-center">Locations</h3>
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
                                
                                if ($_SESSION['user_role'] === 'admin') {
                            
                                $delete_id = mysqli_real_escape_string($conn, $_GET['delete']);
    
                                $query = "DELETE FROM location WHERE location_id = ?";
    
                                // $delete_location_query = mysqli_query($conn, $query);
                                $delete_stmt = $conn->prepare($query);
                                $delete_stmt->bind_param("s", $delete_id);
                                $delete_stmt->execute();
                                $delete_stmt->close();
                                header('Location: add_locations.php');
                                }
                            }
                             echo "<tr>";
                             echo "<td>$location_id</td>";
                             echo "<td>$location_name</td>";
                             echo "<td><a class='delete' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='add_locations.php?delete={$location_id}'>Delete</a></td>";
                        }
                            mysqli_close($conn);
                            ?>
                            

                            </tbody>
                        </table>

                        </div>
                 </div>
            <!-- /.container-fluid -->
            <hr>

<!-- Footer -->

<?php
include '../includes/footer.php';
?>
        </div>
        <!-- /#page-wrapper -->



    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
