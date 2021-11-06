<?php include 'partials/menu.php';?>
   
 <div class="main-content">
     <div class="wrapper">
         <h1>Update Category</h1>
         <br><br>

         <?php

            //check  whether the id is set or not
            if(isset ($_GET['id'])){

                //get the id and all other details
              //  echo "Getting the data";
                $id=$_GET['id'];
                //Create Sql query to get all other details
                $sql="SELECT * FROM tbl_catogary Where id=$id";
                //Exicute the query
                $res=mysqli_query($conn,$sql);
                 //count the rows
                 $count=mysqli_num_rows($res);
                 if($count==1){
                    //Get the data
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    
                 }else{
                     //Redirect to manage category with error message
                      $_SESSION['no-category-found']="<div class='error'> Category Not Found </div>";
                      header('location:'.SITEURL.'admin/manage-catogary.php');
                 }
            }else{
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-catogary');
            }



        ?>

         <form action="" method="POST" enctype="multipart/form-data">

         <table class="tbl-30">
             <tr>
                 <td>Title:</td>
                 <td>
                     <input type="text" name="title" value="<?php echo $title;?>">
                 </td>

             </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php  
                        
                         if($current_image !=""){
                             //display the image

                             ?>

                             <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="150px">

                             <?php 

                         }else{
                             // Display message
                             echo "<div class='error'>Image not added </div>";
                         }
                     
                    
                    ?>

                </td>
            </tr>
            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input  <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>

            </tr>
            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id"  value="<?php echo $id; ?>">
                    <input type="submit"  name="submit" value="update category" class="btn-secondry">
                </td>
            </tr>

         </table>
         </form> 

         <?php 
             
             if(isset($_POST['submit'])){
                 //echo "clicked";
                 //1.Get all values from our form
                 $id=$_POST['id'];
                 $title=$_POST['title'];
                 $current_image=$_POST['current_image'];
                 $featured=$_POST['featured'];
                 $active=$_POST['active'];

                 //2.Updating new image if selected
                 //check whether the image is selected or not

                  if(isset($_FILES['image']['name'])){
                        //Get the image details 
                        $image_name=$_FILES['image']['name'];
                        //check whether our image is availbale or not

                        if($image_name !=""){
                            //Image available
                            //A. upload the new image
                        
                            //Auto Rename our Image
                            //Get extension of image like (jpg, png, gif , etc) e.g "food.jpg"
                            $ext=end(explode('.', $image_name));

                            //Rename image
                            $image_name="Food_Catogery_".rand(000,999).'.'.$ext;// e.g Food_Categary_835.jpg



                            $source_path=$_FILES['image']['tmp_name']; //get sourse path

                            $destination_path="../images/category/".$image_name;

                            //upload image
                            $upload=move_uploaded_file($source_path,$destination_path);
                            //check whether image is uploaded or not
                            if($upload==FALSE){
                                $_SESSION['upload']="<div class='error'>Fail to Upload Image</div>";
                                //redirect to add catogary page
                                header('location:'.SITEURL.'admin/manage-catogary.php');
                                //Stop the proccess
                                die();
                            }

                            //B. Remove current image if available
                            if($current_image!="")
                            {
                            $remove_path="../images/category/".$current_image;
                            $remove=unlink($remove_path);

                            //check whetherbthe image remove or not

                            //if failed to remove then  display the message and stop the process.
                            if($remove==false){
                                //failed to remove
                               
                              $_SESSION['failed-remove']="<div class='error'>failed to remove current image.</div>";
                              header('location:'.SITEURL.'admin/manage-catogary.php');
                              die();//stop process
                           
                            }
                        }


                        }else{
                            $image_name=$current_image;
                        }


                  }else{
                      $image_name=$current_image;
                  }


                 //3. Update the database
                 $sql2="UPDATE tbl_catogary SET
                 title='$title',
                 image_name='$image_name',
                 featured='$featured',
                 active='$active'
                 WHERE id=$id
                 ";

                 //Exicute the query
                 $res2=mysqli_query($conn,$sql2);

                 //4.Redirect the manage category page with message
                 //Check whwther query exicuted or not
                 if($res2==TRUE){
                     //category updated
                     $_SESSION['update']="<div class='success'>category Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-catogary.php');
                 }else{
                     //Failed to update Category
                     $_SESSION['update']="<div class='error'>failed to Updated Category</div>";
                     header('location:'.SITEURL.'admin/manage-catogary.php');
                 }

                  

             }
         ?>
     </div>
 </div>



<?php include 'partials/footer.php';?>