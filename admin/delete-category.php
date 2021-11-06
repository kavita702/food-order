<?php include '../config/constants.php';?>

<?php
   //check whether the id and image_name set or not

   if(isset($_GET['id']) AND isset($_GET['image_name'])){
       //Get the value and delete 
      // echo "Get value and delete";
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];
      //remove physical image file is available

      if($image_name!=""){
          //image is available remove it
          $path="../images/category/".$image_name;
          //Remove the image
          $remove=unlink($path);

         
          //if failed to remove image then add an error message and stop the proccess

            if($remove==false)
             {
               //Set the session message
               $_SESSION['remove']="<div class='error'>Failed To Remove Image.</div>";
               //Rediret to manage category page
               header('location:'.SITEURL.'admin/manage-catogary.php');
               //Stop the process
               die();
             }
      }

      //Delete data from database
      //SQL Querty to Delete data from database
      $sql="DELETE FROM tbl_catogary WHERE id=$id";

      //Exicute the Query
      $res=mysqli_query($conn,$sql);

      //Check whether the data is deleted from database or not

      if($res==TRUE){
          //Set success message and Redirect
          $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";

          //Redirect
          header('location:'.SITEURL.'admin/manage-catogary.php');

         
          

      }else{
          //set Failed message and redirect
          $_SESSION['delete']="<div class='error'>Failed to Delete Category</div>";

          //Redirect
          header('location:'.SITEURL.'admin/manage-catogary.php');

      }


    
   }else{
    // redirect to manage category page
    header('location:'.SITEURL.'admin/manage-catogary.php');
       
   }


?>

