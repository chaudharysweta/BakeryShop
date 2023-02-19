<?php include('partials-front/menu.php') ?>

<?php
//check id is passed or not
if(isset($_GET['category_id']))
{
    //category id is set and get the id
    $category_id=$_GET['category_id'];
    //get the category based on category ID
    $sql="SELECT title FROM tbl_category WHERE id=$category_id";

    //execute query
    $res=mysqli_query($conn,$sql);

    //get the value from database
    $row=mysqli_fetch_assoc($res);
    //get the title
    $category_title=$row['title'];
}
else{
    //category not passed
    //redirect to home page
    header('location:'.SITEURL);
}

?>

    <!--CAKE SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2> <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- CAKE SEARCH Section Ends Here -->



    <!-- CAKE MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cakes Available</h2>

            <?php
            //create sql query to get cake based on selected category
            $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";

            //execute the query
            $res2=mysqli_query($conn,$sql2);

            //count rows
            $count2=mysqli_num_rows($res2);

            //check cake available or not
            if($count2>0)
            {
                //cake available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id=$row2['id'];
                    $title=$row2['title'];
                    $price=$row2['price'];
                    $description=$row2['description'];
                    $image_name=$row2['image_name'];
                    ?>

                   <form action="manage_cart.php"method="POST">
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL;?>images/cake/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" weight="200" height="250">
                                <?php
                            }
                            ?>

                      </div>
        
                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description;?>
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
            else
            {
                //food not available
                echo "<div class='error'>Cake not available</div>";

            }
            
            ?>

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Cake Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>