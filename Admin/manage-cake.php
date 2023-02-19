<?php include('partials/menu.php'); ?>

<div class="main-content">
            <div class="wrapper">
                <h1>Manage Cake</h1>
                <br><br><br>
                <a href="<?php echo SITEURL; ?>Admin/add-cake.php" class="btn-primary1">Add Cake</a>
                <br><br><br>

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
                if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];
                    unset($_SESSION['remove-failed']);
                }
                
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }
                
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                


                ?>


                
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                    //create sql query to get all the cake
                    $sql="SELECT * FROM tbl_food";

                    //execute the query
                    $res=mysqli_query($conn,$sql);

                    //count rows to check cake we have or not
                    $count=mysqli_num_rows($res);

                    //create serial number
                    $sn=1;

                    if($count>0)
                    {
                        //we have cake in database
                        //get the food from databse and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the value form individual columns
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            ?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $title;?></td>
                        <td><?php echo $price;?></td>
                        <td>
                            <?php 

                            //chcek we have image or not
                            if($image_name=="")
                            {
                                //we do not have image ,display error ,msg
                                echo "<div class='error'>Image not Added. </div>";
                            }
                            else
                            {
                                //we have image
                                ?>
                                <img src="<?php echo SITEURL;?>images/cake/<?php echo $image_name; ?>" width="100px">
                                <?php
                            }
                            
                            ?>
                            
                        </td>
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>Admin/update-cake.php?id=<?php echo $id; ?>" class="btn-secondary">Update Cake</a>
                            <a href="<?php echo SITEURL; ?>Admin/delete-cake.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Cake</a>
                        </td>
                    </tr>



                            <?php
                        }
                    }
                    else{
                        //cake not added in database
                        echo "<tr><td colspan='7' class='error'>Food  not added yet.</td></tr>";
                    }
                


                    ?>

                </table>


                
            </div>
        </div>


<?php include('partials/footer.php') ?> 