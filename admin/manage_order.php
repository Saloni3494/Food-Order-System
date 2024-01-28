<?php include('partials/menu.php'); ?>


<div class="navbar">
      <div>
      <h2 class="text-white">Manage Order</h2>

    <?php 

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

    ?>

      
</div>
</div>
      <table class="table-full">
        <tr class="text-white">
            <th style="width:70%">S.N</th>
            <th>Food</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Customer Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>

        <?php

            $sql="SELECT * FROM tbl_order ORDER BY order_id DESC";
            //executed query
            $res=mysqli_query($conn,$sql);

            //count rows
            $count=mysqli_num_rows($res);

            //create serial number variable
            $sn=1;

            //check whether we have data in db or not
            if($count>0)
            {
                //we have data in db
                //get data and display
                while($row=mysqli_fetch_assoc($res))
                {
                    $order_id=$row['order_id'];
                    $order_food=$row['order_food'];
                    $order_price=$row['order_price'];
                    $order_qty=$row['order_qty'];
                    $order_total=$row['order_total'];
                    $order_date=$row['order_date'];
                    $order_status=$row['order_status'];
                    $customer_name=$row['customer_name'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $customer_address=$row['customer_address'];


                    ?>

                    <tr>
                        <td class="text-white"><div class="col-1 text-center"><?php echo $sn++; ?></div></td>
                        <td class="text-white"><div class="col-2"><?php echo $order_food; ?></div></td>
                        <td class="text-white"><div class="col-3"><?php echo $order_price; ?></div></td>
                        <td class="text-white"><div class="col-4"><?php echo $order_qty; ?></div></td>
                        <td class="text-white"><div class="col-5"><?php echo $order_total; ?></div></td>
                        <td class="text-white"><div class="col-6">
                            
                            <?php 

                                if($order_status=="Ordered")
                                {
                                    echo "<label>$order_status</label>";
                                }
                                elseif($order_status=="On Delivery")
                                {
                                    echo "<label style='color: #ffa502;'>$order_status</label>";
                                }
                                elseif($order_status=="Delivered")
                                {
                                    echo "<label style='color: green;'>$order_status</label>";
                                }
                                elseif($order_status=="Cancelled")
                                {
                                    echo "<label style='color: red;'>$order_status</label>";
                                }
                            
                            ?>
                        
                        </div></td>
                        <td class="text-white"><div class="col-7"><?php echo $order_status; ?></div></td>
                        <td class="text-white"><div class="col-8"><?php echo $customer_name; ?></div></td>
                        <td class="text-white"><div class="col-9"><?php echo $customer_contact; ?></div></td>
                        <td class="text-white"><div class="col-10"><?php echo $customer_email; ?></div></td>
                        <td class="text-white"><div class="col-11"><?php echo $customer_address; ?></div></td>
                        <td>
                            <div class="col-12">
                            <a href="<?php echo SITEURL; ?>admin/update_order.php?order_id=<?php echo $order_id; ?>" class="btn-secondary-category">Update Order</a>
                            </div>
                        </td>
                    </tr>

                    <?php
                }
            }
            else
            {
                //we do not have data in db
                //we'll display msg inside table
                ?>
                <tr>
                    <td colspan="12">
                        <div class="text-red">No Customers Added</div>
                    </td>
                </tr>

                <?php
            }

        ?>
        
    </table>
</div>
</div>
</div>

<?php include('partials/footer.php'); ?>