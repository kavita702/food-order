<?php include('partials/menu.php');?>
 
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 

        //1.get the id of seleted admin
        $id=$_GET['id'];

        //2. Create Sql query

        $sql="SELECT * FROM tbl_admin WHERE id=$id";


        //3.exicute sql query
        $res=mysqli_query($conn,$sql);

        //check whether the query is exicuted or not

        if($res==TRUE){
            //whether the data is available or not
            $count=mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count==1){
              //Get the details
              //echo "admin available";
              $row=mysqli_fetch_assoc($res);
              $full_name=$row['full_name'];
              $username=$row['username'];
            }
            else{
              
                //Redirect  to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');

            }

        }
       


        ?>


        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full name:</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
                
            </tr>

            <tr>
            <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $username;?>"></td>
            </tr>
           
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondry"></td>
            </tr>

        </table>
            
        </form>

       
    </div>
</div>

<?php
   //check whether the submit button is clicked or not

   if(isset($_POST['submit'])){
      // echo "button clicked";
      //get all the values from form to update
     $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    //create sql query to update admin

    $sql="UPDATE tbl_admin SET 
    full_name= '$full_name',
    username='$username' 
    WHERE id=$id
    ";

    //exicute the query
    $res=mysqli_query($conn,$sql);

    //check whether the query is exicuted or not

    if($res==TRUE){
      //query exicuted and admin updated
      $_SESSION['update']="<div class= 'success'>Admin updated successfuly</div>";
      //Redirect the manage admin page
      header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        //Failed to update admin
        $_SESSION['update']="<div class= 'success'> Failed to update admin</div>";
      //Redirect the manage admin page
      header('location:'.SITEURL.'admin/manage-admin.php');
    }

   }

?>



<?php include('partials/footer.php');?>
