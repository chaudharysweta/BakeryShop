<?php include('partials-front/menu.php') ?>

    <!-- CAKE SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Cake Of Your Choice..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- CAKE SEARCH Section Ends Here -->



    <!-- CAKE MEnu Section Starts Here -->
    <section class="food-menu1">
        <div class="container">
            <h2 class="text-center">Cakes Available</h2>

            <?php
            //display cake that are active
            $sql="SELECT * FROM tbl_food WHERE active='Yes'";

            //execute the query
            $res=mysqli_query($conn,$sql);
            
            //count rows
            $count=mysqli_num_rows($res);

            //check the cake available or not
            if($count>0)
            {
                //cake available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value
                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    ?>
                <form action="manage_cart.php"method="POST">
                <div class="food-menu-box">
                    
                    <div class="food-menu-img">
                        <?php

                        //check image available or not
                        if($image_name=="")
                        {
                            //image not available
                            echo "<div class='error'>Image not available.</div>";
                        }
                        else{
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/cake/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve"weight="100px"height="250px">
                            <?php
                        }
                        
                        ?>
                            
                        </div>

                    <div class="food-menu-desc">
                        <h4 class="cake-title"><?php echo $title; ?></h4>
                        <p class="food-price">Rs.<?php echo $price;?></p>
                        <p class="food-detail">
                        <?php echo $description; ?>
                        </p>
                         <br>

                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        <button type="submit" name="Add_To_Cart"class="btn " >Add To Cart</button>
                        <input type="hidden" name="Item_Name" value="<?php echo $title;?>">
                        <input type="hidden" name="Price" value="<?php echo $price;?>">
                        <a href="<?php echo SITEURL;?>ordereSewa.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Pay with eSewa</a>

                    </div>
                </div>
                </form>
                    <?php
                }
            }
            else{
                //cake not available
                echo "<div class='error'>Cake Not Available.</div>";
            }
            
            ?>

            

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- CAKE Menu Section Ends Here -->



    <?php include('partials-front/footer.php') ?>