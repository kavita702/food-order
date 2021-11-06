<?php include('partials/menu.php'); ?>
  
   <div class="main-content">
       <div class="wrapper">
           <h1>Add Food</h1>
           <br><br>

           <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

           ?>

           <form action="" method="POST" enctype="multipart/form-data">

           <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of the Food"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="discription" cols="30" rows="5" placeholder="Description of food"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="catogary" >

                        <?php 
                           //Create PHP code to display category from database

                           //1. Create sql to get all active categoried from databse 
                           $sql="SELECT * FROM tbl_catogary WHERE active='Yes'";
                            //Exicute the query
                           $res=mysqli_query($conn,$sql);

                           //Count rows to check whwther we have categories or not
                           $count=mysqli_num_rows($res);
                           //If count has greater then zero we have categories else not have category

                           if($count>0){
                            // we have category

                            while($row=mysqli_fetch_assoc($res)){
                                //Get the Details of category
                               $id= $row['id'];
                               $title=$row['title'];
                                
                               ?>
                                 <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                               <?php
                               
                            }

                           }else{

                               //we do not have category

                               ?>
                                 <option value="0">No Category found</option>
                               <?php
                           }



                           //2.Dispaly drop down

                         ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                    <input type="radio" name="featured" value="Yes" >Yes
                     <input type="radio" name="featured" value="No" >No
                   </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" >Yes
                        <input type="radio" name="active" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td colspane="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondry">
                    </td>
                </tr>


           </table>




           </form>

           <?php

            //Check whether thy button clicked or not
            if(isset($_POST['submit'])){
                //Add the food in database
                // echo "clicked";

                //1. Get the data from form 
                $title=$_POST['title'];
                $discription=$_POST['discription'];
                $price=$_POST['price'];
                $catogary=$_POST['catogary'];


                //Ceck the radio button for feactured and active is checked or not
                if(isset($_POST['featured'])){
                    $featured=$_POST['featured'];

                }else{
                    //Setting default
                    $featured="No";
                }
                if(isset($_POST['active'])){
                    $active=$_POST['active'];

                }else{
                    //Setting default
                    $active="No";
                }


                //2.Upload the image if selected
                //check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])){
                    //Get the details of seleted image
                        $image_name= $_FILES['image']['name'];

                        //check whether image is selected or not and upload image i the selected
                        if($image_name!=""){
                            //1. image is selected

                            //2.Rename the image
                            //get the extension of seletced image like(jpg,png etc) kanchan-kahtri.jpg

                            $ext=end(explode('.',$image_name));
                            //create new name for image
                            $image_name="Food-Name-".Rand(0000,9999).$ext; //new image name may be like food-name-5734.jpg

                            //3.Upload the image
                            //Get the source path and destination path

                            //source_path is the current location of image
                            $src=$_FILES['image']['tmp_name'];

                            //destination path for the image to be uploaded
                             $destination_path="../images/Food/".$image_name;
                            
                            //Finally upload the food image
                            $upload=move_uploaded_file($src,$destination_path);
                            //check wehther image uploaded or not
                            if($upload==false){
                                //Failed to upload the image
                                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                //redirect to add food page with error message
                               header('location:'.'admin/add-food.php');
                                //stop the proccess
                                die();
                            }
                        }



                }else{
                    $image_name=""; //setting default value as blank

                }


                //3.Insert into database
                //create sql query to save or add food
                //For Numarical we do not pass value inside qoutes '' but for string it is compulsory

                $sql2=" INSERT INTO tbl_food SET
                title='$title',
                discription='$discription',
                price=$price,  
                image_name='$image_name',
                catogary_id='$catogary',
                featured='$featured',
                active='$active'
                
                ";
                //Exicute the query
                $res2=mysqli_query($conn,$sql2);
               
                //4.Redirect with message to manage food page
                 //Check whether data inserted or not
                if($res==TRUE){
                    //Data inserted successfuly
                    $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                    //Redirect the add food manage page
                    header('location:'.SITEURL.'admin/manage-food.php');

                }else{
                    //Failed to insert data
                    $_SESSION['add']="<div class='error'>Fail to Food Add Food</div>";
                    //Redirect the add food manage page
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

             
            }else{

            }

            ?>
        
       </div>
   </div>



<?php include('partials/footer.php'); ?>