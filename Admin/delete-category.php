<?php

include('../config/constrants.php');


//echo delete page
//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete
    //echo "Get value and delete";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //remove the physical image file if available
    if($image_name!="")
    {
        //image is available.so remove it
        $path="../images/category/".$image_name;
        //remove the image
        $remove=unlink($path);
        //if failed to remove image then add an error message and stop the process 
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove']="<div class='error'>failed to remove category image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'Admin/manage-category.php');
            //stop the process
            die();
        }
    }
    //delete data from database
    $sql="DELETE FROM tbl_category WHERE id=$id";
    //execute the query
    $res=mysqli_query($conn,$sql);
    //check data is deleted from db or not
    if($res==true)
    {
        //set success msg
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'Admin/manage-category.php');

    }
    else{
        //set failed msg
        $_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'Admin/manage-category.php');
    }
    //redirect to manage category page with message
}
else
{
    //redirect to manage category page
    header('location:'.SITEURL.'Admin/manage-category.php');
}

?>