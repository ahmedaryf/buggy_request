<?php session_start(); ?>
<?php $time_zone = date_default_timezone_set("Asia/Dhaka");?>
<?php $to = date('Y-m-d');

$time = date('H:i:s');
$today = date('d-m-Y');            
$d = date('Y/m/d',strtotime("0 days"));
$de = date('Y-m-d', strtotime($d));

//select date
$d = date('Y-m-d');
if (isset($_POST['d_submit'])) {
  $d = $_POST['edate'];
}

?>
<style>
    body{
        width: 100%;
        margin: 20px auto;
    }
      .on{
            background-color: #db0909;
            padding: 5px 8px;
            border-radius: 5px;
            color: #fff;
           
        }
        .on:hover{
            text-decoration: none;
            color: #fff;
            background-color: #006236;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
        .delete{
            background-color: #006236;
            padding: 5px 8px;
            border-radius: 5px;
            color: #fff;
           
        }
        .delete:hover{
            background-color: #db0909;
            color: #fff;
            text-decoration: none;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }

        th{
            background-color: #006236;
            
            color: #fff;
        }
        tr{
            background-color: #468D73;
            padding: 5px 10px;
            color: #fff;
        }
        tr:hover{
            background-color: #6BBD74;  
        }
        .button{
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            background-color: #006236;
            color: #fff;
        }
        .button:hover{
            background-color: #468D73;
            color: #fff;
        }
        .pdd{
            padding: 0 10px;
        }

          /* if the screen is bigger than 900px then content invisible */
        @media only screen and (min-width: 900px) {
            .mobile {
                display: none;      
            }
        }

        @media only screen and (max-width: 900px) {
            body{
                width: 100%;
                margin: 20px auto;
                }
            .desktop {
                display: none;     
            }
        }

        .nav-1{
            width: 100%;
            height: 60px;
            background-color: #006236;
            display: flex;
        }
        .tb{
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        .name{
            text-align: center;
            color: #fff;
            padding-top: 8px;
        }
        .nav-ul{
            text-align: center;
            padding-top: 10px;
            
           
        }
        .nav-ul li{
            background-color: #006345;
            width: 130px;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 5px;
            display: inline;
            margin-left: 10px;
        }
        .nav-ul li a{
            color: #fff;
            text-decoration: none; 
            
        }
     
       
</style>
<div class="desktop">
<div style="overflow:scroll">
<form action="" method="POST" style="float: right;">
    <input type="date" name="edate" value="<?php echo  $d ?>" class="form-group pdd">
    <input type="submit" name="d_submit" value="Filter" class="btn btn-primary button">
</form>
<form action="../generate.pdf.php" method="POST" style="float: right; padding-right: 10px;">
    <input type="date" name="date" value="<?php echo  $d ?>" class="form-group pdd" style="display: none;" >
    <?php 
            if ($_SESSION['user_role'] === 'admin') {
                echo "<input type='submit' name='report' value='Report' id='date' class='btn btn-primary button'>";
            }
    ?>
</form>
<a class='btn btn-primary button' href="../buggy.php">New Request</a>

<table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>VILLA</th>
                                    <th>NAME</th>
                                    <th>FROM</th>
                                    <th>TIME</th>
                                    <th>REQ BY</th>
                                    <th>DONE BY</th>
                                    <th>TIME</th>
                                    <th>DURATION</th>
                                    <th>ACTION</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                       
                      <?php 




// $time_zone = date_default_timezone_set("Asia/Dhaka");
// $time = date('H:i:s');
// $today = date('d-m-Y');            
// $d = date('Y/m/d',strtotime("0 days"));

// if (isset($_POST['d_submit'])) {
//     $d = $_POST['edate'];
     
//  }
//  echo "<h4 style='text-align: center;'>".$de = date('d F Y', strtotime($d))."</h4>";

                             $query = "SELECT * FROM buggy WHERE e_date = '$d' ORDER BY buggy_id DESC ";
                             $select_buggy = mysqli_query($conn, $query);
                       
                       
                             while ($row = mysqli_fetch_assoc($select_buggy)) {
                             $buggy_id = $row['buggy_id'];
                             $villa = $row['villa'];
                             $name = $row['name'];
                             $from = $row['r_from'];
                             $rtime = $row['rtime'];
                             $status = $row['dstatus'];
                             $dtime = $row['dtime'];
                             $duration = $row['duration'];
                             $done_by = $row['done_by'];
                             $req_by = ucwords($row['req_by']);
                             $time_date = date('H:i');
                            $rtime = date('H:i', strtotime($rtime));
                            // $dtime = date('H:i', strtotime($dtime));

                            $query = "SELECT * FROM users WHERE username = '$req_by'";
                            $send_message = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($send_message)) {
                              $usid = $row['user_id'];
                              $contect = $row['user_email'];
                              $user = $row['username'];
                            }
                //    echo $time_date;
                
                            
                             echo "<tr>";
                            //  echo "<td>{$buggy_id}</td>";
                             echo "<td>{$villa}</td>";
                             echo "<td>{$name}</td>";
                             echo "<td>{$from}</td>";
                             echo "<td>{$rtime}</td>";
                            //  echo "<td>{$req_by}</td>";
                             echo "<td><a style='text-decoration: none; color: #fff;' href='https://api.whatsapp.com/send?phone={$contect}&text=Buggy is here but no guest!!&source=&data='>{$req_by}</a></td>";
                             echo "<td>{$done_by}</td>";
                             echo "<td>{$dtime}</td>";
                             echo "<td>{$duration} Min</td>";

                         
                            if ($status == 'Pending') {
                               echo "<td><a class='on' onClick=\"javascript: return confirm('Are you sure?'); \" href='buggies.php?done={$buggy_id}'>Pending</a></td>";
                            } else {
                                echo "<td>$status</td>";
                            }
                             
                            
                            if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'sp') {
                                echo "<td><a class='delete' href='buggies.php?source=edit_buggy&buggy_id={$buggy_id}'>Edit</a></td>";
                               } else{echo "<td>Edit</td>"; }
                            //  echo "<td><a href='comments.php?done={$comment_id}'>Done</a></td>";
                            //  echo "<td><a href='comments.php?pending={$comment_id}'>Pending</a></td>";

                            if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'sp') {
                                echo "<td><a class='delete' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='buggies.php?delete={$buggy_id}'>Delete</a></td>";
                               } else {echo "<td>Delete</td>";}
                            
                            //  echo "<td><a class='delete' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='buggies.php?delete={$buggy_id}'>Delete</a></td>";
                             
                         echo "</tr>";

                             }
                      ?>

                            </tbody>
                        </table>
                        </div>
                        <?php
                        $by = ucwords($_SESSION['username']);

                        if (isset($_GET['done'])) {
                                                                            
                            $buggy_done = $_GET['done'];

                            $query = "SELECT * FROM buggy WHERE buggy_id = $buggy_done";
                            $select_buggy = mysqli_query($conn, $query);
                       
                            while ($row = mysqli_fetch_assoc($select_buggy)) {
                                $com_id = $row['comment_id'];
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
                             


                            $query = "UPDATE buggy SET dstatus = 'Done', dtime = '$Requested', done_by = '$by', duration = '$duration_min' WHERE buggy_id = $buggy_done ";

                            $done_query = mysqli_query($conn, $query);
                            
                            header('Location: buggies.php');
                        }

                        if (isset($_GET['pending'])) {
                                                    
                            $comment_pending = $_GET['pending'];

                            $query = "UPDATE buggy SET dstatus = 'pending', dtime = null, done_by = null, duration = null WHERE buggy_id = $comment_pending  ";

                            $pending_query = mysqli_query($conn, $query);
                            header('Location: buggies.php');
                        }


                        if (isset($_GET['delete'])) {
                            if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'sp') {
                            $buggy_id = mysqli_real_escape_string($conn, $_GET['delete']);

                            $query = "DELETE FROM buggy WHERE buggy_id = $buggy_id ";

                            $delete_buggy_query = mysqli_query($conn, $query);
                            header('Location: buggies.php');
                            }
                        }

                        ?>
                        </div> <!-- end desktop-->


                        <div class="mobile" style="padding: 0;">
