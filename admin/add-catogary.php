<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        
        <?php 
        
           if(isset($_SESSION['add'])){
               echo $_SESSION['add'];
               unset($_SESSION['add']);
           }

           
           if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>

        <br><br>

        

        <!--Add catogary form stats here-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                       <td>Title:</td>
                       <td><input type="text" name="title" placeholder="Catogary Title"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
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
                       <td>Active </td>
                       <td>
                           <input type="radio" name="active" value="Yes">Yes
                           <input type="radio" name="active" value="No">No

                       </td>

                </tr>
                <tr>
                    <td colspan="2">
                       <input type="submit" name="submit" value="Add Catogary" class="btn-secondry">
                    </td>
                </tr>

            </table>

        </form>
        <!--Add catogary form ends here-->

        <?php 
            //check whether the submit button pressed or not
            if(isset($_POST['submit'])){
                // echo "clicked";

                //1.Get the value from catogary form
                $title=$_POST['title'];
                
                //For radio input type we need to check whether the button is selected or not
                if(isset($_POST['featured'])){
                    //Get the value fro form
                    $featured=$_POST['featured'];
                }else{
                    //set default value
                    $featured="No";
                }

                if(isset($_POST['active'])){
                    $active=$_POST['active'];

                }else{
                    $active="No";
                }

                //Check whether the image is selected or not and set value for image-name
               // print_r($_FILES['image']);
                //die(); //Break the code here
               if(isset($_FILES['image']['name'])){

                    //upload image
                    //To upload image we need image name and source path and destination path

                    $image_name=$_FILES['image']['name'];

                   
                   
                    //upload the image only if image is selected
                
                    if($image_name !=""){

                
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
                                header('location:'.SITEURL.'admin/add-catogary.php');
                                //Stop the proccess
                                die();
                            }

                }

                    //and if image not uploaded then we will stop the proccess and redirect with error message

                }else{
                    //Dont upload image and set image name value blank
                    $image_name="";
                }

                

                //2. Create SQL Query to Insert catogary into database
                $sql="INSERT INTO tbl_catogary SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //3. Exicute the query and save into database

                $res=mysqli_query($conn,$sql);
                //check whether the query exicuted or not and data added or not

                if($res==TRUE){
                    //Query Exicued and catogary added
                    $_SESSION['add']="<div class='success'>Catogary added successfully</div>";
                    //Redirect To Manage Catogary Page
                    header('location:'.SITEURL.'admin/manage-catogary.php');
                }else{
                    //fail to add catogary
                    $_SESSION['add']="<div class='error'>fail to add catogary</div>";
                    //Redirect To Manage Catogary Page
                    header('location:'.SITEURL.'admin/add-catogary.php');
                }




            }
        ?>
    </div>
</div>



<?php include('partials/footer.php');?>