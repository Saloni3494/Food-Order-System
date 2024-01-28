<?php include('partials/menu.php'); ?>

<head>
<div class="form-box-add">
      <div class="navbar">
      <div>
      <h2 class="text-white">Add Category</h2>
      <br/>
      <br/>


      <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

       ?>

<br/><br/>

      <div class="text-white">
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="table-150">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="category_title" placeholder="Category Title">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="category_img_name">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="category_featured" value="Yes"> Yes
                    <input type="radio" name="category_featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="category_active" value="Yes"> Yes
                    <input type="radio" name="category_active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary-category">
            </td>
                
            </tr>
        </table>
        </form>


        <?php

        //check whether submit btn is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1.Get the value from category form
                //$category_title = $_POST['category_title'];
                $category_title = mysqli_real_escape_string($conn, $_POST['category_title']);

                //for radio input , we need to check whether button is selected or not

                if(isset($_POST['category_featured']))
                {
                    //get value from form
                    //$category_featured=$_POST['category_featured'];
                    $category_featured=mysqli_real_escape_string($conn, $_POST['category_featured']);
                }
                else{
                    //set default value
                    $category_featured="No";
                }

                if(isset($_POST['category_active']))
                {
                    //get value from form
                    //$category_active=$_POST['category_active'];
                    $category_active=mysqli_real_escape_string($conn, $_POST['category_active']);
                }
                else{
                    //set default value
                    $category_active="No";
                }

                //check whether image is selected or not and set iamge name accordingly
                //print_r($_FILES['category_img_name']);

                //die(); //break the code here 

                if(isset($_FILES['category_img_name']['name']))
                {
                    //Upload image
                    // to upload we need image name and source path and destination path
                    //$image_name=$_FILES['category_img_name']['name'];
                    $image_name = $_FILES['category_img_name']['name'];

                    //Upload image only if image is selected
                    if($image_name!="")
                    {


                        //Auto rename same named images
                        //get the extension of image (jpg,png,gif etc) e.g. "food1.jpg"
                        //$ext = end(explode('.', $image_name));

                        //rename the image
                        //$image_name= "Food_Category_".rand(000,999).'.'$ext;  // e.g Food_Category_834.jpg

                        $source_path=$_FILES['category_img_name']['tmp_name'];

                        $destination_path= "../images/category/".$image_name;

                        //finally upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //if img is not uploaded then we will stop the process and redirect with error msg
                        if($upload==false)
                        {
                            //set msg
                            $_SESSION['upload'] = "<div class='text-red'>Failed to upload image.</div>";
                            header('location'.SITEURL.'admin/add_category.php');
                            //stop the process
                            die();

                        }
                        
                    }
                }
                else
                {
                    //don't Upload image and set the img name value as blank
                    $image_name="";
                }

                //2. Create sql query to insert category in db
                $sql="INSERT INTO tbl_category SET 
                        category_title='$category_title',
                        category_img_name='$image_name',
                        category_featured='$category_featured',
                        category_active='$category_active'
                        ";

                //3. Execute the query and save in db
                $res = mysqli_query($conn,$sql);

                //4. Check whether the query executed or not 

                if($res==true)
                {
                    //Query executed
                    $_SESSION['add']="<div class='text-green'>Category Added Successfully</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
                else
                {
                    //failed to add category
                    $_SESSION['add']="<div class='text-red text-center'>Failed to add Category</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
               
            }




        ?>
</div>
</div>
</div>
</div>