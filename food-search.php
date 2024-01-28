<?php include('partials/menu.php'); ?>



<?php

    //get the searched keyword
    //$search = $_POST['search'];
    $search = mysqli_real_escape_string($conn,$_POST['search']);

?>
<br/>
<h2 class="text-center text-black">Food Searches for "<?php echo $search; ?>"</h2>

<section class="food-menu">
        <div class="container">
        <h2 class="text-center">Food Menu</h2>
    <?php 

        
        
        //SQL query to get food based on search
        $sql = "SELECT * FROM tbl_food WHERE food_title LIKE '%$search%' OR food_description LIKE '%$search%'";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //count rows
        $count = mysqli_num_rows($res);

        //check whether food is available or not
        if($count>0)
        {
            //food is available
            while($row=mysqli_fetch_assoc($res))
            {
                //get the details 
                $food_id = $row['food_id'];
                $food_title = $row['food_title'];
                $food_price = $row['food_price'];
                $food_description = $row['food_description'];
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
            //food not available
            echo  "<div class='text-red'>Food Not Found</div>";
        }

    ?>

    
<div class="clearfix"></div>

            

</div>


</section>



<?php include('partials/footer.php'); ?>