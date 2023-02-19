<?php
include('../config/constrants.php');

//echo "delete cake page";
if(isset($_GET['id']) && isset($_GET['image_name'])) //either use AND or &&
{
    //process to delete
    //echo "Pocess to delete";

    //1.get id and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //2.remove the image if available
    //check image available or not and delete if available
    if($image_name !="")
    {
        //it has image and needto remove from folder
        //get the image path
        $path="../images/cake/".$image_name;

        //remove image file from folder
        $remove=unlink($path);

        //check image is removed or not
        if($remove==false)
        {
            //failed to remove image
            $_SESSION['upload']="<div class='error'>Failed to remove image file</div>";
            //redirect to manage cake
            header('location:'.SITEURL.'Admin/manage-cake.php');
            //stop process
            die();
        }
    }

    //3.delete cake from database
    $sql="DELETE FROM tbl_food WHERE id=$id";
    //execute the query
    $res=mysqli_query($conn,$sql);

    //check the query eexecuted or not set the session msg respectivelly
    //4.redirect to manage cake with session message
    if($res==true)
    {
        //food deleted
        $_SESSION['delete']="<div class='success'>Cake Deleted Successfully.</div>";
        header('location:'.SITEURL.'Admin/manage-cake.php');
    }
    else
    {
        //food not deleted
        $_SESSION['delete']="<div class='error'>Failed to delete cake.</div>";
        header('location:'.SITEURL.'Admin/manage-cake.php');
    }


    
}
else
{
    //redirect to manage cake page
    //echo "Redirect";
    $_SESSION['unauthorize']="<div class='error'>Unauthorised Assess.</div>";
    header('location:'.SITEURL.'Admin/manage-cake.php');
}
?>