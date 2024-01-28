<?php
   //Chek whether the user is logged in or not
   //Authorization or access control

   if(!isset($_SESSION['user']))   //if user session is not set
   {
    //if user is not logged in
    //redirect to login page with msg
    $_SESSION['no-login-message']="<div class='text-red text-center'>Please Login to access Admin Panel.</div>";
    
    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
   }
?>