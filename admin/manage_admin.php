<?php include('partials/menu.php'); ?>
<head>
    
<div class="form-box-ad-categories">
      <div class="navbar">
      <div>
      <h2 class="text-white">Manage Admin</h2>
      <br/><br/>
      
<div class="text-white">
      <?php
            if(isset($_SESSION['add']))  //Checking whether the session is set or not
            {
                echo $_SESSION['add'];    //Displaying Session message
                unset($_SESSION['add']);  //removing Session message
            }

            if(isset($_SESSION['delete']))  //Checking whether the session is set or not
            {
                echo $_SESSION['delete'];    //Displaying Session message
                unset($_SESSION['delete']);  //removing Session message
            }

            if(isset($_SESSION['update']))  //Checking whether the session is set or not
            {
                echo $_SESSION['update'];    //Displaying Session message
                unset($_SESSION['update']);  //removing Session message
            }

            if(isset($_SESSION['user-not-found']))  //Checking whether the session is set or not
            {
                echo $_SESSION['user-not-found'];    //Displaying Session message
                unset($_SESSION['user-not-found']);  //removing Session message
            }

            if(isset($_SESSION['pwd-not-found']))  //Checking whether the session is set or not
            {
                echo $_SESSION['pwd-not-found'];    //Displaying Session message
                unset($_SESSION['pwd-not-found']);  //removing Session message
            }

            if(isset($_SESSION['change-pwd']))  //Checking whether the session is set or not
            {
                echo $_SESSION['change-pwd'];    //Displaying Session message
                unset($_SESSION['change-pwd']);  //removing Session message
            }

            if(isset($_SESSION['change-error']))  //Checking whether the session is set or not
            {
                echo $_SESSION['change-error'];    //Displaying Session message
                unset($_SESSION['change-error']);  //removing Session message
            }
      ?>
      <br/><br/>
</div>

      <a href="add_admin.php" class="btn-primary-add">Add Admin</a>
      <br/><br/>
</div>
</div>

      <table class="table-full">
        
        
        <tr class="text-white">
            <th>S.N</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
       
        <?php 
            //Query to get all Admins
            $sql = "SELECT * FROM tbl_admin";
            //Execute Query
            $res=mysqli_query($conn,$sql);

            //Check whether query is executed or not
            if($res==TRUE)
            {
                //Count rows to check whether we have data in db or not
                $count=mysqli_num_rows($res);    //function to get all rows in db

                $sn=1; //assign a variable to display it in S.N column of the table

                //check no of rows
                if($count>0)
                {
                    //we have data in db    
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //using while loop to get all data in db
                        //while loop will execute until we have data in db

                        //get indivi data
                        $admin_id=$rows['admin_id'];
                        $admin_name=$rows['admin_name'];
                        $admin_username=$rows['admin_username'];

                        //display values in table
                        ?>
                            
                            <tr>
                                        <td class="text-white"><div class="col-1"><?php echo $sn++; ?></div></td>
                                        <td class="text-white"><div class="col-2"><?php echo $admin_name; ?></div></td>
                                        <td class="text-white"><div class="col-3"><?php echo $admin_username; ?></div></td>
                                        <td>
                                        <div class="col-4">
                                        <a href="<?php echo SITEURL; ?>admin/update_password.php?admin_id=<?php echo $admin_id; ?>" class="btn-change_ps">Change Password</a>&nbsp; &nbsp;
                                            <a href="<?php echo SITEURL; ?>admin/update_admin.php?admin_id=<?php echo $admin_id; ?>" class="btn-secondary">Update Admin</a>&nbsp; &nbsp;
                                            <a href="<?php echo SITEURL; ?>admin/delete_admin.php?admin_id=<?php echo $admin_id; ?>" class="btn-delete">Delete Admin</a>&nbsp; &nbsp;
                                            </div>
                                        </td>
                                    </tr>
                   

                        <?php 

                    }
                }
            }

        ?>

        

    </table>
        </div>

</div>
</div>
</div>
<?php include('partials/footer.php'); ?>
