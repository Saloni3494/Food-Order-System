<?php include('partials/menu.php'); ?>
<head>
<div class="form-box-ad-categories">
<div class="navbar">
      <div>
      <h2 class="text-white">Manage Food</h2>
      <br><br><br/><br/>
      <a href="<?php echo SITEURL; ?>admin/add_food.php" class="btn-primary-add">Add Food</a>
      <br/><br/>

      <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-food-found']))
        {
            echo $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        if(isset($_SESSION['remove-food']))
        {
            echo $_SESSION['remove-food'];
            unset($_SESSION['remove-food']);
        }
        
        

      ?>

</div>
</div>

      <table class="table-full">
        <tr class="text-white">
            <th>S.N</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>

        <?php

            //create sql query to get all the food 
            $sql = "SELECT * FROM tbl_food";

            //exectue
            $res = mysqli_query($conn,$sql);

            //count rows
            $count = mysqli_num_rows($res);

            $sn = 1;

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    //get value from individual columns
                    $food_id = $row['food_id'];
                    $food_title = $row['food_title'];
                    $food_price = $row['food_price'];
                    $food_img_name = $row['food_img_name'];
                    $food_featured = $row['food_featured'];
                    $food_active = $row['food_active'];

                    ?>

                    <tr>
                        <td class="text-white"><div class="col-1"><?php echo $sn++; ?></div></td>
                        <td class="text-white"><div class="col-2"><?php echo $food_title; ?></div></td>
                        <td class="text-white"><div class="col-3"><?php echo $food_price; ?></div></td>
                        <td class="text-white"><div class="col-4">
                            <?php 
                            if($food_img_name!="")
                            {

                                ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $food_img_name; ?>" width="100px" height="100px">


                                <?php
                            } 
                            else
                            {
                                echo "<div class='text-red'>Image Not Added.</div>";
                            }
                        ?>
                            
                        </div>
                        </td>
                        <td class="text-white"><div class="col-5"><?php echo $food_featured?></div></td>
                        <td class="text-white"><div class="col-6"><?php echo $food_active?></div></td>
                        <td>
                            <div class="col-7">
                                <a href="<?php echo SITEURL; ?>admin/update_food.php?food_id=<?php echo $food_id; ?>" class="btn-secondary-category">Update Food</a>&nbsp;&nbsp;
                                <a href="<?php echo SITEURL; ?>admin/delete_food.php?food_id=<?php echo $food_id; ?>&food_img_name=<?php echo $food_img_name; ?>" class="btn-delete-category">Delete Food</a>
                            </div>
                        </td>
                    </tr>

                    <?php
                }

            }
            else
            {
                echo "<tr><td colspan='7' class='text-red'>Food Not Added Yet</td></tr>";
            }

        ?>
        
        
            
        

    </table>
</div>
</div>

<?php include('partials/footer.php'); ?>