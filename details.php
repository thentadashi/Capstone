 <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
            <?php include 'sidebar.php'; ?>
        </div>
        
        <div class="col-sm-9 padding-right">
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Single Item View</h2>





            <?php

    global $mydb;

    $proid = $_GET['proid'];
    $id =$_SESSION['CUSID'];



            $query = "SELECT * FROM `tblproduct` 
            WHERE `PROID` = $proid ";
            $mydb->setQuery($query);
            $cur = $mydb->loadResultList();
           
            foreach ($cur as $result) { 

              ?>
               <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
            <div class="col-sm-4" style="width: 520px;">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" />

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
            <div >
           <h4 style="color:#008037; margin:0px;">Product Brand</h4><h1 style="margin: 0px;"><?php echo    $result->OWNERNAME; ?></h1>
          <h4 style="margin-top:20px;margin-bottom: 2px;"> <p style="margin-bottom: 0px;color:#008037;">Price</p></h4><h3 style="margin: 0px;">&#8369 <?php  echo number_format($result->PROPRICE); ?></h3>

                       <h4 style="margin-top:25px;margin-bottom: 0px;"><p style="color:#008037;">Description</p></h4> <p style="margin-bottom: 0px;"><?php  echo    $result->PRODESC; ?></p>
                     <h4><p style="color:#008037;">Product Status</p></h4> <h4 style="color:#333;"><?php  echo    $result->PROSTATS; ?> <i class="fa fa-circle-check"></i><h4>
<h4><p style="color:#008037;">Product Rating</p></h4>
  <div class="container-star">
    <div class="rating-wrap-star">





    <div style="background: white; padding: 0px;color:white;">
        <i class="fa fa-star fa-2x" data-index="0"></i>
        <i class="fa fa-star fa-2x" data-index="1"></i>
        <i class="fa fa-star fa-2x" data-index="2"></i>
        <i class="fa fa-star fa-2x" data-index="3"></i>
        <i class="fa fa-star fa-2x" data-index="4"></i>
        <br><br>
        <p style="color:#111;margin-top:-10px;"><b>Star Rating<?php include("rate.php");echo round($avg,2) ?></b></p>  
    </div>
    </div>
                <a style="margin-top:-25px;margin-left: 15px;" href="" id="rate" class="btn btn-default add-to-cart">Rate</a>  

  </div>
      <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script>
        var ratedIndex = -1, uID =0, proid = <?php  echo    $result->PROID; ?>;

        $(document).ready(function () {
            resetStarColors();

            if (localStorage.getItem('ratedIndex') != null) {
                setStars(parseInt(localStorage.getItem('ratedIndex')));
                uID = localStorage.getItem('uID');
            }

            $('.fa-star').on('click', function () {
               ratedIndex = parseInt($(this).data('index'));
               localStorage.setItem('ratedIndex', ratedIndex);
               saveToTheDB();
            });

            $('.fa-star').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);
            });

            $('.fa-star').mouseleave(function () {
                resetStarColors();

                if (ratedIndex != -1)
                    setStars(ratedIndex);
            });
        });

          function saveToTheDB() {
            $.ajax({
               url: "rate.php",
               method: "POST",
               dataType: 'json',
               data: {
                   save: 1,
                   uID: uID,
                   ratedIndex: ratedIndex,
                   proid : proid
               }, success: function (r) {
                    uID = r.id;
                    localStorage.setItem('uID', uID);
               }
            });
        };

        function setStars(max) {
            for (var i=0; i <= max; i++)
                $('.fa-star:eq('+i+')').css('color', 'gold');
        }

        function resetStarColors() {
            $('.fa-star').css('color', '#f1f1f1');
        }
    </script>



                      <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                      <a href="index.php" class="btn btn-default add-to-cart"><i class="fa fa-arrow-left"></i>Back</a>
            </div>
          </form>
       <?php  } ?>
</section>