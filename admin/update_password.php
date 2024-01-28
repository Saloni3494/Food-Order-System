<?php include('partials/menu.php'); ?>

<head>
<link rel="stylesheet" href="../css/style.css">
</head>
<div class="form-box-add">
      <div class="navbar">
      <div>
      <h2 class="text-white">Update Password</h2>
      <br/>
      <br/>

      <?php

        if(isset($_GET['admin_id']))
        {
            $admin_id=$_GET['admin_id'];
        }

      ?>

<div class="text-white">
      <form action="" method="POST">

        <table class="table-150">
            <tr>
                <td>Current Password: </td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>
            <tr>
                <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
            
        </table>

      </form>
</div>
</div>

<?php

        //Check whether submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Clicked";

            //1.get the data from form
            // $admin_id=$_POST['admin_id'];
            // $current_password=md5($_POST['current_password']);
            // $new_password=md5($_POST['new_password']);
            // $confirm_password=md5($_POST['confirm_password']);

            $admin_id=mysqli_real_escape_string($conn, $_POST['admin_id']);

            $raw_current_password=md5($_POST['current_password']);
            $current_password = mysqli_real_escape_string($conn, $raw_current_password);

            $raw_new_password=md5($_POST['new_password']);
            $new_password = mysqli_real_escape_string($conn, $raw_new_password);

            $raw_confirm_password=md5($_POST['confirm_password']);
            $confirm_password = mysqli_real_escape_string($conn, $raw_confirm_password);


            //2.check whether the user with current ID and current password exist or not
            $sql="SELECT * FROM tbl_admin WHERE admin_id=$admin_id AND admin_password='$current_password'";

            //exectue query
            $res=mysqli_query($conn,$sql);

            if($res==true)
            {
                //Check whether data is available or not 
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //User exists and password can be changed
                    //echo "User Found";

                    //Check whether the new password and confirm password match or not
                    if($new_password==$confirm_password)
                    {
                        //Update the password
                        $sql2= "UPDATE tbl_admin SET 
                                admin_password='$new_password'
                                WHERE admin_id=$admin_id";

                        //execute query
                        $res2=mysqli_query($conn,$sql2);

                        //Check whether query executed or not
                        if($res2==true)
                        {
                            //display success message
                                $_SESSION['change-pwd']="<div class='text-green'>Password Changed Successfully.</div>";
                        //Redirect the page
                        header('location:'.SITEURL.'admin/manage_admin.php');

                        }
                        else
                        {
                            //display error message
                            $_SESSION['change-error']="<div class='text-red'>Failed to Change Password.</div>";
                        //Redirect the page
                        header('location:'.SITEURL.'admin/manage_admin.php');

                        }
                    }
                    else
                    {
                        //Error message
                        $_SESSION['pwd-not-found']="<div class='text-red'>Password did not match.</div>";
                    //Redirect the page
                    header('location:'.SITEURL.'admin/manage_admin.php');
                    }
                }
                else{
                    //User does not exists set message and redirect
                    $_SESSION['user-not-found']="<div class='text-red'>User Not Found.</div>";
                    //Redirect the page
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
            }

            //3.check whether the new password and confirm password match or or

            //4.Change password if all above is true
        }

?>
