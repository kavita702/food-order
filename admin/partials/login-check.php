<?php

  //Authorization- access control
  //check whether the user is logged in or not

  if(!isset($_SESSION['user'])){ //if user session is not set 
     // user is not logged in

     //Redirect login page with message
     $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel</div>";
     //Redirect login page
     header('location:'.SITEURL.'admin/login.php');
  }

?>