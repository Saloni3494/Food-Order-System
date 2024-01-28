<?php include('partials/menu.php'); ?>

<head>
<div class="form-box-add-food">
      <div class="navbar">
      <div>
      <h2 class="text-white">Update Category</h2>
      <br/>
      <br/>

      <br/><br/>

      <?php

        //check whether the id is set or not
        if(isset($_GET['category_id']))
        {
            //get all details
            //echo "Getting the data";
            $category_id=$_GET['category_id'];

            //sql query to get all details
            $sql="SELECT * FROM tbl_category WHERE category_id=$category_id";

            //execute query
            $res=mysqli_query($conn,$sql);

            //count rows to check whether the id is valid nor
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get all data
                $row = mysqli_fetch_assoc($res);
                $category_title = $row['category_title'];
                $current_image = $row['category_img_name'];
                $category_featured = $row['category_featured'];
                $category_active = $row['category_active'];

            }
            else
            {
                //redirect to manage category page with msg
                $_SESSION['no-category-found']="<div class='text-red'>Category Not Found</div>";
                header('location:'.SITEURL.'admin/manage_category.php');
            }
        }
        else
        {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage_category.php');
        }

      ?>

      <div class="text-white">
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="table-150">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="category_title" value="<?php echo $category_title; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php

                        if($current_image!="")
                        {
                            //display image
                            ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">

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
                    <input type="file" name="category_img_name">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($category_featured=="Yes"){echo "checked";} ?> type="radio" name="category_featured" value="Yes"> Yes

                    <input <?php if($category_featured=="No"){echo "checked";} ?> type="radio" name="category_featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($category_active=="Yes"){echo "checked";} ?> type="radio" name="category_active" value="Yes"> Yes

                    <input <?php if($category_active=="No"){echo "checked";} ?> type="radio" name="category_active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary-category">
            </td>
                
            </tr>
        </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. get all values from our form
                // $category_id=$_POST['category_id'];
                // $category_title=$_POST['category_title'];
                // $current_image=$_POST['current_image'];
                // $category_featured=$_POST['category_featured'];
                // $category_active=$_POST['category_active'];

                $category_id=mysqli_real_escape_string($conn, $_POST['category_id']);
                $category_title=mysqli_real_escape_string($conn, $_POST['category_title']);
                $current_image=mysqli_real_escape_string($conn, $_POST['current_image']);
                $category_featured=mysqli_real_escape_string($conn, $_POST['category_featured']);
                $category_active=mysqli_real_escape_string($conn, $_POST['category_active']);

                //2.Updating new image if   selected
                //check whether the image is selected or not
                if(isset($_FILES['category_img_name']['name']))
                {
                    //get image details
                    $category_img_name=$_FILES['category_img_name']['name'];
                    //check whether image is available or not
                    if($category_img_name != "")
                    {
                        //img available
                        //A.Upload new image

                        $source_path=$_FILES['category_img_name']['tmp_name'];

                        $destination_path= "../images/category/".$category_img_name;

                        //finally upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //if img is not uploaded then we will stop the process and redirect with error msg
                        if($upload != true)
                        {
                            //set msg
                            $_SESSION['upload'] = "<div class='text-red'>Failed to upload image.</div>";
                            header('location'.SITEURL.'admin/manage_category.php');
                            //stop the process
                            die();

                        }

                        //B. remove current img if available
                        if($current_image!="")
                        {
                            $remove_path="../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //check whether the img is removed or not 
                            //if failed to remove display msg and stop process
                            if($remove==false)
                            {
                                //failed to remove img
                                $_SESSION['failed-remove']="<div class='text-red'>Failed to Remove current Image</div>";
                                header('location:'.SITEURL.'admin/manage_category.php');
                                die(); //stop the process
                            }
                        }

                    }
                    else
                    {
                        $category_img_name=$current_image;
                    }

                }
                else
                {
                    $category_img_name=$current_image;
                }

                //3.Update db
                $sql2 = "UPDATE tbl_category SET
                        category_title = '$category_title',
                        category_img_name = '$category_img_name',
                        category_featured = '$category_featured',
                        category_active = '$category_active'
                        WHERE category_id = $category_id";

                //execute query
                $res2 = mysqli_query($conn,$sql2);

                //4.Redirect to manage category with msg
                //check whether query executed or not
                if($res2==true)
                {
                    //category updated
                    $_SESSION['update']="<div class='text-green'>Category Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
                else
                {
                    //category not updated
                    $_SESSION['update']="<div class='text-red'>Failed to update category</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }

            }

        ?>
</div>
</div>
</div>
</div>