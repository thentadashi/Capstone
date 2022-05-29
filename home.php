<section id="slider"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner">
              <div class="item active">
                <div class="col-sm-6">
                  <h1 class="text-success" style="color:#28a745;"><b>GEFORCE RTX</b><br>
                  <h2>THE ULTIMATE PLAY</h2>
                                <p>
                                    The GeForce RTX™ Ti and RTX graphics cards deliver the ultra performance that gamers crave, powered by Ampere—<strong>NVIDIA’s 2nd gen RTX architecture</strong>. They are built with enhanced RT Cores and Tensor Cores,
                                    new streaming multiprocessors, and superfast G6X memory for an amazing gaming experience.
                                </p>
                                <a href="#" class="btn btn-success" style="margin-bottom: 5px;">GeForce RTX™ 3090's</a>
                                <a href="#" class="btn btn-success"style="margin-bottom: 5px;">GeForce RTX™ 3080's</a>
                                <a href="#" class="btn btn-success"style="margin-bottom: 5px;">GeForce RTX™ 3070's</a>
                                <a href="#" class="btn btn-success"style="margin-bottom: 5px;">GeForce RTX™ 3060's</a>
                </div>
                <div class="col-sm-6">
                  <img src="images/home/gpu-banner-1.png" class="girl img-responsive" alt="" />
                </div>
              </div>
              <div class="item">
                <div class="col-sm-6">
                    <h1 class="text-primary" style="color:#007bff;"><b>Intel® Core™</b></h1>
                    <h2>11th Gen Intel® Core™</h2>
                                <p>
                                    <strong>11th Gen Intel® Core™</strong> processors power the ultimate thin & light laptops with industry-leading CPU performance, discrete-level graphics, amazing AI acceleration, and great battery life. Intel® Optane™
                                    memory accelerates launching the applications you use most.
                                </p>
                                <a href="#" class="btn btn-primary" style="margin-bottom: 5px;">Core™ i9 Processors</a>
                                <a href="#" class="btn btn-primary" style="margin-bottom: 5px;">Core™ i7 Processors</a>
                                <a href="#" class="btn btn-primary" style="margin-bottom: 5px;">Core™ i5 Processors</a>
                                <a href="#" class="btn btn-primary" style="margin-bottom: 5px;">Core™ i3 Processors</a>
                </div>
                <div class="col-sm-6">
                  <img src="images/home/intel.png" class="girl img-responsive" alt="" />
                </div>
              </div>
              
              <div class="item">
                <div class="col-sm-6">
                    <h1 style="color:#111;"><strong>AMD Ryzen™ Processors </strong></h1>
                                <p>
                                    <li>From 4 to 16 cores</li>
                                    <li>Up to 32 processing threads</li>
                                    <li>Select models include Radeon™ graphics</li>
                                </p>
                                <a href="#" class="btn btn-danger" style="margin-bottom: 5px;">AMD Ryzen™ Processors</a>
                                <a href="#" class="btn btn-danger">AMD Ryzen™ Processors with Radeon Vega Graphics</a>
                </div>
                <div class="col-sm-6">
                  <img src="images/home/amd-banner-1.png" class="girl img-responsive" alt="" />
                </div>
              </div>
              
            </div>
            
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section><!--/slider-->

  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
            <?php include 'sidebar.php'; ?>
        </div>
        
        <div class="col-sm-9 padding-right">
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Featured Items</h2>

            <?php

            $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
            WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 ";
            $mydb->setQuery($query);
            $cur = $mydb->loadResultList();
           
            foreach ($cur as $result) { 

              ?>
               <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
            <div class="col-sm-4">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" />
                      <h2>&#8369 <?php  echo number_format($result->PRODISPRICE); ?></h2>
                      <p><?php  echo    $result->OWNERNAME; ?></p>
                      <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>

                    </div>
                    <div class="product-overlay">




                      <div class="overlay-content">

                        <div class="productinfo text-center">
                          <?php  if (isset($_SESSION['CUSID'])){  ?>
                           <?php echo ' <a href="'.web_root.'index.php?q=details&proid='.$result->PROID.'">;'?><img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" /></a>
                         <?php }else{ ?>

                           <?php echo ' <a href="">;'?><img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" /></a>


                        <?php }?>

                        </div>
                        <h2>&#8369 <?php  echo number_format($result->PRODISPRICE); ?></h2>
                        <p style="color:#333;"><?php  echo    $result->OWNERNAME; ?></p>

                       <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                      </div>
                    </div>
                </div>

                                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li>
                              <?php     
                            if (isset($_SESSION['CUSID'])){  

                              echo ' <a href="'.web_root. 'customer/controller.php?action=addwish&proid='.$result->PROID.'" title="Add to wishlist"><i class="fa fa-plus-square"></i>Add to wishlist</a></a>
                            ';

                             }else{
                               echo   '<a href="#" title="Add to wishlist" class="proid"  data-target="#smyModal" data-toggle="modal" data-id="'.  $result->PROID.'"><i class="fa fa-plus-square"></i>Add to wishlist</a></a>
                            ';
                            }  
                            ?>

                    </li> 
                  </ul>
                </div>
              </div>
            </div>
          </form>
       <?php  } ?>
            
          </div><!--features_items--> 
          
          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>
            
            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="item active"> 
                         <?php 
                    $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                    WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 limit 3 ";
                    $mydb->setQuery($query);
                    $cur = $mydb->loadResultList();
                   
                    foreach ($cur as $result) { 
                  ?>
                      <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
                  <div class="col-sm-4" >
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" />
                      <h2>&#8369 <?php  echo number_format($result->PRODISPRICE); ?></h2>
                          <p><?php  echo    $result->OWNERNAME; ?></p>
                           <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </form>
                  <?php } ?>
                </div>
                <div class="item">  
                  <?php 
                    $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                    WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 limit 3,3";
                    $mydb->setQuery($query);
                    $cur = $mydb->loadResultList();
                   
                    foreach ($cur as $result) { 
                  ?>
                      <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" />
                          <h2>&#8369 <?php  echo $result->PRODISPRICE; ?></h2>
                          <p><?php  echo    $result->OWNERNAME; ?></p>
                           <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </form>
                  <?php } ?>
                </div>
                <div class="item">  
                  <?php 
                    $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                    WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 limit 6,9";
                    $mydb->setQuery($query);
                    $cur = $mydb->loadResultList();
                   
                    foreach ($cur as $result) { 
                  ?>
                      <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" />
                          <h2>&#8369 <?php  echo $result->PRODISPRICE; ?></h2>
                          <p><?php  echo    $result->OWNERNAME; ?></p>
                           <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </form>
                  <?php } ?>
                </div>
              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>      
            </div>
          </div><!--/recommended_items-->
          
        </div>
      </div>
    </div>
  </section>