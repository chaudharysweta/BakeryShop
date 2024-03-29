
<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
                <h1>Update Category</h1>
                <br/>
                <br/>

                <?php

                //check wheather the id is set or not
                if(isset($_GET['id']))
                {
                    //get the id and all other details
                    //echo "Getting the data";
                    $id=$_GET['id'];
                    //create sql query to get all the details
                    $sql="SELECT * FROM tbl_category WHERE id=$id";
                    //execute the query
                    $res=mysqli_query($conn,$sql);
                    //count the ros to check whether the id is valid or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get all the data
                        $row=mysqli_fetch_assoc($res);
                        $title=$row['title'];
                        $current_image=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                    }
                    else
                    {
                        //redirect to manage category
                        $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
                        //redirect manage category page
                        header("location:".SITEURL.'Admin/manage-category.php');
                    }
                }
                else
                {
                    //redirect to manage category
                    header('location:'.SITEURL.'Admin/manage-category.php');
                }

                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td>
                                <input type="text" name="title" value="<?php echo $title; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Current_image:</td>
                            <td>
                                <?php

                                if($current_image!="")
                                {
                                    //display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="200px">
                                    <?php
                                }
                                else
                                {
                                    //display message
                                    echo "<div class='error'>Image Not Added.</div>"; 
                                }
                                
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>New_Image:</td>
                            <td>
                                <input type="file"name="image">
                            </td>
                        </tr>
                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                            </td>
                        </tr>
                        <tr>
                            <td>Active</td>
                            <td>
                            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No"> No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>

                <?php
                if(isset($_POST['submit']))
                {
                   // echo "clicked";
                   //get all the values from form
                   $id=$_POST['id'];
                   $title=$_POST['title'];
                   $current_image=$_POST['current_image'];
                   $featured=$_POST['featured'];
                   $active=$_POST['active'];


                   //updating new images if selected
                   //check image selected or not
                   if(isset($_FILES['image']['name']))
                   {
                    //get the image detail
                    $image_name=$_FILES['image']['name'];

                    //check image is available or not
                    if($image_name !="")
                    {
                        //image available
                        //upload new image 
                              //auto rename image
                //get the extension of the image(eg- vanila.jpg)
                $ext=end(explode('.',$image_name));

                //rename the image
                $image_name="cake_category_".rand(000,999).'.'.$ext; //eg. cake_category_834.jpg


                $source_path=$_FILES['image']['tmp_name'];

                $destination_path="../images/category/".$image_name;

                //upload image
                $upload=move_uploaded_file($source_path,$destination_path);

                //check whether the image is uploaded or not
                //if image is not uploaded the we will stop the process and redirect with eoor message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload']="<div class='error'> Failed to upload image.</div>";
                    //redirect page to add category
                    header("location:".SITEURL.'Admin/manage-category.php');
                    //stop the process
                    die();

                }



                        //remove image
                        if($current_image!="")
                        {
                        $remove_path="../images/category/".$current_image;
                        $remove=unlink($remove_path);
                        //check image is removed or not
                        //if failed stop the process
                        if($remove==false)
                        {
                            //failed to remove image
                            $_SESSION['failed-remove']="<div class='error'> Failed to remove current image.</div>";
                            header("location:".SITEURL.'Admin/manage-category.php');
                            die();

                        }
                         

                        }
                    }
                    else
                    {
                        $image_name=$current_image;
                    }
                   }
                   
                   else
                   {
                    $image_name=$current_image;
                   }

                   //update the database
                   $sql2="UPDATE tbl_category SET
                   title='$title',
                   image_name='$image_name',
                   featured='$featured',
                   active='$active'
                   WHERE id=$id
                   ";

                   //execute query
                   $res2=mysqli_query($conn,$sql2);


                   //redirect to manage category with message
                   if($res2==true)
                   {
                    //category updated
                    $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
                    //redirect manage category page
                    header("location:".SITEURL.'Admin/manage-category.php');

                   }
                   else{
                    //not updated
                    $_SESSION['update']="<div class='error'>Category Not Updated.</div>";
                    //redirect manage category page
                    header("location:".SITEURL.'Admin/manage-category.php');
                   }




                }
                
                ?>
    </div>
</div>






<?php include('partials/footer.php') ?> 
