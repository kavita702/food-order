
<?php include 'partials/menu.php'; ?>


     <!--main content section starts-->
     <div class="main-content">
     <div class="wrapper">
       <h1>Manage Admin</h1>
       <br>
       

       <?php 
        if(isset($_SESSION['add'])){
          echo $_SESSION['add'];   //displaying session message
          UNSET($_SESSION['add']); //this is removig session message
        }

        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);

        } 

        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }

        if(isset($_SESSION['user_not_found']))
        {
          echo $_SESSION['user_not_found'];
          unset($_SESSION['user_not_found']);
        }
        if(isset($_SESSION['password_not_match'])){
          echo $_SESSION['password_not_match'];
          unset($_SESSION['password_not_match']);
        }
        if(isset($_SESSION['change-pwd'])){
          echo $_SESSION['change-pwd'];
          unset($_SESSION['change-pwd']);
        }





        
      
       ?>
        <br><br>
       <!--Button to add admin-->
       <a href="add-admin.php" class="btn-primary">Add Admin</a>
       <br> <br> <br>

       <table class="tbl-full">
         <tr>
           <th>S.N</th>
           <th>Full Name</th>
           <th>Username</th>
           <th>Actions</th>
         </tr>

         <?php 
           //query to get all admin
           $sql="SELECT * FROM tbl_admin";
           //Exicute the query
           $res=mysqli_query($conn,$sql);

          //check wether the query is exicuted or not
        if($res==TRUE){
              //count rows to check wether we have data in database or not
              $count=mysqli_num_rows($res); // fumction to get all the rows in data base


              $sn=1; //create the variable and assign the value

              //check the number of rows
              if($count>0){
                //we have data in database
                while($rows=mysqli_fetch_assoc($res)){
                  //using while loop to get all data from database.
                  //And while loop run as long as we have data in database.

                  //get individula data
                  $id=$rows['id'];
                  $full_name=$rows['full_name'];
                  $username=$rows['username'];

                  //display the values in the table
                  ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                         <td><?php echo $full_name?></td>
                         <td><?php echo $username?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondry">Update Admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"class="btn-danger">Delete Admin</a>
                        </td>
                     </tr>
                 
                  <?php

                }
              }else{
                //we dont have data in database

              }
        } 
         
         
         ?>

       </table>




      </div>
     </div>
     <!--main content section ends-->

    <?php include 'partials/footer.php'; ?>