<?php include('partials/menu.php'); ?>

        <!--Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <H1>Manage Admin</H1>
                <br/>
                
                <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //displaying session messgae
                    unset($_SESSION['add']); //removing session message
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete']; //displaying session messgae
                    unset($_SESSION['delete']); //removing session message
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update']; //displaying session messgae
                    unset($_SESSION['update']); //removing session message
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found']; //displaying session messgae
                    unset($_SESSION['user-not-found']); //removing session message
                }
                if(isset($_SESSION['password-not-match']))
                {
                    echo $_SESSION['password-not-match']; //displaying session messgae
                    unset($_SESSION['password-not-match']); //removing session message
                }
                if(isset($_SESSION['change-password']))
                {
                    echo $_SESSION['change-password']; //displaying session messgae
                    unset($_SESSION['change-password']); //removing session message
                }
                    
                ?>
                <br><br><br>

                <!--Add button-->
                <a href="add-admin.php" class="btn-primary1">Add Admin</a>
                <br/>
                <br/>
                <br/>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all admin
                    $sql="SELECT * FROM tbl_admin";
                    //execute the query
                    $res=mysqli_query($conn,$sql);

                    //check whether the query is executed or not
                    if($res==TRUE)
                    {
                        //count rows to check whether we have data in database or 
                        
                        $rows=mysqli_num_rows($res);

                        $sn=1; //create a variable and assign the value

                        //check the rows
                        if($rows>0)
                        {
                            // have data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //while loop to get all the data from database

                                //get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username']; 
                                
                                //dispaly the value in table
                                ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>Admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL;?>Admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a> 
                            <a href="<?php echo SITEURL;?>Admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            
                        </td>
                    </tr> 


                                <?php
                            }
                        }
                        else{
                            //we donot have data
                        }
                    }
                    ?>


                </table>
            </div>
        </div>
        <!--Main Content Section Ends-->
  

<?php include('partials/footer.php') ?>        