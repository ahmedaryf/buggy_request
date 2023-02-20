<?php session_start(); ?>
<?php //include 'includes/db.pdo.php'; ?>
<?php

   $time_zone = date_default_timezone_set("Asia/Dhaka");
    $today = date("Y-m-d");

if (isset($_SESSION['username'])) {

    echo "<div class='well' style='background-color: #fff;'>";
    echo "<h4 class='text-center'>Daily activities</h4>";
    echo "<h5>".date('d F Y')."</h5>";
    echo "<hr>";
    echo "<ul>";

    $query = "SELECT * FROM activities WHERE active_date = '$today' ORDER BY start_time ASC";
    // $select_activity = mysqli_query($db_connection, $query);
    $activities = $db_connection->query($query);
   
    foreach($activities as $activity) {
    echo "<li style='margin: 15px 0;'>".$activity["active_name"]. " at ".$activity["start_time"]." - ".$activity["end_time"]. "</li>";
    }
    echo "</ul>";
    echo "</div>";

} else {
    echo "<div class='well' style='background-color: #fff; text-align: center'>";
    echo "<h4>".date('l d F Y')."</h4>";
    echo "</div>";
}
$db_connection = null;
?>

