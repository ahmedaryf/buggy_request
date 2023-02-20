
<?php session_start(); ?>
<style>
     body{
        width: 90%;
        margin: 20px auto;
    }
       th{
            background-color: #734002;
            
            color: #fff;
        }
        tr{
            background-color: #996025;
            padding: 5px 10px;
            color: #fff;
        }
        tr:hover{
           
            background-color: #e68005;
        }
        .on{
            background-color: #734002;
            padding: 5px 8px;
            border-radius: 5px;
            color: #fff;
           
        }
        .on:hover{
            text-decoration: none;
            color: #fff;
            background-color: #ff0303;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
       
        .edit{
            background-color: #734002;
            padding: 5px 15px;
            border-radius: 5px;
            color: #fff;
            
            
        }
        .edit:hover{
            text-decoration: none;
            color: #734002;
            background-color: #FFCA8A;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
       
</style>
<div style="overflow:scroll">
<table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody> 
                       
                      <?php 
                             $query = "SELECT * FROM users ";
                             $select_user = mysqli_query($conn, $query);
                       
                             while ($row = mysqli_fetch_assoc($select_user)) {
                             $user_id = $row['user_id'];
                             $user_name = $row['username'];
                             $user_firstname = $row['user_firstname'];
                             $user_lastname = $row['user_lastname'];
                             $user_email = $row['user_email'];
                             $user_role = $row['user_role'];
                             $user_date = $row['user_date'];
                            
                             echo "<tr>";
                             echo "<td>{$user_id}</td>";
                             echo "<td>{$user_name}</td>";
                             echo "<td>{$user_firstname}</td>";
                             echo "<td>{$user_lastname}</td>";
                             echo "<td>{$user_email}</td>";
                             echo "<td>{$user_role}</td>";
                             echo "<td>{$user_date}</td>";
                             
                            if ($_SESSION['user_role'] === 'admin') {
                             echo "<td><a class='edit' href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
                            } else{echo "<td>Edit</td>"; }
                            if ($_SESSION['user_role'] === 'admin') {
                             echo "<td><a class='on' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='users.php?delete={$user_id}'>Delete</a></td>";
                            } else {echo "<td>Delete</td>";}
                         echo "</tr>";

                             }
                             echo "<p style='color: #734002;'>". ucwords($_SESSION['user_role'])."</p>";
                      ?>

                            </tbody>
                        </table>
</div>
                        <?php

                        if (isset($_GET['delete'])) {
                            
                              if ($_SESSION['user_role'] === 'admin') {
                               
                                $u_id = mysqli_real_escape_string($conn, $_GET['delete']) ;

                                $query = "DELETE FROM users WHERE user_id = $u_id ";

                                $delete_user_query = mysqli_query($conn, $query);
                                header('Location: users.php');

                              } 
                        }

                        ?>