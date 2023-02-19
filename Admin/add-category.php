<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add']; //displaying session messgae
            unset($_SESSION['add']); //removing session message
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload']; //displaying session messgae
            unset($_SESSION['upload']); //removing session message
        }
        ?>
         <br><br>

        <!--Add cateegory starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>Select_Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                    </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio"name="active" value="Yes"> Yes
                        <input type="radio"name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Add category ends-->

        <?php
        //check button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "clicked";

            //1. get the value from category
            $title=$_POST['title'];

            //for radio input we need to check button is clicked or not
            if(isset($_POST['featured']))
            {
                //get the value
                $featured=$_POST['featured'];
            }
            else
            {
                //set default value
                $featured="No";
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else{
                $active="No";
            }

            //check image is selected or not and set value for image
            //print_r($_FILES['image']);

            //die();// to break code here

            if(isset($_FILES['image']['name']))
            {
                //upload image
                //to upload image we need image name and source path and destination path
                $image_name=$_FILES['image']['name'];

                //upload the image only if image is selected
                if($image_name !="")
                {

                

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
                    header("location:".SITEURL.'Admin/add-category.php');
                    //stop the process
                    die();

                }
            }


            }
            else{
                //donot set image
                $image_name="";
            }

            //2. create sql query to insert category into database
            $sql="INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //execute the query and save in database
            $res=mysqli_query($conn,$sql);

            //check query executed or not
            if($res==true)
            {
                //query executed and add
                $_SESSION['add']="<div class='success'>Category added succesfully.</div>";
                //redirect page to manage category
                header("location:".SITEURL.'Admin/manage-category.php');
            }
            else{
                //failed adding
                $_SESSION['add']="<div class='error'>Failed to add category.</div>";
                //redirect page to manage category
                header("location:".SITEURL.'Admin/add-category.php');
            }
        }
        ?>
    </div>
</div>









<?php include('partials/footer.php') ?>