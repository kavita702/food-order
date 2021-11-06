<?php
     
   // Include constants.php file her

   include('../config/constants.php');
  
   //1. get the id to be deleted

   $id= $_GET['id'];

   //2.create sql query to delete admin

   $sql="DELETE FROM tbl_admin WHERE id=$id";

   //exicute the query
   $res=mysqli_query($conn,$sql);

   //check whether the query exicuted successfully or not

   if($res==TRUE){
      //query exicuted successfuly and admin deleted
      //echo "Admin deleted";
      //Create session variable to display message

      $_SESSION['delete']="<div class='success'>Admin deleted successfuly</div>";
      //redirect to manage admin page

      header('location:'.SITEURL.'admin/manage-admin.php');



   }
   else{
      //Failed to delete admin
      //echo "Failed to delete admin";
      $_SESSION['delete']='Failed to delete admin try again later ';
      header('location:'.SITEURL."<div class='error'>admin/manage-admin.php</div>");


   }
   //3.Redirect to manage admin page with message (success/error)
?>