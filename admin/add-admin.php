<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php 
           
           if(isset($_SESSION['add'])){ //check session
               echo $_SESSION['add']; //display session message
               unset($_SESSION['add']);//remove session message
           }
        
        
        ?>
        <br>
        <br>
        <form action="" method="POST">
           <table class="tbl-30"> 
               <tr>
                   <td>Full Name</td>
                   <td><input type="text" name="full_name" placeholder="Enter your name"></td>

               </tr>

               <tr>
                   <td>Username</td>
                   <td><input type="text" name="username" placeholder="Your username"></td>
               </tr>
               <tr>
                   <td>Password</td>
                   <td><input type="password" name="password" placeholder="Your password"></td>
               </tr>
               <tr>
                   <td colspan="2">
                       <input type="submit" name="submit" value="add-admin" class="btn-secondry">
                   </td>
               </tr>
           </table>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>


<?php
 //Procces the value from form and save in database 
 //check wether the button clicked or not

 if(isset($_POST['submit'])){
    //button clicked

    //1 get the data from form
     $full_name = $_POST['full_name'];
     $username= $_POST['username'];
     $password= md5($_POST['password']);  //password encryption with md5

     //2 SQL query to save the data into database

     $sql= "INSERT INTO tbl_admin SET 
       full_name= '$full_name',
       username= '$username',
       password='$password'
     ";

 

   //3 exicuting and saving data in database
  $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

  //4 check wether the (query is exicuted ) data is inserted or not and display appropraite message

 if($res==TRUE){

       // data inserted
       //echo "Inserted";
       //create a session variable to display the message
        $_SESSION['add']='<div class="success">Admin added successfully</div>';
        //redirect page to manage admin
        header("Location:" .SITEURL .'admin/manage-admin.php');
       
    }else{
        //failed insereted data
       // echo"Data not insereted";
       $_SESSION['add']='Failed to add admin';
       //redirect page to add admin
       header("Location:" .SITEURL .'<div class="error">admin/add-admin.php</div>');
   }
    


 }
?>