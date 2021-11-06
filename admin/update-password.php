<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 

        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
 

        ?>

        <form action="" method="POST">

           <table class="tbl-30">
               <tr>
                   <td>Current Password:</td>
                   <td><input type="password" name="current_password" placeholder="Current password"></td>

               </tr>
               <tr>
                   <td>
                       New Pasword: </td>
                   <td>
                       <input type="password" name="new_password" placeholder="New Password">
                   </td>
               </tr>
               <tr>
                   <td>
                       Confirm Pasword: </td>
                   <td>
                       <input type="password" name="confirm_password" placeholder="Confirm Password">
                   </td>
               </tr>
               <tr>
                   <td colspan="2">
                       <input type="hidden" name="id" value="<?php echo $id;?>">
                       <input type="submit" name="submit" value="chane password" class="btn-secondry">

                   </td>
               </tr>
               
           </table>

        </form>
    </div>
</div>

<?php

  // check wehther the submit botton is cliced or not
  if(isset($_POST['submit'])){
      //echo "clicked";
      //1.get the data from form
      $id=$_POST['id'];
      $current_password=md5($_POST['current_password']);
      $new_password=md5($_POST['new_password']);
      $confirm_password=md5($_POST['confirm_password']);

      //2. check whether the user with current id and password exist or not
      $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //Exicute the query
        $res=mysqli_query($conn ,$sql);
         if($res==TRUE){
             // check wether the data is availabe
             $count=mysqli_num_rows($res);
             if($count==1){
                 //User exists and password can be changed
                // echo "user found";
                //check whether the new passwor and confirm password matched or not
                if($new_password==$confirm_password){
                    //update the password
                   // echo "password match";
                   $sql2="UPDATE tbl_admin SET
                   password='$new_password'
                   WHERE id=$id
                   ";
 
                   $res2=mysqli_query($conn,$sql2);
                   //check whether the query exicuted or not 
                   if($res2==TRUE){
                       //display message
                       //redirect with success message
                       $_SESSION['change-pwd']="<div class='success'>Password changed successfuly</div>";
                    header('location:'.SITEURL."admin/manage-admin.php");
                   }else{
                       //display error message
                       //redirect to manage admin page with error message
                    $_SESSION['change-pwd']="<div class='error'>Failed to changed Password</div>";
                    header('location:'.SITEURL."admin/manage-admin.php");
                
                   }
                }
                else{
                    //redirect to manage admin page with error message
                    $_SESSION['password_not_match']="<div class='error'>password did not matched</div>";
                    header('location:'.SITEURL."admin/manage-admin.php");
                }
    
             }else{
                 //user does not Exist set message an redirect
                 $_SESSION['user_not_found']="<div class='error'>User not found</div>";
                 header('location:'.SITEURL."admin/manage-admin.php");
             }
         }

      //3.Check whether the new pasword and confirm password matched or not

      //4.Change the password if all above true
  }else{
      //
  }
?>


<?php include('partials/footer.php');?>
