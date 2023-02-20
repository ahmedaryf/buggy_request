<?php include '../functions.php';?>
<?php include 'header.php';?>
<?php //$time_zone = date_default_timezone_set("Asia/Dhaka");?>
<!-- <meta http-equiv="refresh" content="60"> -->
<style>
    .nn {
        background-color: #00512D;
    }
    .nn:hover{
        background-color: #fff;
    }
    .txt-color{
        color: #006236;
    }
</style>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#00512D;">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">LAZY OFFICE APP</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                     <li >
                        <a href="../index.php" style="background-color: #00512D;"><i class="fa fa-fw fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href="index.php" style="background-color: #00512D;"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <!-- <li>
                        <a href="mobile.php" style="background-color: #00512D;"><i class="fa fa-fw fa-mobile"></i> Mobile</a>
                    </li> -->
                    <?php 
                    if ($_SESSION['user_role'] === 'admin') {
                        echo "<li>";
                          echo  "<a href='../registration.php' style='background-color: #00512D;'><i class='fa fa-fw fa-sign-in'></i>Register</a>";
                       echo "</li>";
                    }

                    ?>
                    <!-- <li>
                        <a href=""style="background-color: #00512D;"><i class="fa fa-fw fa-user"></i>Online <span class="usersonline"></span></a>
                    </li> -->
                       
                    <li>
                        <a href=""style="background-color: #00512D;"><i class="fa fa-fw fa-user"></i>Online - <?php echo users_online(); ?></a>
                    </li>
                <li class="dropdown">
                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown" style="background-color: #00512D;"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                   
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong><?php echo ucwords($_SESSION['firstname']) ; ?></strong>
                                        </h5>
                                        
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Updated: <?php echo date('H:i:s');?></p>
                                        <p>No Messages</p>
                                        <p><small>All rights reserved &copy; 2022</small> </p>
                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>
                
                <?php 
                $d = date('Y-m-d');
                if (isset($_POST['d_submit'])) {
                $d = $_POST['edate'];
                }
                ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #00512D;"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                   
                    <ul class="dropdown-menu alert-dropdown">

                    <li style="margin-left: 15px;" class="txt-color"><h4>Delayed requests</h4></li>
                    <?php
                  
                  $time_zone = date_default_timezone_set("Asia/Dhaka");
                    $to = date('Y-m-d');
                    $time = date('H:i:s');

                    $query = "SELECT * FROM buggy WHERE e_date = '$d' && duration > 15 && dstatus = 'Done'";
                    $select_buggy = mysqli_query($conn, $query);
              
              
                    while ($row = mysqli_fetch_assoc($select_buggy)) {
                    $buggy_id = $row['comment_id'];
                    $villa = $row['villa'];
                    $duration = $row['duration'];
                    $status = $row['dstatus'];
                    $buggy_delay_count = mysqli_num_rows($select_buggy);

                    echo "<li>";
                    echo "<a style='color: #E10B0B;' href='#'>Villa {$villa }"." - "."{$duration} Minutes</a>";
                    echo "</li>";
                   
                    }
                    ?>
                        <li>
                            <a href="#"><?php  if ($buggy_delay_count <= 0) { echo "<h5>No buggy delay</h5>";} ?></a>
                        </li>
                        <li class="divider"></li>
                        <li style="margin-left: 15px;" class="txt-color"><h4>Follow-up requires</h4></li>
                        <?php

                    $query = "SELECT * FROM buggy WHERE e_date = '$to' ";
                    $pending_buggy = mysqli_query($conn, $query);
              
              
                    while ($row = mysqli_fetch_assoc($pending_buggy)) {
                    $buggy_id = $row['comment_id'];
                    $villa = $row['villa'];
                    $duration = $row['duration'];
                    $req = $row['rtime'];
                    $status = $row['dstatus'];
                    $buggy_delay_count = mysqli_num_rows($select_buggy);
                    $req_pending = $time - $req;

                    $start = strtotime($req);
                    $end = strtotime($time);
                    $mins = ($end - $start) / 60 ;
                    $duration_min = round($mins);

                    if ($status === 'Pending' && $duration_min >= 10) {
                        echo "<li>";
                        echo "<a style='color: #E10B0B;' href='#'>Villa {$villa }"." - "."{$duration_min} Minutes</a>";
                        echo "</li>";
                    }
                }
                  
                ?>     
                  
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #00512D;"><i class="fa fa-user"></i> <?php echo ucwords($_SESSION['firstname']); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="user_profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <?php 
                    if ($_SESSION['user_role'] === 'admin') {
                        echo "<li>";
                          echo  "<a href='add_locations.php'><i class='fa fa-fw fa-location-arrow'></i> Locations</a>";
                       echo "</li>";

                       echo "<li>";
                          echo  "<a href='add_activities.php'><i class='fa fa-fw fa-book'></i> Activities</a>";
                       echo "</li>";
                       echo "<li>";
                          echo  "<a href='add_message.php'><i class='fa fa-fw fa-envelope'></i> Message</a>";
                       echo "</li>";

                    }
                    ?>

                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            </div>
            
                </ul>
               
            </div>