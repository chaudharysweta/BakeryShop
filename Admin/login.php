<?php
include ('../config/constrants.php');
?>

<html>
    <head>
        <title>Login - Bakeryshop</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
            if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login']; //displaying session messgae
                    unset($_SESSION['login']); //removing session message
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message']; //displaying session messgae
                    unset($_SESSION['no-login-message']); //removing session message
                }
            ?>  
            <br><br>  

            <!--login starts-->
            <form action="" method="POST" class="text-center">
                Username: <br>

                <input type="text" name="username" placeholder="Enter username"><br><br>
                Password: <br>

                <input type="password" name="password" placeholder="Enter password"> <br><br>

                <input type="submit"name="submit" value="Login" class="btn-primary">
            </form>
            <!--login ends-->

            <br><br><br>

            <p class="text-center">Created By - Sweta Raj Chaudhary</p>
        </div>
    </body>
</html>

<?php
//check whether the submit button is clicked or  not
if(isset($_POST['submit']))
{
    //process for login
    //1. get the data from login form
    $username=$_POST['username'];
    $password=md5($_POST['password']);


    //2. sql to check password and username exist or not
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";


    //3. execute query
    $res=mysqli_query($conn,$sql);


    //4. count rows to check whether the user exist or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        //user available
        $_SESSION['login']="<div class='success'>Login successfull.</div>";
        $_SESSION['user']=$username;
        //redirect to home page
        header('location:'.SITEURL.'Admin/index.php');
    }
    else{
        //user not availabe
        $_SESSION['login']="<div class='error text-center'>Login failed.</div>";
        //redirect to home page
        header('location:'.SITEURL.'Admin/login.php');
    }




}
?>