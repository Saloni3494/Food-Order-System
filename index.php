<?php include('partials/menu.php'); ?>

<head>

<?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

    ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>


@media screen and (max-width: 600px) {

  
  .h1{
    display: none;
  }
}

@media screen and (max-width: 1236px) {

.banner-style{
  display: none;
}
}


    input[type="search"] {
  border: 1px solid black; /* You can customize the border style and color */
  padding: 5px; /* Optional: Add padding for better aesthetics */
}

.h1 { color: #111; font-family: 'Helvetica Neue', sans-serif; font-size: 130px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: center;margin-right: 50px;
  margin-left: 50px; }


.h2 { color: #111; font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 300; line-height: 32px; margin: 0 0 72px; text-align: center;margin-right: 50px;
  margin-left: 50px; }


.p { color: #685206; font-family: 'Helvetica Neue', sans-serif; font-size: 17px; line-height: 24px; margin: 0 0 24px; text-align: justify; text-justify: inter-word;margin-right: 50px;
  margin-left: 50px; }
</style>

</head>


<body>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <br/>
                <input class="myborder" type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    
  
    <section class="categories">
            <div>
                <img src="images/tasty_trove.gif" alt="Computer man" class="gif-style">
                <img src="images/banner_new.png" alt="Computer man" class="banner-style">
            </div>
            <div class="gif-menu"><br/><br/>
                <h1 class="h1">Tasty&nbsp;Trove</h1><br/><br/>
        
                <h2 class="h2 "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;🌟 Indulge in Self-Treats with Tasty Trove's Healthy Mart! 🍔</b><br><br>Craving a delightful treat without stepping out? Treat yourself to a feast from Tasty Trove's Healthy Mart, your go-to online food haven! 🥗🍕</h2>
           
                <p class="p">✨ Free Delivery, No Strings Attached! 🚚🎉<br>
                No minimum order required! Enjoy the luxury of doorstep delivery without worrying about meeting a minimum spend. Your favorite meals, delivered to you absolutely FREE! 🍱<br><br>
                🌐 Order Online, Hassle-Free! 💻📲<br>
                Navigate our user-friendly website and explore a world of mouth-watering options. From appetizers to desserts, we've got your cravings covered! Simply order online, and we'll take care of the rest. Convenience at your fingertips! 🛒✨<br><br>
                🎁 Exclusive Offer: Use Code "FREETREAT" for Free Delivery! 🆓🎁<br>
                As a special treat, use code "FREETREAT" during checkout to unlock FREE delivery on your entire order. It's our way of making your self-treat even sweeter! 🍭🛍️<br><br/><br><br></p>
</div>
</section>
        
    <!-- CAtegories Section Starts Here -->
    
    <section class="categories">
        <div class="container">
            
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //create sql query to display categories from db
                $sql = "SELECT * FROM tbl_category WHERE category_active='Yes' AND category_featured='Yes' LIMIT 3";   //will display only 3 categories
                //execute
                $res = mysqli_query($conn,$sql);
                //count rows to check whether the category is availbale or not
                $count =mysqli_num_rows($res);

                if($count>0)
                {
                    //category is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id, title, images
                        $category_id = $row['category_id'];
                        $category_title = $row['category_title'];
                        $category_img_name = $row['category_img_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $category_id?>">
                            <div class="box-3 float-container">
                                <?php 
                                //check whether image is available or not

                                if($category_img_name=="")
                                {
                                    //display msg
                                    echo "<div class='text-red'>Image Not Available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                   
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $category_img_name; ?>" alt="image" class="img-responsive img-curve">
                                  
                                    <?php
                                }

                                ?>

                                <h3 class="float-text text-white"><?php echo $category_title; ?></h3>
                            </div>
                            </a>
                            


                        <?php
                    }
                }
                else
                {
                    //category is not available
                    echo "<div class='text-red'>Category Not Added</div>";
                }

            ?>
            <p class="text-center">
            <a class="link-style text-red" href="<?php echo SITEURL; ?>categories.php">See All Categories</a>
        </p>
            

            <div class="clearfix"></div>
        </div>
            
    </section>
    
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                //create sql query to display categories from db
                $sql2 = "SELECT * FROM tbl_food WHERE food_active='Yes' AND food_featured='Yes' LIMIT 6";   //will display only 3 categories
                //execute
                $res2 = mysqli_query($conn,$sql2);
                //count rows to check whether the category is availbale or not
                $count2 =mysqli_num_rows($res2);

                if($count2>0)
                {
                    //category is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        //get the values like id, title, images
                        $food_id = $row2['food_id'];
                        $food_title = $row2['food_title'];
                        $food_description = $row2['food_description'];
                        $food_price = $row2['food_price'];
                        $food_img_name = $row2['food_img_name'];
                        ?>

                            <div class="food-menu-box">
                           
                                <?php 
                                //check whether image is available or not

                                if($food_img_name=="")
                                {
                                    //display msg
                                    echo "<div class='text-red'>Image Not Available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>

                                    <img class="food-menu-img" src="<?php echo SITEURL; ?>images/food/<?php echo $food_img_name; ?>" class="img-responsive img-curve">

                                    <?php
                                }

                                ?>

                            <div class="food-menu-desc">
                                <h4 class="text-black"><?php echo $food_title; ?></h4>
                                <p class="food-price text-black">Rs. <?php echo $food_price; ?></p>
                                <p class="food-detail"><?php echo $food_description; ?></p>
                                <br/>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                            


                        <?php
                    }
                }
                else
                {
                    //category is not available
                    echo "<div class='text-red'>Food Not Added</div>";
                }


            ?>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a class="link-style text-red" href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>

            </body>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    
    <?php include('partials/footer.php'); ?>