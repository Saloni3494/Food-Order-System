<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name,email, password,user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:index.php');
      }
   }

};


?>

<?php include('partials/menu.php'); ?>

<div id='login-form' class='login-page'>
<div class="form-container">
   <div class="form-box">
      <div class='button-box'>
         <div id='btn'></div>
            <button type='button' onclick='login()'class='toggle-btn'>Register</button>
         </div>
   <form id='login' class='input-group-login' action="" method="post">
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" class='input-field' required placeholder="enter your name">
      <input type="email" name="email" class='input-field' required placeholder="enter your email">
      <input type="password" name="password" class='input-field' required placeholder="enter your password">
      <input type="password" name="cpassword" class='input-field' required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select><p><br></p>
      <input type="submit" name="submit" class='submit-btn' value="Register now"><br>
      <p style="text-align:center;"><font color="white">Already have an account?</p>
      <a href="index.php" style="text-align:center"><font color="black">Log In</font> </a>
   </form>

</div>
</div>

<p><br><br></p>
<?php include('partials/footer.php'); ?>

</body>
</html>