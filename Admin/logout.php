<?php
include ('../config/constrants.php');
//destroy the session 
session_destroy();
//redirect to login page
header('location:'.SITEURL.'Admin/login.php');
?>