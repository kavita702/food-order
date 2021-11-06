<?php include 'partials/menu.php';?>

<?php
  //check whether id is set or not
  if(isset($_GET['id']))
  {
      //Get all the details
      $id=$_GET['id'];

      //sql query to get selected food
      $sql2="SELECT * FROM tbl_food WHERE id=$id";

      //Exicute the query
      $res2=mysqli_query($conn,$sql2);
      //Get the value based on query exicuted
      $row2=mysqli_fetch_assoc($res2);
      //Get individual values of selected food

      $title=$row2['title'];
      $discription=$row2['discription'];
      $price=$row2['price'];
      $current_image=$row2['image_name'];
      $current_catogary=$row2['catogary_id'];
      $featured=$row2['featured'];
      $active=$row2['active'];
  }
  else
  {
      //Redirect to manage Food
      header('location:'.SITEURL.'admin/manage-food.php');
  }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="col-30">
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" value="<?php echo $title; ?>" ></td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
                <textarea name="discription"  cols="30" rows="5"?><?php echo $discription; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
        </tr>
        <tr>
            <td>current_image</td>
            <td>
                <?php
                    if($current_image=="")
                    {
                        //Image Not availabel
                        echo "<div class='error'>Image Not available</div>";
                    }
                    else
                    {
                        //Image available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/Food/<?php echo $current_image;?>" width="100px" >
                        <?php
                    }

                ?>

            </td>
        </tr>
        <tr>
            <td>Select New Image</td>
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

                    if($count>0)
                    {
                    // we have category

                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get the Details of category
                            $catogary_title=$row['title'];
                            $catogary_id= $row['id'];
                            
                            
                            ?>
                                <option <?php if($current_catogary==$catogary_id){echo "selected";}?> value="<?php echo $catogary_id; ?>"><?php echo $catogary_title; ?></option>
                            <?php
                            
                        }

                    }
                    else
                    {

                        //we do not have category
                        echo "<option value='0'>Category Not found</option>";
                    }

                ?>
            </Select> 


            </td>
        </tr>
        <tr>
            <td>Featured</td>
            <td><input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
            <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>
            <td>Active</td>
            <td>
                <input  <?php if($active=="Yes"){echo "checked";}?>  type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
            </td>
        </tr>
        <tr>
            <td>
            <input type="hidden" name="id" value="<?php  echo $id;?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="submit" name="submit" value="update-food" class="btn-secondry">
            </td>
        </tr>

     </table>
  </form>

    <?php
      if(isset($_POST['submit']))
      {
         
          //echo "clicked";
          //1. Get all the details from form
          $id=$_POST['id'];
          $title=$_POST['title'];
          $discription=$_POST['discription'];
          $price=$_POST['price'];
          $current_image=$_POST['current_image'];
          $catogary=$_POST['catogary'];
          $featured=$_POST['featured'];
          $active=$_POST['active'];

         //2.upload image if selected
          //Check whether upload button clicked or not
          if(isset($_FILES['image']['name']))
              {
                //upload button clicked
                $image_name=$_FILES['image']['name']; //New image name
                //Check whether the file is available or not
                if($image_name !="")
                 {
                       //Image is available 

                       //A.Uploadin new image
                       //Rename the image
                        $ext=end(explode('.', $image_name)); //extantion of image
                        $image_name="Food-Name-".rand(0000,9999).'.'.$ext; //This will be raname the image
                        //Get the source and destinationpat
                        $src_path=$_FILES['image']['tmp_name'];//source path
                        $dest_path="../images/Food/".$image_name;//Destination path

                        //Upload image
                        $upload=move_uploaded_file($src_path, $dest_path);
                        //Check whether   the image is uploaded or not
                       if($upload==false)
                            {
                                //Failed to upload
                                $_SESSION['upload']="<div class='error'>Failed to upload</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }

                //3.Remove image if new image selected and current image exist
                //B.Remove current image if availabel
                if($current_image!="")
                {
                    //Image is available
                    //Remove the image
                    $path="../images/Food/".$current_image;
                    $remove=unlink($path);
                    //check whether image is removed or not
                    if($remove==false)
                    {
                        //failed to remove current image
                        $_SESSION['remove-fail']="<div class='error>Failed To Remove current image</div>'";
                        //Redirect
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }
                 }
                
              }
              else
              {
                $image_name=$current_image;  //Default Image When image is Not selected

              }

          }
          else
          {
              $image_name=$current_image; //Default Image When Button is Not clicked
          }
         

          //4update food in database
          $sql3="UPDATE tbl_food SET
          title='$title',
          discription='$discription',
          price=$price,
          image_name='$image_name',
          catogary_id='$catogary',
          featured='$featured',
          active='$active'
          WHERE id=$id
          ";
          //Exicute the query
          $res3=mysqli_query($conn,$sql3);
          //Check whether query exicuted or not
          if($res3==true)
          {
              //Query Exicuted and food uploaded
              $_SESSION['update']="<div class='success'> Food updated successfully</div>";
              header('location:'.SITEURL."admin/manage-food.php");

          }
          else
          {
              //Failed to upload
              $_SESSION['update']="<div class='error'> Failed to Update</div>";
              header('location:'.SITEURL."admin/manage-food.php");
          }
      }
  ?>
 </div>
</div>




<?php include 'partials/footer.php';?>