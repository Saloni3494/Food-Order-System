<?php include('partials/menu.php'); ?>

<head>
<link rel="stylesheet" href="../css/style.css">
</head>
<div class="form-box-add">
      <div class="navbar">
      <div>
      <h2 class="text-white">Update Admin</h2>
      <br/>
      <br/>

      <?php 

        //1. Get the id of selected admin
        $admin_id=$_GET['admin_id'];

        //2. create sql query to get details
        $sql="SELECT * FROM tbl_admin WHERE admin_id=$admin_id";

        //Execute query
        $res=mysqli_query($conn,$sql);

        //check whether the query is executed or not
        if($res==TRUE)
        {
            //Check whether the data is available or not 
            $count=mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count==1)
            {
                //get details
                //echo "Admin Available"; 
                $row=mysqli_fetch_assoc($res);

                $admin_name=$row['admin_name'];
                $admin_username=$row['admin_username'];

            }
            else
            {
               // Redirect to manage Admin page
               header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }


      ?>

      <div class="text-white">
      <form action="" method="POST">
        <table class="table-150">
            <tr>
                <td>Full Name: </td>
                <td>
                    <input type="text" name="admin_name" value="<?php echo $admin_name; ?>">
                </td>
            </tr>
            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="admin_username" value="<?php echo $admin_username; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    
                  <div class="text-black">
                  <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">

                </div>
                </td>
            </tr>
        </table>
    </form>
</div>
</div>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";

        //get all values from form to update
        // $admin_id=$_POST['admin_id'];
        // $admin_name=$_POST['admin_name'];
        // $admin_username=$_POST['admin_username'];

        $admin_id=mysqli_real_escape_string($conn, $_POST['admin_id']);
        $admin_name=mysqli_real_escape_string($conn, $_POST['admin_name']);
        $admin_username=mysqli_real_escape_string($conn, $_POST['admin_username']);

        //create sql query to update admin
        $sql="UPDATE tbl_admin SET 
                admin_name='$admin_name', admin_username='$admin_username'
                WHERE admin_id='$admin_id'";

        //Execute the query
        $res=mysqli_query($conn,$sql);

        //Check whether the query executed succesfsfully or not
        if($res==TRUE)
        {
            //Query updated succesfully
            $_SESSION['update'] = "<div class='text-green'>Admin Updated Successfully</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
        else
        {
            //Failed to update
            $_SESSION['update'] = "<div class='text-red'>Failed to Update Admin</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
    }
?>


