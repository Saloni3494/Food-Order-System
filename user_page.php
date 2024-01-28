<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:index.php');
}

?>

<?php include('partials/menu.php'); ?>

<div class="form-box">
<div class="container">
   <div class="content">
      <h3><font color="white">Hi, User</font></h3>
      <h1><font color="white">Welcome</font><font color=#e61740b6> <?php echo $_SESSION['user_name'] ?></font></h1>
      <p style="text-align:center;"><font color="white">This is a user page</font></p><br>
      <a href="index.php" class="btn" style="text-align:center">Login</a><br>
      <a href="register_form.php" class="btn" style="text-align:center">Register</a><br>
      <a href="logout.php" class="btn" style="text-align:center">Logout</a><br>
   </div>
</div>

</div>
</div>

<?php include('partials/footer.php'); ?>

