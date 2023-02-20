<?php include 'includes/header.php'; 
    include 'functions.php';

    session_start();

if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
}
?>

<style>
     body{
        width: 100%;
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

            <div class="container">

            <div class="col-12">
        <button id="show" class="btn on ">Show Editor</button>
        <div class="well" id="form-edit" style="margin: 60px 10px; display: none;">

                <form role="form" action="" method="POST">

                    <div class="form-group">
                    <label for="email">Message</label>
                        <textarea id="summernote" type="text" name="name" class="form-control" rows="4" cols="50" required></textarea>
                    </div>

                    <button type="submit" class="btn on " name="submit">Submit</button>
                </form>
            </div>

        </div>
        <?php
                if (isset($_POST['submit'])) {
                   
                   $p_id = $_GET['p_id'];

                   $message_body = mysqli_real_escape_string($conn, $_POST['name']);
                   $message_name = $_SESSION['username'];
                   $message_time = date('H:i:s');
                   $today = date('Y-m-d');
                   
                   $query = "INSERT INTO message (message_body, message_name, message_time, message_date) VALUES (?, ?, ?, ?)";

                   $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssss", $message_body, $message_name, $message_time, $today);
                    $stmt->execute();
                    $stmt->close();

                    header('Location: add_message.php');
                }
            ?>
        <div class="col-12" style="overflow: scroll;">
            <h3 class="text-center">Messages</h3>
            <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>MESSAGE</th>
                                    <th>AUTHOR</th>
                                    <th>TIME</th>
                                    <th>DATE</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            $query = "SELECT * FROM message ";
                            $select_message = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($select_message)) {
                            $message_id = $row['message_id'];
                            $message_body = ucwords($row['message_body']);
                            $message_name = ucwords($row['message_name']);
                            $message_time = ucwords($row['message_time']);
                            $message_date = ucwords($row['message_date']);

                            $_SESSION['message_name'] = $message_body;
                            
                            if (isset($_GET['delete'])) {
                                
                                if ($_SESSION['user_role'] === 'admin') {
                            
                                $delete_id = mysqli_real_escape_string($conn, $_GET['delete']);
    
                                $query = "DELETE FROM message WHERE message_id = ?";
    
                                // $delete_location_query = mysqli_query($conn, $query);
                                $delete_stmt = $conn->prepare($query);
                                $delete_stmt->bind_param("s", $delete_id);
                                $delete_stmt->execute();
                                $delete_stmt->close();
                                header('Location: add_message.php');
                                }
                            }
                             echo "<tr>";
                             echo "<td>$message_id</td>";
                             echo "<td>$message_body</td>";
                             echo "<td>$message_name</td>";
                             echo "<td>$message_time</td>";
                             echo "<td>$message_date</td>";
                             echo "<td><a class='delete' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='add_message.php?delete={$message_id}'>Delete</a></td>";
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

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();

  $('#show').click(function(){
    $('#form-edit').fadeToggle(100);
    })
});
</script>
</body>

</html>
