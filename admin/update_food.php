<?php include('partials/menu.php'); ?>

<head>
<div class="form-box-add-food">
      <div class="navbar">
      <div>
      <h2 class="text-white">Update Food</h2>
      <br/>
      <br/>

      <br/><br/>

      <?php

        //check whether the id is set or not
        if(isset($_GET['food_id']))
        {
            //get all details
            //echo "Getting the data";
            $food_id=$_GET['food_id'];

            //sql query to get all details
            $sql="SELECT * FROM tbl_food WHERE food_id=$food_id";

            //execute query
            $res=mysqli_query($conn,$sql);

            //count rows to check whether the id is valid nor
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get all data
                $row = mysqli_fetch_assoc($res);
                $food_title = $row['food_title'];
                $food_description = $row['food_description'];
                $food_price = $row['food_price'];
                $current_image = $row['food_img_name'];
                $food_featured = $row['food_featured'];
                $food_active = $row['food_active'];

            }
            else
            {
                //redirect to manage food page with msg
                $_SESSION['no-food-found']="<div class='text-red'>Food Not Found</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
            }
        }
        else
        {
            //redirect to manage food
            header('location:'.SITEURL.'admin/manage_food.php');
        }

      ?>

      <div class="text-white">
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="table-150">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="food_title" value="<?php echo $food_title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="food_description" cols="50" rows="5"><?php echo $food_description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="food_price" value="<?php echo $food_price; ?>">
                </td>
            </tr>

            <tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php

                        if($current_image!="")
                        {
                            //display image
                            ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">

                            <?php

                        }
                        else
                        {
                            //display msg
                            echo "<div class='text-red'>Image Not Added</div>";
                        }

                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="food_img_name">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($food_featured=="Yes"){echo "checked";} ?> type="radio" name="food_featured" value="Yes"> Yes

                    <input <?php if($food_featured=="No"){echo "checked";} ?> type="radio" name="food_featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($food_active=="Yes"){echo "checked";} ?> type="radio" name="food_active" value="Yes"> Yes

                    <input <?php if($food_active=="No"){echo "checked";} ?> type="radio" name="food_active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                    <input type="submit" name="submit" value="Update food" class="btn-secondary-category">
            </td>
                
            </tr>
        </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. get all values from our form
                // $food_id=$_POST['food_id'];
                // $food_title=$_POST['food_title'];
                // $food_description=$_POST['food_description'];
                // $current_image=$_POST['current_image'];
                // $food_featured=$_POST['food_featured'];
                // $food_active=$_POST['food_active'];

                $food_id=mysqli_real_escape_string($conn, $_POST['food_id']);
                $food_title=mysqli_real_escape_string($conn, $_POST['food_title']);
                $food_description=mysqli_real_escape_string($conn, $_POST['food_description']);
                $current_image=mysqli_real_escape_string($conn, $_POST['current_image']);
                $food_featured=mysqli_real_escape_string($conn, $_POST['food_featured']);
                $food_active=mysqli_real_escape_string($conn, $_POST['food_active']);

                //2.Updating new image if   selected
                //check whether the image is selected or not
                if(isset($_FILES['food_img_name']['name']))
                {
                    //get image details
                    $food_img_name=$_FILES['food_img_name']['name'];
                    //check whether image is available or not
                    if($food_img_name != "")
                    {
                        //img available
                        //A.Upload new image

                        $source_path=$_FILES['food_img_name']['tmp_name'];

                        $destination_path= "../images/food/".$food_img_name;

                        //finally upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //if img is not uploaded then we will stop the process and redirect with error msg
                        if($upload != true)
                        {
                            //set msg
                            $_SESSION['upload'] = "<div class='text-red'>Failed to upload image.</div>";
                            header('location'.SITEURL.'admin/manage_food.php');
                            //stop the process
                            die();

                        }

                        //B. remove current img if available
                        if($current_image!="")
                        {
                            $remove_path="../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //check whether the img is removed or not 
                            //if failed to remove display msg and stop process
                            if($remove==false)
                            {
                                //failed to remove img
                                $_SESSION['failed-remove']="<div class='text-red'>Failed to Remove current Image</div>";
                                header('location:'.SITEURL.'admin/manage_food.php');
                                die(); //stop the process
                            }
                        }

                    }
                    else
                    {
                        $food_img_name=$current_image;
                    }

                }
                else
                {
                    $food_img_name=$current_image;
                }

                //3.Update db
                $sql2 = "UPDATE tbl_food SET
                        food_title = '$food_title',
                        food_description = '$food_description',
                        food_price = $food_price,
                        food_img_name = '$food_img_name',
                        food_featured = '$food_featured',
                        food_active = '$food_active'
                        WHERE food_id = $food_id";

                //execute query
                $res2 = mysqli_query($conn,$sql2);

                //4.Redirect to manage food with msg
                //check whether query executed or not
                if($res2==true)
                {
                    //food updated
                    $_SESSION['update']="<div class='text-green'>Food Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                }
                else
                {
                    //food not updated
                    $_SESSION['update']="<div class='text-red'>Failed to update food</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                }

            }

        ?>
</div>
</div>
</div>
</div>
        </div>