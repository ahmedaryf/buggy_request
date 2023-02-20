<?php
include '../includes/db.php';


function buggy_count() {

    global $conn;
    $t = date('Y/m/d');

    $query = "SELECT * FROM buggy WHERE e_date = '$t'";

    $select_all_comments = mysqli_query($conn, $query);
    $comment_count = mysqli_num_rows($select_all_comments);

    echo $comment_count;

}
function user_count() {

    global $conn;

    $query = "SELECT * FROM users";

    $select_all_users = mysqli_query($conn, $query);
    $user_count = mysqli_num_rows($select_all_users);

    echo $user_count;
}



?>