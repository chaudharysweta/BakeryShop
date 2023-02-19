<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Cake</h1>
        <br><br>

        <?php
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload']; //displaying session messgae
            unset($_SESSION['upload']); //removing session message
        }
        
        
        ?>
        <?php
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //adding food in database
            //echo "clicked";
            //1.get the data from form 
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];

            //check whether radio button for featured and active are checked or not
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                $featured="No";//setting default value
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";//setting default value
            }

            //2.upload the image if selected
            //check select button is cliced or not and upload the image only if theimage is selected
            if(isset($_FILES['image']['name']))
            {
                //get the detail of the image 
                $image_name=$_FILES['image']['name'];

                //check the image is selected or not and upload selected image
                if($image_name!="")
                {
                    //image is selected
                    //a. rename the image
                    //get extension of selected image like jpg,png gif...etc. ("SwetaRaj.jpg-old name")
                    //$ext=end(explode('.', $image_name));

                    //create the new name for image
                    //$image_name="Cake-Name-".rand(0000,9999).".".$ext;//new image name may be "Food-Name-657.jpg

                    //b. upload the image
                    //get the source path and dwstinaton path

                    //source path is the current location of the image
                    $src=$_FILES['image']['tmp_name'];

                    //destination path for image to upload
                    $dst="../images/cake/".$image_name;

                    //finally upload the food image
                    $upload=move_uploaded_file($src,$dst);

                    //check image uploaded or not
                    if($upload==false)
                    {
                        //failed to upload image
                        //redirect to add cake pg with error message
                        $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                        header('location:'.SITEURL.'Admin/add-cake.php');
                        //stop process
                        die();
                    }
                }
            }
            else
            {
                $image_name="";//setting default value as blank
            }

            //3.insert into database

            //create a sql query to save cakes
            //for numerical value we donot need to pass value inside quotes '' but for string value it is compulsory to add quotes ''
            $sql2="INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            ";

            //execute to query
            $res2=mysqli_query($conn,$sql2);
            //check whether data inserted or not
            //4.redirect with message to manage food page

            if($res2==true)
            {
                //data is inserted 
                $_SESSION['add']="<div class='success'> Cake added succesfully</div>";
                //redirect page to manage admin
                header('location:'.SITEURL.'Admin/manage-cake.php');
            }
            else
            {
                //data is not inserted 
                $_SESSION['add']="<div class='error'> Failed to add cake</div>";
                //redirect page to manage admin
                 header('location:'.SITEURL.'Admin/manage-cake.php');
            }

            
        }
        
        
        
        ?>


        <form action=""method="POST"enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title"placeholder="Enter title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description"  cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number"name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select_Image:</td>
                    <td>
                        <input type="file"name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >

                            <?php
                            //create php code to display categories from db

                            //create sql to get active categories from db
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                             //execute query
                            $res=mysqli_query($conn,$sql);

                            //count rows to checks whether we hve categories or not
                            $count=mysqli_num_rows($res);

                            //if count > then zero else dont have category
                            if($count>0)
                            {
                                //have category
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of category
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php
                                }
                            }
                            else
                            {
                                //dont have category
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            //display on


                            ?>

                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured"value="Yes"> Yes
                        <input type="radio" name="featured"value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                    <input type="radio" name="active"value="Yes"> Yes
                    <input type="radio" name="active"value="No"> No
                    </td>
                </tr>
                <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Cake" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>
        


    

    </div>
</div>


<?php include('partials/footer.php') ?>