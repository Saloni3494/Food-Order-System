<?php include('partials/menu.php'); ?>

<head>

      <div class="navbar">
      <div>
      <h2 class="text-white">Update Order</h2>
      <br/>
      <br/>

      <br/><br/>

      <?php

        //check whether the id is set or not
        if(isset($_GET['order_id']))
        {
            //get all details
            //echo "Getting the data";
            $order_id=$_GET['order_id'];

            //sql query to get all details
            $sql2="SELECT * FROM tbl_order WHERE order_id=$order_id";

            //execute query
            $res2=mysqli_query($conn,$sql2);

            $count2 = mysqli_num_rows($res2);

            if($count2==1)
            {

            $row2 = mysqli_fetch_assoc($res2);

            //count rows to check whether the id is valid nor
            

            
                //get all data
                
                
                $order_food = $row2['order_food'];
                $order_price = $row2['order_price'];
                $order_qty = $row2['order_qty'];
                $order_status = $row2['order_status'];
                $customer_name = $row2['customer_name'];
                $customer_contact = $row2['customer_contact'];
                $customer_email = $row2['customer_email'];
                $customer_address = $row2['customer_address'];
                

            }
            else
            {
                header('location:'.SITEURL.'admin/manage_order.php');
            }
        }
           else
           {
                //redirect to manage food page with msg
               
                header('location:'.SITEURL.'admin/manage_order.php');
            }
        
        

      ?>

      <div class="text-white">
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="table-150">
            <tr>
                <td>Food Name: </td>
                <td name="order_food" class="text-white"><b><?php echo $order_food; ?></b></td>    
            </tr>

            <tr>
                <td>Price: </td>
                <td name="order_price" class="text-white"><b><?php echo $order_price; ?></b></td>    
            </tr>

            <tr>
                <td>Qty: </td>
                <td>
                    <input type="number" name="order_qty" value="<?php echo $order_qty; ?>">
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option <?php if($order_status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($order_status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($order_status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($order_status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
                        
            <tr>
                <td>Customer Name: </td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Contact: </td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Email: </td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Address: </td>
                <td>
                <textarea name="customer_address" cols="50" rows="5"><?php echo $customer_address; ?></textarea>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                    <input type="hidden" name="order_price" value="<?php echo $order_price; ?>">
                    <input type="submit" name="submit" value="Update Order" class="btn-secondary-category">
            </td>

           
        </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. get all values from our form
                // $order_id=$_POST['order_id']; 
                // $order_price = $_POST['order_price'];
                // $order_qty = $_POST['order_qty'];
                // $order_total = $order_price * $order_qty;
                // $order_status = $_POST['status'];
                // $customer_name = $_POST['customer_name'];
                // $customer_contact = $_POST['customer_contact'];
                // $customer_email = $_POST['customer_email'];
                // $customer_address = $_POST['customer_address'];

                $order_id=mysqli_real_escape_string($conn, $_POST['order_id']); 
                $order_price = mysqli_real_escape_string($conn, $_POST['order_price']);
                $order_qty = mysqli_real_escape_string($conn, $_POST['order_qty']);
                $order_total = $order_price * $order_qty;
                $order_status = mysqli_real_escape_string($conn, $_POST['status']);
                $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
                $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
                $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
                $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

               
                //3.Update db
                $sql3 = "UPDATE tbl_order SET
                        order_qty = $order_qty,
                        order_total = $order_total,
                        order_status = '$order_status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        WHERE order_id = $order_id";

                //execute query
                $res3 = mysqli_query($conn,$sql3);

                //4.Redirect to manage food with msg
                //check whether query executed or not
                if($res3==true)
                {
                    //food updated
                    $_SESSION['update']="<div class='text-green'>Order Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                    
                }
                else
                {
                    //food not updated
                    $_SESSION['update']="<div class='text-red'>Failed to Update Order</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                }

            }

        ?>
</div>
</div>
</div>
</div>