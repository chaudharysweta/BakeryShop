<?php include('partials-front/menu.php') ?>
<?php
//check cake is set or not
if(isset($_GET['food_id']))
{
    //get the cake id and details of the selected cake
    $food_id=$_GET['food_id'];

    //get the details of the selected cakes
    $sql="SELECT * FROM tbl_food WHERE id=$food_id";

    //execute query
    $res=mysqli_query($conn,$sql);

    //count rows
    $count=mysqli_num_rows($res);

    //check data available or not
    if($count==1)
    {
        //we have data
        //get the data from database
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
    }
    else
    //cake not available
    //redirect to home page
    header('location:'.SITEURL);
}
else{
    //redirect to homepage
    header('location:'.SITEURL);
}
?>


<?php

//check confirm order button is clicked or not
if(isset($_POST['submit']))
{
    //get all the detail from form

    $food=$_POST['food'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];

    $total=$price * $qty;
    
    $order_date=date("Y-m-d h:i:sa"); //date of order

    $status="Ordered"; //ordered,on delivery,delevered,cancelled

    $customer_name=$_POST['full-name'];
    $customer_contact=$_POST['contact'];
    $customer_email=$_POST['email'];
    $customer_address=$_POST['address'];

    //save the order inn database
    //create sql to save data
    $sql2="INSERT INTO tbl_order SET
    food='$food',
    price=$price,
    qty=$qty,
    total=$total,
    order_date='$order_date',
    status='$status',
    customer_name='$customer_name',
    customer_contact='$customer_contact',
    customer_email='$customer_email',
    customer_address='$customer_address'

    ";
    //execute the query
    $res2=mysqli_query($conn,$sql2);

    //check query executed or not
    if($res2==true)
    {
        //query executed and saved order
        $_SESSION['order']="<div class='success text-center'>Cake ordered successfully.</div>";
        header('location:'.SITEURL);
    }
    else
    {
        //failed to save order
        $_SESSION['order']="<div class='error' text-center>Cake not ordered.</div>";
        header('location:'.SITEURL);
    }
}

?>



    <!-- CAKE SEARCH Section Starts Here -->
    <section class="food-search1">
        <div class="container">
            
            <h2 class="text-center text-white">Form For Confirming Order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend class="cake text-white">Your Cake</legend>

                    <div class="food-menu-img">
                        <?php
                        //check image is available or not
                        if($image_name=="")
                        {
                            //image not available
                            echo "<div class='error'>Image not available.</div>";
                        }
                        else
                        {
                            //image avaialbe
                            ?>
                              <img src="<?php echo SITEURL?>images/cake/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                   
                            <?php
                            
                            
                        }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3 class="heading text-white"><?php echo $title;?></h3>
                        <input type="hidden" name="food"value="<?php echo $title;?>">

                        <p class="food-price">Rs.<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend class="delivered text-white">Details of Delivery</legend>
                    <div class="order-label text-white">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your Full Name(Sweta Raj Chaudhary)" class="input-responsive" required>

                    <div class="order-label text-white">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter Your Phone Number(98********)" class="input-responsive" required>

                    <div class="order-label text-white">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email(swetarajchaudhary@gmail.com)" class="input-responsive" required>

                    <div class="order-label text-white">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter Your Address(street,city,country)" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    <input type="submit" name="submit" value="eSewa" class="btn btn-primary">
                    
                </fieldset>

            </form>


        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

   

    <?php include('partials-front/footer.php') ?>