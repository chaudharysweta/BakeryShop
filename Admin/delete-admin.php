<?php

include('../config/constrants.php');

//admin id to be deleteted
 $id=$_GET['id'];

//create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res=mysqli_query($conn,$sql);

//check whether the query executed successfull or not
if($res==TRUE)
{
    //query executed successfully(admin deleted)
   // echo "admin deleted";
   //create session variable
   $_SESSION['delete']="Admin deleted successfully";
   //redirect to manage admin page
   header('location:'.SITEURL.'Admin/manage-admin.php');
}
else
{
    //echo "admin not deleted";
    $_SESSION['delete']="Failed to delete Admin";
    header("location:".SITEURL.'Admin/add-admin.php');
}

//redirect to manage admin page with message(success/error)

?>