<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current_Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="enter current password">
                    </td>
                </tr>
                <tr>
                    <td>New_Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="enter new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm_Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>   

<?php
//check submit button clicked or not
if(isset($_POST['submit']))
{
    //echo 'clicked';
    //get data from form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    //check whether th user with current id and current password exist or not
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";


    //check whether the password and confirm password matched or not
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        //checking available or not
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //user exist
           // echo "user found"; 
           if($new_password==$confirm_password)
           {
            //update the password
            $sql2="UPDATE tbl_admin SET
            password='$new_password'
            WHERE id=$id
            ";

            //execute query
            $res2=mysqli_query($conn,$sql2);
            //check query is executed or not
            if($res2==true)
            {
                //display success message
                //redirect to manage admin page with success message
                 $_SESSION['change-password']="<div class='success'>Password changed successfully</div>";
                //redirect manage admin page
                 header("location:".SITEURL.'Admin/manage-admin.php');
            }
            else{
                //display error message
                //redirect to manage admin page with error message
                $_SESSION['change-password']="<div class='error'>Failed to change password</div>";
                //redirect manage admin page
                 header("location:".SITEURL.'Admin/manage-admin.php');
            }
           }
           else{
                //redirect to manage admin page with error message
                $_SESSION['password-not-match']="<div class='error'>Password did not match</div>";
                //redirect manage admin page
                header("location:".SITEURL.'Admin/manage-admin.php');
           }
        }
        else{

            //user donot exist
            $_SESSION['user-not-found']="<div class='error'>User not found</div>";
            //redirect manage admin page
            header("location:".SITEURL.'Admin/manage-admin.php');
        }
    }

    //change password if all above is true
}
?>

<?php include('partials/footer.php') ?> 