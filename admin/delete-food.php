<?php

//include constants.php
include('../config/constants.php');

if(isset($_GET['id'])&& isset($_GET['image_name'])) //either use '&&' or 'AND'
{
  //Process to delete
  //echo "Process to Delete";

//1.Get id and image name
  $id=$_GET['id'];
  $image_name=$_GET['image_name'];

//2.Remove image if available
//Check whether the image is available or not and delete only if available
if($image_name!=""){
    //It has image and need to remove from folder
    //Get image path
    $path="../images/Food/".$image_name;
    //Remove image file from folder
    $remove=unlink($path);
    //check whether the image is removed or not

    if($remove==false){
        //Failed to remove image
        $_SESSION['upload']="<div class='error'>Failed to remove image file</div>";
        //Redirect to manage food
        header('loctaion:'.SITEURL.'admin/manage-food.php');
        //Stop the process of deleting food
        die();
    }
}


//3.Delete Food From Database 
//Create sql query
$sql="DELETE FROM tbl_food WHERE id=$id";
//Exicute the query
$res=mysqli_query($conn,$sql);
//Check whether the query exicuted or not and set session message respectivly
if($res==TRUE){
    //Food Delete
    $_SESSION['delete']="<div class='success'>Food Deleted successfully<div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}
else{
    //Failed to Delete

    $_SESSION['delete']="<div class='error'>Fail To Delete Food<div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
}

else
{
    //Redirect to manage Food page
    //echo "Redirect";
  $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
  header('location:'.SITEURL.'admin/manage-food.php');

}


?>