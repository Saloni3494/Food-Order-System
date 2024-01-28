<?php include('../config/constant.php'); ?>
<?php include('partials/menu-login.php'); ?>
<head>


    <style>
        .test{
            margin: 10px;
        }
    </style>

    <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/style_2.css">
   <link rel="stylesheet" href="../css/admin.css">
</head>

<h3 class="text-center text-white test">Login as Admin to Manage the Categories, Food and Order.</h3>

   <div id='login-form' class='login-page'>
	<div class="form-container">
      <div class="form-box">
         <div class='button-box'>
            <div id='btn'></div>
			    <button type='button' onclick='login()'class='toggle-btn'>Log in</button>
         </div>

         <?php
         
         if(isset($_SESSION['no-login-message']))
         {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
            echo '<script>console.log("Failed"); </script>'; 
         }

         ?>

            
            <form id='login' class='input-group-login' action="" method="POST">
                <br/>
               <input type="email" class='input-field'name="admin_username" required placeholder="enter your username"><br/><br/>
               <input type="password" class='input-field' name="admin_password" required placeholder="enter your password">
               <div class="text-white"><input type='checkbox' class='check-box' >Remember Password</div>
               <input type="submit" name="submit" class='submit-btn text-black' value="Log In As Admin"><br/>
               <p><div class="text-white text-center">Don't have an account? <a href="add_admin.php" class="text-blue">Register now</a></div></p>
			   
               </form>
     
      </div>

	</div>
   </div>

<?php
    //check whether submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for login
        //1.Get the data from login form
       // $admin_username=$_POST['admin_username'];
       //$admin_password=md5($_POST['admin_password']);
       
       $admin_username=mysqli_real_escape_string($conn,$_POST['admin_username']);

       $raw_password=md5($_POST['admin_password']);
       $admin_password=mysqli_real_escape_string($conn, $raw_password);

       //2. Sql to check whether the user with username and password exists or not
       $sql="SELECT * FROM tbl_admin WHERE admin_username='$admin_username' AND admin_password='$admin_password'";

       //3.Execute query
       $res=mysqli_query($conn,$sql);

       //4. count rows to check whether the user exists or not
       $count = mysqli_num_rows($res);

       if($count==1)
       {
            //User available
            $_SESSION['login'] = "<div class='text-green'>Login Successful.</div>";
            $_SESSION['user'] =$admin_username;

            //redirect to home page of admin
            header('location:'.SITEURL.'admin/admin_page.php');
       }
       else
       {
        //User available
        $_SESSION['login'] = "<div class='text-red text-center'>Login Failed.</div>";
        //redirect to home page of admin
        header('location:'.SITEURL.'admin/login.php');

       }
    }


?>