<!-- <nav class="nav-1">
    <ul class="nav-ul">
        <li>
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
        </li>
        <li>
            <a href=""style="background-color: #00512D;"><i class="fa-solid fa-person"></i>Online - <?php //echo users_online(); ?></a>
        </li>
    </ul>

</nav> -->

<h4 class="media-heading name" style="color: #006236; margin:0;">
Welcome <?php echo ucwords($_SESSION['lastname']) ; ?>
</h4>
<?php $time_zone = date_default_timezone_set("Asia/Dhaka");?>
<?php $to = date('Y-m-d') ?>
<div style="overflow:scroll">

<a class='btn button' href="../buggy.php">New Request</a>
<table class="table table-bordered tb" style="margin: 0 auto ;" >
                            <thead>
                                <tr style="font-size:1rem ;">
                                   
                                    <th>VILLA</th>
                                    <th>FROM</th>
                                    <th>TIME</th>
                                    <th>REQ BY</th>
                                    <th>DONE BY</th>
                                    <th>MINS</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                       
                      <?php 

$time_zone = date_default_timezone_set("Asia/Dhaka");
$time = date('H:i:s');
$today = date('d-m-Y');            
$d = date('Y/m/d',strtotime("0 days"));

if (isset($_POST['d_submit'])) {
    $d = $_POST['edate'];
     
 }
 echo "<h5 style='text-align: center; color: #000;'>".$de = date('d F Y', strtotime($d))."</h5>";

                             $query1 = "SELECT * FROM buggy WHERE e_date = '$d' ORDER BY buggy_id DESC ";
                             $select_buggy1 = mysqli_query($conn, $query1);
                       
                             while ($row = mysqli_fetch_assoc($select_buggy1)) {
                             $buggy_id1 = $row['buggy_id'];
                             $villa1 = $row['villa'];
                             $name1 = $row['name'];
                             $from1 = $row['r_from'];
                             $rtime1 = $row['rtime'];
                             $req_by = ucwords($row['req_by']);
                             $status1 = $row['dstatus'];
                             $dtime1 = $row['dtime'];
                             $duration1 = $row['duration'];
                             $done_by1 = $row['done_by'];
                             $time_date1 = date('H:i');
                
                             $query = "SELECT * FROM users WHERE username = '$req_by'";
                             $send_message = mysqli_query($conn, $query);
 
                             while ($row = mysqli_fetch_assoc($send_message)) {
                               $usid = $row['user_id'];
                               $contect = $row['user_email'];
                               $user = $row['username'];
                             }
                            
                             echo "<tr>";
                             echo "<td><strong>{$villa1}</strong></td>";
                             echo "<td>{$from1}</td>";
                             echo "<td>{$rtime1}</td>";
                             echo "<td><a style='text-decoration: none; color: #fff;' href='https://api.whatsapp.com/send?phone={$contect}&text=Buggy is here but no guest!!&source=&data='>{$req_by}</a></td>";
                            //  echo "<td>{$status}</td>";
                             echo "<td>{$done_by1}</td>";
                            //  echo "<td>{$dtime}</td>";
                             echo "<td>{$duration1}</td>";

                         
                            if ($status1 == 'Pending') {
                               echo "<td><a class='on' href='buggies.php?done={$buggy_id1}'>pending</a></td>";
                            } else {
                                echo "<td>Done</td>";
                            }
                                echo "</tr>";

                             }

                      ?>

                        </tbody>
                        </table>
                        </div>
                        
                        <?php
                        // $by = ucwords($_SESSION['username']);

                        // if (isset($_GET['done'])) {
                                                                            
                        //     $buggy_done = $_GET['done'];

                        //     $query = "SELECT * FROM buggy WHERE buggy_id = $buggy_done";
                        //     $select_buggy = mysqli_query($conn, $query);
                       
                        //     while ($row = mysqli_fetch_assoc($select_buggy)) {
                        //         $com_id = $row['buggy_id'];
                        //         $stime = $row['rtime'];
                        //         $etime = $row['dtime'];
                        //     }
                        //     // calculates duration in minutes
                        //      $start = strtotime($stime);
                        //      $end = strtotime($time);
                        //      $mins = ($end - $start) / 60 ;
                        //      $duration_min = round($mins);

                             


                        //     $query = "UPDATE buggy SET dstatus = 'done', dtime = now(), done_by = '$by', duration = '$duration_min' WHERE buggy_id = $buggy_done ";

                        //     $done_query = mysqli_query($conn, $query);
                            
                        //     header('Location: buggies.php');
                        // }

                     ?>
                     

                  </div> <!--mobile closed-->

                  