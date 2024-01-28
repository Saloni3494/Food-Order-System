
<?php include('partials/menu.php'); ?>



<div class="form-box-dashboard">
   <div class="container">
      <div class="content">
         <br/><br/>
      <h2 class="text-white">Dashboard</h2>

      <?php
         if(isset($_SESSION['login']))
         {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
            echo '<script>console.log("Success"); </script>'; 
         }

      ?>      
      <br/>

      

      <div class="food-menu-box">
         <div class="food-menu-desc">

            <?php

               $sql = "SELECT * FROM tbl_category";
               $res = mysqli_query($conn,$sql);

               //count rows
               $count = mysqli_num_rows($res);


            ?>
            <h1 class="text-black"><?php echo $count; ?></h1>
            <h3 class="text-black">Categories</h1>
         </div>
      </div>

      <div class="food-menu-box">
         <div class="food-menu-desc">

            <?php

               $sql2 = "SELECT * FROM tbl_food";
               $res2 = mysqli_query($conn,$sql2);

               //count rows
               $count2 = mysqli_num_rows($res2);

            ?>

            <h1 class="text-black"><?php echo $count2; ?></h1>
            <h3 class="text-black">Foods</h1>
         </div>
      </div>

      <div class="food-menu-box">
         <div class="food-menu-desc">

            <?php

               $sql3 = "SELECT * FROM tbl_order";
               $res3 = mysqli_query($conn,$sql3);

               //count rows
               $count3 = mysqli_num_rows($res3);

            ?>

            <h1 class="text-black"><?php echo $count3; ?></h1>
            <h3 class="text-black">Orders</h1>
         </div>
      </div>

      <div class="food-menu-box">
         <div class="food-menu-desc">
            
            <?php

            //create sql query to get revenue
            //aggregate function in sql
            $sql4 = "SELECT SUM(order_total) AS Total FROM tbl_order WHERE order_status='Delivered'";

            $res4 = mysqli_query($conn,$sql4);

            //get the value
            $row4 = mysqli_fetch_assoc($res4);

            //get the total revenue
            $total_revenue = $row4['Total'];

            ?>

            <h1 class="text-black">Rs. <?php echo $total_revenue; ?></h1>
            <h3 class="text-black">Revenue Generated</h1>
         </div>
      </div>


      
      
   </div>
</div>

</div>

<?php include('partials/footer.php'); ?>

