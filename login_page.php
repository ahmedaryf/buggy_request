<div id="login" class="login">
                                  <!-- user login -->
<?php 
if(!$_SESSION['username']) {
                    echo "<div class='well'>";
                    echo "<h4>User Login</h4>";
                    echo "<form action='includes/login.php' method='POST'>";
                    echo "<div class='form-group'>";
                    echo "<input name='username' type='text' class='form-control' placeholder='username'>";
                    echo "</div>";
                    echo "<div class='input-group'>";
                    echo "<input name='password' type='password' class='form-control' placeholder='password'>";
                    echo "<span class='input-group-btn'>";
                    echo "<button name='login' class='btn btn-primary' type='submit'>Login </button>";
                    echo "</span>";
                    echo "</div>";
                    echo "</form>"; 
                    echo "</div>";
}
?>
    <div class="well2">
        <h1>This is so cool!!</h1>
    </div>
            </div>

    