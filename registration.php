<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php session_start(); ?>

<?php
if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin') {
       header("Location: index.php");
}

if (isset($_POST['submit'])) {
  $u_name = mysqli_real_escape_string($conn , $_POST['username']);
  $u_fname = mysqli_real_escape_string($conn , $_POST['firstname']);
  $u_lname = mysqli_real_escape_string($conn , $_POST['lastname']);
  $u_contact = mysqli_real_escape_string($conn , $_POST['email']);
  $us_password = mysqli_real_escape_string($conn , $_POST['password']);
  $u_role = 'user';
  $today = date('Y-m-d');

    $crypt_password = password_hash($us_password, PASSWORD_BCRYPT, array('cost' => 10) );

    $query = "INSERT INTO users (username, user_firstname, user_lastname, user_password, user_email, user_role, user_date) VALUES(?, ?, ?, ?, ?, ?, ?)";

    // $create_user_query = mysqli_query($conn, $query);
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $u_name, $u_fname, $u_lname, $crypt_password, $u_contact, $u_role, $today);
    $stmt->execute();
    $stmt->close();
 
        echo "<h4 class='text-center'>User created </h4>". "<div class='mx-auto text-center'><a class='btn btn-primary' href='admin/users.php'>View Users</a></div>" ;

        mysqli_close($conn);
}
?>

<style> 
.mu:focus{
    color: #00512D;
    background-color: #F2FCF5;
    box-shadow: none;
    outline: none;
    border-color: #00512D;
}

</style>
    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap" style="max-width: 600px; margin:auto;">
                <h1 style="color: #00512D; text-align: center">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control mu" placeholder="Desired username" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control mu" placeholder="Enter firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control mu" placeholder="Enter lastname" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="taxt" name="email" id="email" class="form-control mu" placeholder="Contact" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control mu" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register" style="color: #00512D;">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
