<?php

    //Include constant.php
    include('../config/constant.php');

    //1.Get id of admin to be deleted
    $admin_id = $_GET['admin_id'];

    
    //2.Create SQL query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE admin_id=$admin_id";

    //Execute the query
    $res = mysqli_query($conn,$sql);
 
    //check whether query executed successfully  or not 
    if($res==TRUE)
    {
       // echo "Admin Deleted";
       
        //create session variable to display msg
        $_SESSION['delete']="<div class='text-green'>Admin Deleted Successfully</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage_admin.php');
    }
    else
    {
        //echo "Failed to delete admin";
        $_SESSION['delete']="<div class='text-red'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage_admin.php');
       

    }

    //3. Redirect to manage Admin page with msg(success/error)

?>
