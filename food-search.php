<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

              //Get the search keyword
              //$search=$_POST['search'];

              $search=mysqli_real_escape_string($conn,$_POST['search']);

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                
                //SQL suery to get food based on search keyword
                //$search=burger'; DROP database name;
                //"SELECT * FROM tbl_food WHERE title LIKE '&burger'&' AND discription LIKE '&burger'&'";
                $sql="SELECT * FROM tbl_food WHERE title like '%$search%' OR discription LIKE '%$search%' ";

                //Exicute the query
                $res=mysqli_query($conn,$sql);

                //Count the rows
                $count=mysqli_num_rows($res);

                //check whether food is available or not
                if($count>0)
                {
                    //Food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $discription=$row['discription'];
                        $image_name=$row['image_name'];
                        ?>
                     <div class="food-menu-box">
                             <div class="food-menu-img">

                                <?php
                                    //Check whether image is available or not
                                    if($image_name=="")
                                    {
                                        //Image is not avalable
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                               
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">$<?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $discription;?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                          </div>
                     </div>

                        <?php
                    }
                }
                else
                {
                    //Food not availbale
                    echo "<div class='error'>Food not available<div>";
                }
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
