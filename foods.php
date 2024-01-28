<?php include('partials/menu.php'); ?>

<head>
    <style>
            input[type="search"] {
        border: 2px solid black; /* You can customize the border style and color */
        padding: 5px; /* Optional: Add padding for better aesthetics */
        }
    </style>
</head>

<section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <p><br><br></p>
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

            

            //create sql query to display categories from db
            $sql = "SELECT * FROM tbl_food WHERE food_active='Yes'";   //will display only 3 categories
            //execute
            $res = mysqli_query($conn,$sql);
            //count rows to check whether the food is availbale or not
            $count =mysqli_num_rows($res);

            if($count>0)
            {
                //food is available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values like id, title, images
                        $food_id = $row['food_id'];
                        $food_title = $row['food_title'];
                        $food_description = $row['food_description'];
                        $food_price = $row['food_price'];
                        $food_img_name = $row['food_img_name'];
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
                                <p class="food-price text-grey">Rs. <?php echo $food_price; ?></p>
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
                //food is not available
                echo "<div class='text-red'>Food Not Added</div>";
            }

            ?>


            <div class="clearfix"></div>

            

        </div>

        
    </section>
    <!-- fOOD Menu Section Ends Here -->

   

    <!-- footer Section Starts Here -->
    <?php include('partials/footer.php'); ?>