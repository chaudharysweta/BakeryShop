<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper" >
        <h1>Add Admin</h1>
        <br>
        <br>

       

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td >Full Name:</td>
                <td><input type="text" name="full_name" placeholder="enter full name"></td>
            </tr>
            <tr>
                <td >Username:</td>
                <td><input type="text" name="username"placeholder="enter username"></td>
            </tr>
            <tr>
                <td >Password:</td>
                <td><input type="password" name="password" placeholder="enter password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?> 


<?php

//proces the value from form and save in database

if(isset($_POST['submit']))
{
 /*   //button clicked
    echo "Button clicked";
}
else{
    //Button not clicked
    echo "button not clicked";  
 */
 
 //get data from form
 $full_name=$_POST['full_name'];
 $username=$_POST['username'];
 $password=md5($_POST['password']); //password encryption with MD5

 //sql query to save the data into database
 $sql="INSERT INTO tbl_admin SET
 full_name='$full_name',
 username='$username',
 password='$password'
 ";

$sql;

//execute query and save data in database

$res=mysqli_query($conn,$sql) or die(mysqli_error());

//check whether data is inserted or not
if($res==TRUE)
{
   // echo "data inserted";
   //create a session variable to dispaly message
     $_SESSION['add']="Admin added succesfully";
   //redirect page to manage admin
     header("location:".SITEURL.'Admin/manage-admin.php');
}
else{
    //echo "failed to  insert";
      $_SESSION['add']="failed to add admin";
   //redirect page to add admin
      header("location:".SITEURL.'Admin/add-admin.php');
}
}


 


?>