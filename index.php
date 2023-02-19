<?php include('partials-front/menu.php') ?>



    <!-- CAKE SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Cake Of Your Choice..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- CAKE SEARCH Section Ends Here -->

    <?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    
    ?>
   >

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">CATEGORIES OF CAKE</h2>
            <br><br><br>

            <?php

            //create sql query to display categories from database
            $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //execute th query
            $res=mysqli_query($conn,$sql);
            //count rows to check th category is available or not
            $count=mysqli_num_rows($res);

            if($count>0)
            {
                //category available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values like id,title,image_name
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                         <div class="box-3 float-container">
                            <?php
                            //check image is available or not
                            if($image_name=="")
                            {
                                //display message
                                echo "<div class='error'>Image not Available</div>";
                            }
                            else{
                                //image available
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve"weight="250px"height="250px">

                                <?php
                            }
                            ?>
                            
                            <h3 class="float-text "><?php echo $title; ?></h3>
                         </div>
                    </a>
                    <?php
                }
            }
            else{
                //category not available
                echo "<div class='error'>Category not Added.</div>";
            }
            
            ?>

            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- CAKE MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cakes Available</h2>

            

            <?php

            //getting cakes from database that are active and featured
            //sql query
            $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //exexcute query
            $res2=mysqli_query($conn,$sql2);

            //count rows
            $count2=mysqli_num_rows($res2);

            //check cake available or not
            if($count2>0)
            {
                //cake available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all values
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>

                <div class="food-menu-box">
                    <form action="manage_cart.php" method="POST">
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
                            <img src="<?php echo SITEURL; ?>images/cake/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" weight="250px" height="250px">
                            <?php
                        }
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title;?></h4>
                        <p class="food-price">Rs.<?php echo $price; ?></p>
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
                    
                    </form>

                     


                </div>

                    <?php
                }
            }
            else{
                //cake not available
                echo "<div class='error'>Food not available.</div>";
            } 
            ?>
            <div class="clearfix"></div>

          
        </div>

        <p class="text-center">
            <a  href="foods.php">See All Cakes</a>
        </p>
    </section>
    <!-- CAKE Menu Section Ends Here -->

   <?php include('partials-front/footer.php') ?>