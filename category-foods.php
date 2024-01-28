<?php include('partials/menu.php'); ?>

<?php 

    //check whether id is passed or noy
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $c_id = $_GET['category_id'];

        //get the category title based on category id
        $sql = "SELECT category_title FROM tbl_category WHERE category_id = '$c_id'";

        //execute query
        $res = mysqli_query($conn,$sql);

        //get value from db
        $row=mysqli_fetch_assoc($res);

        //get the title
        $category_title = $row['category_title'];

    }
    else
    {
        //category not passed
        //redirect to home page
        header('location:'.SITEURL);
    }

?>

<h2 class="text-center text-white">Food Searches for <a href="#" class="text-white">"<?php echo $category_title ?>" </h2>

<section class="food-menu">
        <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

            //create sql query to get food based on selected category
            $sql2 = "SELECT * FROM tbl_food WHERE c_id='$c_id'";

            //execute the query
            $res2 = mysqli_query($conn,$sql2);

            //count the rows
            $count2 = mysqli_num_rows($res2);

            //check whether food is available or not
            if($count2>0)
            {
                //food is availbale
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $food_id = $row2['food_id'];
                    $food_title = $row2['food_title'];
                    $food_price = $row2['food_price'];
                    $food_description = $row2['food_description'];
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
                            <p class="food-price"><div class="text-black">Rs. <?php echo $food_price; ?></div></p>
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
                //food not available
                echo "<div class='text-red'>Food Not Available</div>";
            }

        ?>

        <div class="clearfix"></div>

                    

        </div>


        </section>



<?php include('partials/footer.php'); ?>
