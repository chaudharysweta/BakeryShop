<?php require("Connection.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CartAdmin Login Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container text-center">
        <div class="myform">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <h2>CartAdmin Login</h2>
                <br><br>
                <input type="text" placeholder="Admin Name" name="AdminName">
                <br><br>
                <input type="password" placeholder="Password" name="AdminPass">
                <br><br>
                <button type="submit" name="Login">LOGIN</button>
            </form>
        </div>

    </div>
    
    <?php

    function input_filter($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['Login']))
    {
        //filtering user input
        $AdminName=$_POST['AdminName'];
        $AdminName=input_filter($_POST['AdminName']);
        $AdminPass=$_POST['AdminPass'];
        $AdminPass=input_filter($_POST['AdminPass']);
         
        //escaping special symbol used in sql statement
        $AdminName=mysqli_real_escape_string($con,$AdminName);
        $AdminPass=mysqli_real_escape_string($con,$AdminPass);

        //query template
        $query="SELECT * FROM `admin_login` WHERE `Admin_Name`=? AND `Admin_Password`=?";

        //prepare statement
        if($stmt=mysqli_prepare($con,$query))
        {
            mysqli_stmt_bind_param($stmt,"ss",$AdminName,$AdminPass); //binding value to template
            mysqli_stmt_execute($stmt); //executing prepared statment
            mysqli_stmt_store_result($stmt); //transfering the result of execution in $stmt
            if(mysqli_stmt_num_rows($stmt)==1)
            {
                session_start();
                $_SESSION['AdminLoginId']=$AdminName;
                header("location:Admin Panel.php");
            }
            else
            {
                echo"<script>alert('Invalid Admin Name and Password.');</script>";
            }
            mysqli_stmt_close($stmt);
        }
        else
        {
            echo"<script>alert('Sql query cannot be prepared.');</script>";
        }
    }
    
    ?>
    
</body>
</html>