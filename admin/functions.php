<?php 

function users_online() {

global $conn;

$time_zone = date_default_timezone_set("Asia/Dhaka");
$session = session_id();
$time = time();
$time_out_seconds = 30;
$timeout = $time - $time_out_seconds;

$query = "SELECT * FROM users_online WHERE user_session = '$session'";
$send_query = mysqli_query($conn, $query);
$count = mysqli_num_rows($send_query);

if ($count == NULL) {
    mysqli_query($conn, "INSERT INTO users_online(user_session, user_time) VALUE ('$session', '$time')");
} else {
    mysqli_query($conn, "UPDATE  users_online SET user_time = '$time' WHERE user_session = '$session' ");
}

$users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE user_time > '$timeout'");
return $count_user = mysqli_num_rows($users_online_query);

}


function delete_categories() {
    global $conn;
    // this is delete query
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        mysqli_query($conn, $query);
        header('Location: categories.php');
    }
    // if (!$delete_cat) {
    //     die("Query failled");
    //  }
}

function display_categories() {
    global $conn;
      // category table display dynamically fron database
      $query = "SELECT * FROM categories LIMIT 10";
      $select_categories = mysqli_query($conn, $query);


      while ($row = mysqli_fetch_assoc($select_categories)) {
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];

          echo "<tr>";
          echo "<td>{$cat_id}</td>";
          echo "<td>{$cat_title}</td>";
          echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
          echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
          echo "</tr>";
      }
}

function update_categories() {
        global $conn, $cat_id;
         // this is update query
         if (isset($_POST['edit'])) {
            $edit_cat_title = $_POST['cat_title'];

            $query = "UPDATE categories SET cat_title = '$edit_cat_title' WHERE cat_id = {$cat_id}";
            $edit_cat_title = mysqli_query($conn, $query);
            header('Location: categories.php');

            if (!$edit_cat_title) {
                die("Query failled".mysqli_error($conn));
             }
        }
}

