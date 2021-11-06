  <?php include('partials-front/menu.php'); ?>

    <?php

    //Check whwther id is based or not
    if(isset($_GET['catogary_id']))
        {
          //category_id is set and get the id
          $catogary_id=$_GET['catogary_id'];
          
          //Get the category title based on category id
          $sql="SELECT title FROM tbl_catogary WHERE id=$catogary_id";

          //Exicute the query
          $res=mysqli_query($conn,$sql);
         
          //Get the values from database
          $row=mysqli_fetch_assoc($res);
          
          //Get the title
          $catogary_title=$row['title'];

        }
        else
        {
            //Category not pass 
            //Redirect home page
            header('location:'.SITEURL);
        }
    ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $catogary_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Create sql query to get Food based on selected food
                $sql2="SELECT * FROM tbl_food WHERE catogary_id=$catogary_id";

                //Exicute the query
                $res2=mysqli_query($conn , $sql2);

                //Count the rows
                $count=mysqli_num_rows($res2);

                //Check whether food is available or not
                if($count>0)
                {
                    //Food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $price=$row2['price'];
                        $discription=$row2['discription'];
                        $image_name=$row2['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php

                                    //Check whether image is available or not
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else
                                    {
                                        //Image is Available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }

                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">$<?php echo $price;?></p>
                                    <p class="food-detail">
                                        <?php echo $discription; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                        </div>


                        <?php
                    }

                }
                else
                {
                    //Food not available
                    echo "<div class='error'>Food Not Available";
                }


            ?>

            
          


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
