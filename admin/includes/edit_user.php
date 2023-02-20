<?php

if (isset($_GET['u_id'])) {

   $u_id = $_GET['u_id'];

}

$query = "SELECT * FROM users WHERE user_id = $u_id";
$select_user_by_id = mysqli_query($conn, $query);
if (!$select_user_by_id) {
    echo 'failed';
}

while ($row = mysqli_fetch_assoc($select_user_by_id)) {
    $user_name = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_password = $row['user_password'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    $user_date = $row['user_date'];


}

if (isset($_POST['update_user'])) {
    

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

            $query = "UPDATE users SET user_firstname = ?, user_lastname = ?, user_email = ?, user_role =  ? WHERE user_id = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssi", $user_firstname, $user_lastname, $user_email, $user_role, $u_id);
            $stmt->execute();
            $stmt->close();

            header('Location: users.php');
}

?>


<form action="" method="POST" enctype="multipart/form-data">

<!-- <div class="form-group">
    <label for="username">User Name</label>
    <input value="<?php //echo $user_name;?>" type="text" class="form-control" name="user_name">
</div> -->

<div class="form-group">
    <label for="firstnamer">Fisrt Name</label>
    <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="lastname">Last Name</label>
    <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
</div>

<!-- <div class="form-group">
    <label for="password">Password</label>
    <input value="<?php //echo $user_password;?>" type="text" class="form-control" name="user_password">
</div> -->

<!-- <div class="form-group">
    <label for="user_image">Image</label>
    <input type="file" name="image">
</div> -->

<div class="form-group">
    <label for="user_email">Contact</label>
    <input value="<?php echo $user_email;?>" type="text" class="form-control" name="user_email">
</div>

<!-- <div class="form-group">
    <label for="user_role">Role</label>
    <input value="<?php //echo $user_role;?>" type="text" class="form-control" name="user_role">
</div> -->

<div class="form-group">
    <label for="user_role">Role</label></br>
    <select name="select_user" id="select_user">
        <option value="user">User</option>
        <option value="admin">Admin</option>
        <option value="sp">sp</option>

    </select>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
</div>

</form>