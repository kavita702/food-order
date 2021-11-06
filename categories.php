<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

             //Display all the categories that are active
             //Create sql query
             $sql="SELECT * FROM tbl_catogary WHERE active='Yes' ";

             //Exicute the SQL Query
             $res=mysqli_query($conn,$sql);
             
             //Count the rows
             $count=mysqli_num_rows($res);
             
             //Check whether catogery available or no
             if($count>0)
             {
                 //category avalailabe
                 while($row=mysqli_fetch_assoc($res))
                 {
                     //Get the values
                     $id=$row['id'];
                     $title=$row['title'];
                     $image_name=$row['image_name'];
                     ?>

                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                          if($image_name=="")
                          {
                              //Image is not availbale
                              echo "<div class='error'>Image Not Found</div>";
                          }
                          else
                          {
                              //Image availbale
                              ?>
                              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                             <?php
                          }
                        
                        ?>
                        

                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                    </div>
              </a>

                     <?php

                 }
             }
             else
             {
                 // Category Not Available 
                 echo "<div class='error'>Categorgy not available</div>";
             }

            ?>

           
           

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
