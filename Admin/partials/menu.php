<?php 
include('../config/constrants.php');
include('login-check.php');
?>

<html>
    <head>
        <title> Cake Order Website</title>
        <link rel="stylesheet" href="index.css">
        <style>
            .col-4{
               width: 18%;
               background-color: white;
               margin: 1%;
               padding: 2%;
               float: left;
               }
            .clearfix{
               float: none;
               clear: both;
               }
        </style>
    </head>
    <body>
        <!--Menu Section Starts-->
        <div class="menu">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-cake.php">Cake</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            
        </div>
        <!--Menu Section Ends-->