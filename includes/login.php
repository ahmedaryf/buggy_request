
<?php include 'db.php';?>

<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // $query = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1 ";
    $query = "SELECT * FROM users WHERE username = ? LIMIT 1";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $u_id = $row['user_id'];
        $u_name = $row['username'];
        $u_password = $row['user_password'];
        $u_firstname = $row['user_firstname'];
        $u_lastname = $row['user_lastname'];
        $u_role = $row['user_role'];
    }
     
    if (password_verify($password, $u_password)) {
        $_SESSION['userid'] =  $u_id;
        $_SESSION['username'] =  $u_name;
        $_SESSION['firstname'] =  $u_firstname;
        $_SESSION['lastname'] =  $u_lastname;
        $_SESSION['user_role'] =  $u_role;

        header('Location: ../admin/buggies.php');
        
     }  else {
            header('Location: ../index.php');
       
     }

}

    // $select_user = mysqli_query($conn, $query);

    // if (!$select_user) {
    //     die('No user found'. mysqli_error($conn));
    // }

    // while ($row = mysqli_fetch_assoc($select_user)) {
    //     $u_id = $row['user_id'];
    //     $u_name = $row['username'];
    //     $u_password = $row['user_password'];
    //     $u_firstname = $row['user_firstname'];
    //     $u_lastname = $row['user_lastname'];
    //     $u_role = $row['user_role'];
    // }


?>