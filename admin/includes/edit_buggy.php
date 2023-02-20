<?php session_start(); ?>
<style>
      .button{
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            background-color: #006236;
            color: #fff;
        }
        .button:hover{
            background-color: #468D73;
            color: #fff;
        }
        .on{
            background-color: #db0909;
            padding: 5px 8px;
            border-radius: 5px;
            color: #fff;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
        .on:hover{
            text-decoration: none;
            color: #fff;
            background-color: #006236;
        }
</style>
<?php
$by = ucwords($_SESSION['username']);

if (isset($_GET['buggy_id'])) {

   $buggy_id = $_GET['buggy_id'];

}

$query = "SELECT * FROM buggy WHERE buggy_id = '$buggy_id'";
$select_buggy = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($select_buggy)) {
$buggy_id = $row['buggy_id'];
$villa = $row['villa'];
$name = $row['name'];
}

if (isset($_POST['update_buggy'])) {

    $villa_number = mysqli_real_escape_string($conn, $_POST['villa_number']);
    $guest_name = mysqli_real_escape_string($conn, $_POST['guest_name']);
    
            $query = "UPDATE buggy SET villa = ?, name = ? WHERE buggy_id = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("isi", $villa_number, $guest_name, $buggy_id);
            $stmt->execute();
            $stmt->close();
            header('Location: buggies.php');
}

if (isset($_POST['cancel_buggy'])) {

    $query = "SELECT * FROM buggy WHERE buggy_id = $buggy_id";
    $select_buggy = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_buggy)) {
        $bug_id = $row['buggy_id'];
        $stime = $row['rtime'];
        $etime = $row['dtime'];

    }
    // calculates duration in minutes
    $time_zone = date_default_timezone_set("Asia/Dhaka");
     $start = strtotime($stime);
     $end = strtotime($time);
     $mins = ($end - $start) / 60 ;
     $duration_min = round($mins);
     $Requested = date('H:i:s');

    $query = "UPDATE buggy SET dstatus = 'Cancelled', dtime = '$Requested', done_by = '$by',duration = '$duration_min' WHERE buggy_id = '$buggy_id' ";

    $cancel_query = mysqli_query($conn, $query);
    
    header('Location: buggies.php');
}
?>
<div class="col-lg-6">
<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Villa Number</label>
    <input value="<?php echo $villa; ?>" type="text" class="form-control" name="villa_number">
</div>

<div class="form-group">
    <label for="author">Guest Name</label>
    <input value="<?php echo $name; ?>" type="text" class="form-control" name="guest_name">
</div>

<div class="form-group">
    <input type="submit" class="btn button" name="update_buggy" value="Update">
    <?php
     $query = "SELECT * FROM buggy WHERE buggy_id = '$buggy_id'";
     $select_buggy = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($select_buggy)) {
        $status = $row['dstatus'];
    if ($status == 'Pending') {
        echo "<input onClick=\"javascript: return confirm('Are you sure you want to cancel?'); \" type='submit' class='btn on' name='cancel_buggy' value='Cancel'>";
    } else{
        echo "";
    }
}
    ?>
</div>

</form>
</div>