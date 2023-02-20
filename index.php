<?php
include 'includes/header.php';
// include 'includes/db.php';
include 'includes/db.pdo.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .bta{
        background-color: #006236;
        color: #fff;
        border-color: #fff;
    }
    .bta:hover{
        background-color: #5C8E48;
        color: #fff;
    }
</style>

<body>
    <!-- Navigation -->
    <?php 
        include 'includes/nav.php';
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row" style="margin: auto;">

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-12" style="max-width: 600px; margin: 20px auto;">

                  <!-- user login -->
<?php 
if(!$_SESSION['username']) {
                echo "<div id='box-2' class='well' style='color: #fff; border-radius: 10px;'>";
                    echo "<h4>User Login</h4>";
                    echo "<form action='includes/login.php' method='POST'>";
                    echo "<div class='form-group'>";
                    echo "<input name='username' type='text' class='form-control' placeholder='username'>";
                    echo "</div>";
                    echo "<div class='input-group'>";
                    echo "<input name='password' type='password' class='form-control' placeholder='password'>";
                    echo "<span class='input-group-btn'>";
                    echo "<button name='login' id='bb' class='btn btn-primary bta' type='submit'>Login </button>";
                    echo "</span>";
                    echo "</div>";
                    echo "</form>"; 
                echo "</div>";
}
?>
              <!-- Blog  Well -->
                <div id='box' class="well" style=' border-radius: 10px;'>

                <!-- Side Widget Well -->
               <?php include "includes/widget.php";?>

                </div>
        </div>

        </div>
        <!-- /.row -->

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

    <script>
          let rr = Math.floor(Math.random() * 999);
           $('#box, #box-2, #bb').css('background-color', '#'+rr);
           $('#box').css('color', '#'+rr);
    </script>

</body>

</html>


