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
    
            <section class="categories">
        <div class="container">
            <h2 class="text-center text-black">Explore Foods</h2>

            <?php 

            //create sql query to display categories from db
            $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";   //will display only 3 categories
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

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $category_img_name; ?>" class="img-responsive img-curve">

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

           
           

            <div class="clearfix"></div>
        </div>
    </section>

            <?php include('partials/footer.php'); ?>
