
 <?php


//start session
 session_start();

     define("SITEURL",'http://localhost/food-order/');
    
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');


// create constant to add non repeating value
  $conn= mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Database connection
  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting database
  ?>