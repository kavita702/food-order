<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php

             if(isset($_SESSION['login'])){
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);
             }

             if(isset($_SESSION['no-login-message'])){
                 echo $_SESSION['no-login-message'];
                 unset($_SESSION['no-login-message']);
             }

            ?>
            <br><br>
            <!--Login form starts here-->
           
            <form action="" method="POST" class="text-center">
                 
                 Username <br>
                  <input type="text" name="username" placeholder="Enter username"><br><br>
                 Password<br>
                  <input type="password" name='password' placeholder="Enter password"><br><br>

                 <input type="submit" name="submit" Value="Login" class="btn-primary">
                 <br><br>

            </form>

             <!--Login form ends here-->


            <p class="text-center">Created By <a href="#">Kanchan Khatri</a></p>
        </div>
    </body>
</html>


<?php
    
      //check whether the sunmit button clicked or not

     if(isset($_POST['submit'])){
         //clicked
         //1. get data from login form
         // $username=$_POST['username'];
         //$password=md5($_POST['password']);

          $username=mysqli_real_escape_string($conn, $_POST['username']);
          $row_password=md5($_POST['password']);
          $password=mysqli_real_escape_string($conn , $row_password);


          //2.sql the check whether user with username and password exist or not
          $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

          //3.Exicute the query

          $res=mysqli_query($conn,$sql);

          //4.count the rows to check whether the user exist or not
          $count=mysqli_num_rows($res);

          if($count==1){

            //user available login success
            $_SESSION['login']="<div class='success'>Login successfull</div>";
            $_SESSION['user']=$username;// to check whether the user is loged in or not and logout will unset it
            //redirect to homepage/dashboard
            header('location:'.SITEURL.'admin/');

          }else{
              
            //user not available and login fail
            $_SESSION['login']="<div class='error text-center'>username password did not match</div>";
             //redirect to homepage/dashboard
            header('location:'.SITEURL.'admin/login.php');
          }


     }

     
  
?>