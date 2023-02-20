<?php include 'includes/header.php'; 
    include 'functions.php';?>
    <?php session_start(); ?>

    <style>
         body{
            width: 90%;
            margin: 20px auto;
            }
          .butt{
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            background-color: #006236;
        }
        .butt:hover{
            background-color: #468D73;
        }
    </style>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/nav.php';?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row ">
                    <div class="col-12 ">
                        <h3 class="page-header text-center">
                            User profile -
                            <?php echo ucwords($_SESSION['username']); ?>
                        </h3>

 <?php


if (isset($_SESSION['username'])) {

   $u_nam = $_SESSION['username'];

}

$query = "SELECT * FROM users WHERE username = '$u_nam'";
$select_user_by_id = mysqli_query($conn, $query);
if (!$select_user_by_id) {
    echo 'failed';
}

while ($row = mysqli_fetch_assoc($select_user_by_id)) {
    $user_i = $row['user_id'];
    $user_name = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_password = $row['user_password'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    $user_date = $row['user_date'];
}

if (isset($_POST['update_profile'])) {
    
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_firstname = mysqli_real_escape_string($conn, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($conn, $_POST['user_lastname']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $user_image_temp = mysqli_real_escape_string($conn, $_FILES['image']['tmp_name']);
    $user_role = mysqli_real_escape_string($conn, $_POST['select_user']);
    
   
    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = $u_id ";
        $select_image = mysqli_query($conn, $query);


      while ($row = mysqli_fetch_assoc($select_image)) {
        $user_image = $row['user_image'];
      }
    }
            $query = "UPDATE users SET user_firstname = ?, user_lastname = ? ,user_email = ? WHERE username = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $user_firstname, $user_lastname, $user_email, $u_nam);
            $stmt->execute();
            $stmt->close();

            header('Location: users.php');
}

?>

            <form action="" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: auto; padding: 0 20px;">

                    <div class="form-group">
                        <label for="firstnamer">Fisrt Name</label>
                        <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
                    </div>


                    <div class="form-group">
                        <label for="user_email">Contact</label>
                        <input value="<?php echo $user_email;?>" type="text" class="form-control" name="user_email">
                    </div>


                    <div class="form-group">
                        <input type="submit" class="btn btn-primary butt" name="update_profile" value="Update My Profile">
                    </div>

            </form>
                    
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

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
