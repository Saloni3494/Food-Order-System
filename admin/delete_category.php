<?php

    //include constants file
    include('../config/constant.php');

   // echo "Delete Page";
   //check whether the id and category_img_name value is set or not

   if(isset($_GET['category_id']) AND isset($_GET['category_img_name']))
   {
    //get the value and delete
    //echo "Get value and delete";
    $category_id=$_GET['category_id'];
    $category_img_name=$_GET['category_img_name'];

    //first remove the physical image file if available 
    if($category_img_name != "")
    {
        //image is available. so remove it
        $path = "../images/category/".$category_img_name;
        //remove image
        $remove = unlink($path);

        //if failed to remove then add an error msg and stop the process
        if($remove==false)
        {
            //set session msg
            $_SESSION['remove']="<div class='text-red'>Failed to remove Category Image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage_category.php');
            //stop process
            die();

        }
    }

    //delete data from db
    $sql="DELETE FROM tbl_category WHERE category_id=$category_id";

    //execute query
    $res=mysqli_query($conn,$sql);

    //check whether data is deleted from db or not
    if($res==true)
    {
        //set success msg and redirect
        $_SESSION['delete']="<div class='text-green'>Category Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage_category.php');
    }
    else{
        //set fail msg and redirect
        $_SESSION['delete']="<div class='text-red'>Failed to Delete Category</div>";
        header('location:'.SITEURL.'admin/manage_category.php');
    }

    //redirect to manage category page with msg

   }
   else
   {
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage_category.php');
   }

?>