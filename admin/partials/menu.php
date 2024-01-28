<?php

      include('../config/constant.php'); 
      include('login-check.php');
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/style_2.css">
   <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
<div class="full-page-admin"> 
   <p><br></p>
      <div class="text-bold"><h1 class="text-white">ADMIN PANEL</h1></div>
      <div class="navbar">
       
         
			<div>
            <img src="../images/tasty_trove_logo_new.png" alt="logo" class="logo">
           
		</div>
        
         <nav>
            <ul id='MenuItem'>
               <li><a class="link-style" href='admin_page.php'>Home</a></li>
               <li><a class="link-style" href='manage_admin.php'>Admin</a></li>
               <li><a class="link-style" href='manage_category.php'>Category</a></li>
               <li><a class="link-style" href='manage_food.php'>Food</a></li>
               <li><a class="link-style" href="manage_order.php">Order</a><li>
               <li><a class="link-style" href="../logout.php">Logout</a><li>

               
               
            </ul>
         </nav>
      </div>