<?php include('partials-front/menu.php') ?>


    <!-- CAKE SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
        //get the search keyword
        $search=$_POST['search'];
        
        ?>
            
            <h2><a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- CAKE SEARCH Section Ends Here -->



    <!-- CAKE MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cakes Available</h2>
            <?php
            

            //sql query to get cake based on search keyword
            $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //count rows
            $count=mysqli_num_rows($res);

            //check food available or not
            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the details
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
                    echo "<div class='error'>Image not available.<div/>";
                }
                else{
                    //image available
                    ?>
                       <img src="<?php echo SITEURL;?>images/cake/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve"weight="200px"height="250px">
                         
                    <?php
                }
                
                ?>
               </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">Rs.<?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    <button type="submit" name="Add_To_Cart"class="btn " >Add To Cart</button>
                            <input type="hidden" name="Item_Name" value="<?php echo $title;?>">
                            <input type="hidden" name="Price" value="<?php echo $price;?>">
                </div>
            </div>
            </form>
                    <?php
                }
            }
            else{
                //cake not available
                echo "<div class='error'>Food Not Available</div>";
            }
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- CAKE Menu Section Ends Here -->

    
    <?php include('partials-front/footer.php') ?>