<?php include('partials/menu-order.php'); ?>

<head>

    <?php
            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }

        ?>

</head>

<?php

   

    //check whether food id is set or not
    if(isset($_GET['food_id']))
    {
        //get the food id and details of selected food
        $food_id = $_GET['food_id'];

        //get the details of selected food

        $sql = "SELECT * FROM tbl_food WHERE food_id = $food_id";
        $res=mysqli_query($conn,$sql);

        //count the rows
        $count = mysqli_num_rows($res);

        //check whether data is available oor not
        if($count==1)
        {
            //we have data
            //get data from db

            $row = mysqli_fetch_assoc($res);

            $food_title = $row['food_title'];
            $food_price = $row['food_price'];
            $food_img_name = $row['food_img_name'];
        }
        else
        {
            //food not available
            //redirect to home page
            header('location:'.SITEURL);
        }

    }
    else
    {
        //redirect to home page
        header('location:'.SITEURL);
    }

?>




    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
    

      

      
    
      <form action="" method="POST" class="order"> 
            <fieldset>
                <legend class="text-white">Selected Food</legend>

                <div class="food-menu-img">

            <?php

                    //check whether the img is available or not
                    if($food_img_name=="")
                    {
                        //img not available
                        echo "<div class='text-red'>Image Not Available</div>";
                    }
                    else
                    {
                        //img available
                        ?>

                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $food_img_name; ?>"alt="Image" class="img-responsive img-curve">


                        <?php

                    }

            ?>
            </div>

                <div class="food-menu-desc">
                    <h3 class="text-white"><?php echo $food_title; ?></h3>
                    <p class="food-price text-white"><?php echo $food_price; ?></p>

                    <div class="order-label text-white">Quantity</div>
                    <input type="number" name="order_qty" class="input-responsive" value="1" required>

                </div>

                </fieldset>

                <fieldset>
                    <legend  class="text-white">Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="customer_name" placeholder="E.g. Saloni Tanmor" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="customer_contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="customer_email" placeholder="E.g. abc@xyz.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="customer_address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="hidden" name="order_food" value="<?php echo $food_title; ?>">
                    <input type="hidden" name="order_price" value="<?php echo $food_price; ?>">
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
    </form>   
      
</div>
</div>
</div>




<?php

    //1.GET data from form
 if(isset($_POST['submit']))
 {
    // $order_food = $_POST['order_food'];
    // $order_price = $_POST['order_price'];
    // $order_qty = $_POST['order_qty'];

    $order_food = mysqli_real_escape_string($conn, $_POST['order_food']);
    $order_price = mysqli_real_escape_string($conn, $_POST['order_price']);
    $order_qty = mysqli_real_escape_string($conn, $_POST['order_qty']);

    $order_total = $order_price * $order_qty;    //total =price*qty

    $order_date = date('Y-m-d');      //order_date

    $order_status = "Ordered";         //ordered, on delivery, delivered, cancelled

    // $customer_name = $_POST['customer_name'];
    // $customer_contact = $_POST['customer_contact'];
    // $customer_email = $_POST['customer_email'];
    // $customer_address = $_POST['customer_address'];

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

    $sql2 = "INSERT INTO tbl_order SET
    order_food = '$order_food',
    order_price = $order_price,
    order_qty = $order_qty,
    order_total = $order_total,
    order_date = '$order_date',
    order_status = '$order_status',
    customer_name = '$customer_name',
    customer_contact = '$customer_contact',
    customer_email = '$customer_email',
    customer_address = '$customer_address'
";



    
    //3. Executing  Query and saving data into db
     $res2 = mysqli_query($conn,$sql2) or die(mysqli_error());

     //4. Check whether the (query is executed) data is inserted or not and display appropriate messages
     if($res2==true)
     {
        //echo "Data Inserted";
        //create a session variable to display a message
        $_SESSION['order'] = "<div class='text-green text-center'>Order Placed successfully</div>";
        //Redirect Page Manage Admin
        header('location:'.SITEURL);
     }
     else
     {
        //echo "Failed to insert data";
        $_SESSION['order'] = "<div class='text-red text-center'><b><h2>Failed to place Order</h2></b></div>";
        //Redirect Page Manage Admin
        header('location:'.SITEURL.'order.php');

     }

 }

?>

<?php include('partials/footer.php'); ?>