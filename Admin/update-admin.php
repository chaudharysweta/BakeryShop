<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>

        <?php
        //get the id of selected admin
        $id=$_GET['id'];

        //create sql query to get details
        $sql="SELECT * FROM tbl_admin WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the query exxecuted or not
        if($res==true)
        {
            //data available or not
            $count=mysqli_num_rows($res);

            //check admin data
            if($count==1)
            {
                //get the details
                //echo "Admin available";
                $row=mysqli_fetch_assoc($res);

                $full_name=$row['full_name'];
                $username=$row['username'];
            }
            else{
                //redirect to admin page
                header("location:".SITEURL.'Admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                 <td >Full Name:</td>
                  <td><input type="text" name="full_name" placeholder="enter full name" value="<?php echo $full_name;?>"></td>
                </tr>
                <tr>
                  <td >Username:</td>
                  <td><input type="text" name="username"placeholder="enter username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
                
            </table>
            
        </form>
    </div>
</div>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //echo "button is clicekd";
    //get values from form to update
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    //update 
    $sql="UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
      ";

      //execute query
      $res=mysqli_query($conn,$sql);

      //checking execution
      if($res==true)
      {
        //Admin updated
        $_SESSION['update']="<div class='success'>Admin updated</div>";
        //redirect manage admin page
        header("location:".SITEURL.'Admin/manage-admin.php');
      }
      else{
        //failed to update
        $_SESSION['update']="<div class='error'>Admin not updated</div>";
        //redirect manage admin page
        header("location:".SITEURL.'Admin/manage-admin.php');
      }
      }


?>

<?php include('partials/footer.php') ?> 