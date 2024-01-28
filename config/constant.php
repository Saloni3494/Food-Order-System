<?php 

    session_start();


    //create constant to store non repeating values
    define('SITEURL','http://localhost/food_order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','mysql');
    define('DB_NAME','food_order_system');


    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  // database connection
    $db_select =mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //selecting db
?>

<?php 
   /* session_start();

    //create constant to store non repeating values
    define('SITEURL','https://saloni.saindia.in/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','saindiai_saloni');
    define('DB_PASSWORD','mMLxSK8U8e$*');
    define('DB_NAME','saindiai_food_order');

    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  // database connection
    $db_select =mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //selecting db
    
    */
?>