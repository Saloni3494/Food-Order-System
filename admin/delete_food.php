<?php

    //include constants file
    include('../config/constant.php');

   // echo "Delete Page";
   //check whether the id and food_img_name value is set or not

   if(isset($_GET['food_id']) AND isset($_GET['food_img_name']))
   {
    //get the value and delete
    //echo "Get value and delete";
    $food_id=$_GET['food_id'];
    $food_img_name=$_GET['food_img_name'];

    //first remove the physical image file if available 
    if($food_img_name != "")
    {
        //image is available. so remove it
        $path = "../images/food/".$food_img_name;
        //remove image
        $remove = unlink($path);

        //if failed to remove then add an error msg and stop the process
        if($remove==false)
        {
            //set session msg
            $_SESSION['remove-food']="<div class='text-red'>Failed to remove Food Image.</div>";
            //redirect to manage food page
            header('location:'.SITEURL.'admin/manage_food.php');
            //stop process
            die();

        }
    }

    //delete data from db
    $sql="DELETE FROM tbl_food WHERE food_id=$food_id";

    //execute query
    $res=mysqli_query($conn,$sql);

    //check whether data is deleted from db or not
    if($res==true)
    {
        //set success msg and redirect
        $_SESSION['delete']="<div class='text-green'>Food Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }
    else{
        //set fail msg and redirect
        $_SESSION['delete']="<div class='text-red'>Failed to Delete Food</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }

    //redirect to manage food page with msg

   }
   else
   {
    //redirect to manage food page
    header('location:'.SITEURL.'admin/manage_food.php');
   }

?>