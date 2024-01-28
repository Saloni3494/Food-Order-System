<?php include('config/constant.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
    <link rel="icon" type="image/x-icon" href="/images/favicon_new.png">
    <title>Tasty Trove</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style_2.css">
    <link rel="stylesheet" href="css/style.css">

    <?php
            if(isset($_SESSION['order']))  //Checking whether the session is set or not
            {
                echo $_SESSION['order'];    //Displaying Session message
                unset($_SESSION['order']);  //removing Session message
            }
      ?>

</head>

<body>
    
 <div class="full-page-order">
    <!-- Navbar Section Starts Here -->
    <div class="navbar">
    <div class="nav-left">
            <img src="images/tasty_trove_logo_new.png" alt="logo" class="logo">
            <img src="images/tasty_trove_slogan_new.png" alt="slogan" class="slogan">
		</div>
    
        <div class="container">
            
                <!--<a href="#" title="Logo">
                    <img src="images/web_logo.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>-->
            
        
            <div class="clearfix"></div>
        </div>
</div>