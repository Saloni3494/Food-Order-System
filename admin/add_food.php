<?php include('partials/menu.php'); ?>

<head>
<div class="form-box-add-food">
      <div class="navbar">
      <div>
      <h2 class="text-white">Add Food</h2>
      <br/>
      <br/>

      <?php 

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

      ?>

      <div class="text-white">
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="table-200">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="food_title" placeholder="Title of Food">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="food_description" cols="50" rows="5" placeholder="Description of the Food"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="food_price">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category ID: </td>
                <td>
                    <select name="category">

                        <?php

                            //create php code to display data from db
                            //1. create sql to get all active categories from db
                            $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";

                            //execute query
                            $res = mysqli_query($conn,$sql);

                            //count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //if count is greater than 0 we have categories, else we do not have categories

                            if($count>0)
                            {
                                //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get categories
                                    $category_id = $row['category_id'];
                                    $category_title = $row['category_title'];
                                    ?>

                                    <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                    <?php

                                }
                            }
                            else
                            {
                                //we do not have categories
                                ?>
                                <option value="0">No Category Found</option>

                                <?php
                            }

                            //2. display on dropdown

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="food_featured" value='Yes'>Yes
                    <input type="radio" name="food_featured" value='No'>No

                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="food_active" value='Yes'>Yes
                    <input type="radio" name="food_active" value='No'>No

                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary-category">
                </td>

        </table>
     </form>

     <?php  

        //check whether the buttonn is clicked or not
        if(isset($_POST['submit']))
        {
            //add the food in db
           // echo "Button clicked";

           //1. get the data frokm form
        //    $food_title=$_POST['food_title'];
        //    $food_description=$_POST['food_description'];
        //    $food_price=$_POST['food_price'];
        //    $category=$_POST['category'];

           $food_title=mysqli_real_escape_string($conn, $_POST['food_title']);
           $food_description=$food_title=mysqli_real_escape_string($conn, $_POST['food_description']);
           $food_price= $food_title=mysqli_real_escape_string($conn, $_POST['food_price']);
           $category= $food_title=mysqli_real_escape_string($conn, $_POST['category']);

           //check whether radio for featured and active is set or not
           if(isset($_POST['food_featured']))
           {
            $food_featured=$food_title=mysqli_real_escape_string($conn, $_POST['food_featured']);
           }
           else
           {
            $food_featured = 'No';  //setting default value
           }

           if(isset($_POST['food_active']))
           {
            $food_active=$food_title=mysqli_real_escape_string($conn, $_POST['food_active']);
           }
           else
           {
            $food_active = 'No';  //setting default value
           }

           //2. Upload the image if selected

           //check whether the select image btn is clicked or not and upload the img only if the img is selected
           if(isset($_FILES['image']['name']))
           {
                //get the details of the selected img
                $food_img_name=$_FILES['image']['name'];

                //check whether the img is selected or not and upload the image only if selected
                if($food_img_name != "")
                {
                    //img is selected
                    //A. Rename the image

                    //get extension
                   //$ext = end(explode('.',$food_img_name));

                    //create new name for img
                   //$food_img_name = "Food-Name-".rand(0000,9999).".".$ext;   //creates new img name:  Food-Name-789.jpg

                    //B. Upload the image
                    //get src path and destination path

                    //Source path is the current location of img
                    $src = $_FILES['image']['tmp_name'];

                    //Destination path of the img to be uploaded
                    $dst = "../images/food/".$food_img_name;

                    //finally upload the food image
                    $upload =  move_uploaded_file($src, $dst);

                    //check whether img uploaded or not
                    if($upload==false)
                    {
                        //failed to upload img
                        //redirect to add food page with error msg
                        $_SESSION['upload'] = "<div class='text-red'>Failed to Upload Image</div>";
                        header('location:'.SITEURL.'admin/add_food.php');
                        //stop process
                        die();
                    }

                }
           }
           else
           {
                $food_img_name="";  //setting image name as blank
           }

           //3. Insert in db

           //create sql query to save food 
           $sql2 = "INSERT INTO tbl_food SET
                    food_title = '$food_title',
                    food_description = '$food_description',
                    food_price = $food_price,
                    food_img_name = '$food_img_name',
                    c_id = $category,
                    food_featured = '$food_featured',
                    food_active = '$food_active'
                    ";

            //exectue query
            $res2 = mysqli_query($conn,$sql2);

            //check whether data is inserted or not
            //4.Redirect with msg to manage food page

            if($res2 == true)
            {
                //data inserted successfully
                $_SESSION['add'] = "<div class='text-green'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
            }
            else
            {
                //failed to insert data
                $_SESSION['add'] = "<div class='text-red'>Failed to Add Food</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
            }

           
        }

     ?>


</div>
</div>
</div>
</div>