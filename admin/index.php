
<?php include 'partials/menu.php' ; ?>

     <!--main content section starts-->
     <div class="main-content">
     <div class="wrapper">
       <h1>DASHBOARD</h1>

       <br><br>

       <?php

             if(isset($_SESSION['login'])){
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);
             }

            ?>
            <br><br>

       <div class="col-4 text-center">
         <?php
            
            //SQL query
            $sql="SELECT * FROM tbl_catogary";
            //Exicute the Query
            $res=mysqli_query($conn,$sql);
            //count the rows
            $count=mysqli_num_rows($res);


         ?>
         <h1><?php echo $count; ?></h1>
         <br>
         Catogaries
       </div>

       <div class="col-4 text-center">
       <?php
            
            //SQL query
            $sql2="SELECT * FROM tbl_food";
            //Exicute the Query
            $res2=mysqli_query($conn,$sql2);
            //count the rows
            $count2=mysqli_num_rows($res2);


         ?>
         <h1><?php echo $count2; ?></h1>
         <br>
         Foods
       </div>

       <div class="col-4 text-center">
       <?php
            
            //SQL query
            $sql3="SELECT * FROM tbl_order";
            //Exicute the Query
            $res3=mysqli_query($conn,$sql3);
            //count the rows
            $count3=mysqli_num_rows($res3);


         ?>
         <h1><?php echo $count3; ?></h1>
         <br>
         Total Orders
       </div>

       <div class="col-4 text-center">
         <?php
           //Create sql query To Get total revenue generated
           //Aggregate function sql

           $sql4="SELECT sum(total) AS total FROM tbl_order WHERE status='Delieverd'";

           //Exicute query
           $res4=mysqli_query($conn,$sql4);

           //Get values
           $row4=mysqli_fetch_assoc($res4);

           //Get the total revemue
           $total_revenue=$row4['total'];


         ?>
         <h1><?php echo $total_revenue; ?></h1>
         <br>
        Revenue Generated
       </div>

       <div class="clearfix"></div>
        </div>
       
     </div>
     <!--main content section ends-->

    <?php include 'partials/footer.php'; ?>
