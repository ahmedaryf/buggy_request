<?php session_start(); ?>

<style>
    .login{
        width: 400px;
        transform: translateY(-500px);
       
        transition: all .5s;
    }
    .mylogin{
        transform: translateY(200px);
        display: block;
        transition: all .5s;
        z-index: 1000;
    }
   
</style>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#00512D;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">LAZY OFFICE APP</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php

                ?>
                    <?php
                    if ($_SESSION['username']) {
                        
                    echo "<li>
                        <a href='admin'>DASHBOARD</a>
                    </li>";
                    echo "<li>
                    <a href='admin/buggies.php'>BUGGY REQUEST</a>
                    </li>";
                    echo "<li >
                        <a style='color: #FF6363;' href='includes/logout.php'>LOGOUT</a>
                    </li>";
                    
                    }

                    ?>
                    

                    <?php

                        if (isset($_SESSION['username'])) {
                           if (isset($_GET['p_id'])) {
                            $the_inhouse_id = $_GET['p_id'];
                            
                            echo "<li><a href='admin/inhouse_list.php?source=edit_inhouse&p_id={$the_inhouse_id}'>EDIT </a></li>";

                           }
                        }

                    ?>
                   
                  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


