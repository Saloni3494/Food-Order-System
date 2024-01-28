<?php include('../config/constant.php'); ?>


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

<head>
<div class="form-box-add">
      <div class="navbar">
      <div>
      <h2 class="text-white">Add Admin</h2>
      <br/>
      <br/>

      <?php
            if(isset($_SESSION['add']))  //Checking whether the session is set or not
            {
                echo $_SESSION['add'];    //Displaying Session message
                unset($_SESSION['add']);  //removing Session message
            }
      ?>

      <div class="text-white">
    <form action="" method="POST">
      <table class="table-150">
        <tr>
            <td>Full Name:</td>
            <td><input type="text" name="admin_name" placeholder="Enter your full name"></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="admin_username" placeholder="Your Username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="admin_password" placeholder="Enter your password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </td>
        </tr>
      </table>
    </form>   
      
</div>
</div>
</div>
        </div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>


<?php include('partials/footer.php'); ?>

<?php

    //1.GET data from form
 if(isset($_POST['submit']))
 {

   // $admin_name = $_POST['admin_name'];
    //$admin_username = $_POST['admin_username'];
    //$admin_password = md5($_POST['admin_password']);   //password encryption with MD5


    $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
    $admin_username = mysqli_real_escape_string($conn,$_POST['admin_username']);

    $raw_password = md5($_POST['admin_password']);   //password encryption with MD5
    $admin_password = mysqli_real_escape_string($conn, $raw_password);

    //2.SQL QUery to save data in db

     $sql = "INSERT INTO tbl_admin SET 
        admin_name='$admin_name',
        admin_username='$admin_username',
        admin_password='$admin_password'
        ";



    
    //3. Executing  Query and saving data into db
     $res = mysqli_query($conn,$sql) or die(mysqli_error());

     //4. Check whether the (query is executed) data is inserted or not and display appropriate messages
     if($res==true)
     {
        //echo "Data Inserted";
        //create a session variable to display a message
        $_SESSION['add'] = "<div class='text-green'>Admin Added Successfully</div>";
        //Redirect Page Manage Admin
        header('location:'.SITEURL.'admin/manage_admin.php');
     }
     else
     {
        //echo "Failed to insert data";
        $_SESSION['add'] = "<div class='text-red'>Failed to Add Admin</div>";
        //Redirect Page Manage Admin
        header('location:'.SITEURL.'admin/add_admin.php');

     }

 }





?>