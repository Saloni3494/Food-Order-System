<?php include('partials/menu.php'); ?>
<head>
<div class="form-box-ad-categories">
    <div class="navbar">
      <div>
      <h2 class="text-white">Manage Category</h2>
      <br/><br/>
     

    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
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


    ?>

    
    <br/><br/>

      <a href="<?php echo SITEURL; ?>admin/add_category.php" class="btn-primary-add">Add Category</a>
      <br/><br/>
</div>
</div>

      <table class="table-full">
        <tr class="text-white">
            <th>S.N</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>

        <?php

            $sql="SELECT * FROM tbl_category";
            //executed query
            $res=mysqli_query($conn,$sql);

            //count rows
            $count=mysqli_num_rows($res);

            //create serial number variable
            $sn=1;

            //check whether we have data in db or not
            if($count>0)
            {
                //we have data in db
                //get data and display
                while($row=mysqli_fetch_assoc($res))
                {
                    $category_id=$row['category_id'];
                    $category_title=$row['category_title'];
                    $category_img_name=$row['category_img_name'];
                    $category_featured=$row['category_featured'];
                    $category_active=$row['category_active'];

                    ?>

                    <tr>
                        <td class="text-white"><div class="col-1 text-center"><?php echo $sn++; ?></div></td>
                        <td class="text-white"><div class="col-2"><?php echo $category_title; ?></div></td>

                        <td class="text-white"><div class="col-3">
                            <?php
                                //check whether image is present or not
                                if($category_img_name!="")
                                {
                                    //display the image
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $category_img_name; ?>" width="100px">

                                    <?php
                                }
                                else
                                {
                                    //display message
                                    echo "<div class='text-red'>Image Not Added.</div>";
                                }
                            ?>
                            </div></td>
                        <td class="text-white"><div class="col-4 text-center"><?php echo $category_featured; ?></div></td>
                        <td class="text-white"><div class="col-5 text-center "><?php echo $category_active; ?></div></td>
                        <td>
                            <div class="col-6">
                            <a href="<?php echo SITEURL; ?>admin/update_category.php?category_id=<?php echo $category_id; ?>" class="btn-secondary-category">Update Category</a>&nbsp;&nbsp;
                            <a href="<?php echo SITEURL; ?>admin/delete_category.php?category_id=<?php echo $category_id; ?>&category_img_name=<?php echo $category_img_name; ?>" class="btn-delete-category">Delete Category</a>
                            </div>
                        </td>
                    </tr>

                    <?php
                }
            }
            else
            {
                //we do not have data in db
                //we'll display msg inside table
                ?>
                <tr>
                    <td colspan="6">
                        <div class="text-red">No Category Added</div>
                    </td>
                </tr>

                <?php
            }

        ?>
        
        
    </table>
</div>
</div>
</div>

<?php include('partials/footer.php'); ?>
