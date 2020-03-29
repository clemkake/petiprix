<?php
 if(is_home()){

   ?>

   <div class="container">
     <div class="row">
        <div class="col-lg-2">
          <!-- <img data-src="holder.js/200x200" class="rounded" alt="200x200" src="<?php echo get_template_directory_uri(); ?>/assets/img/fer.jpg" data-holder-rendered="true" style="width: 100%; height: 400px;"> -->
          <img data-src="holder.js/200x200" class="rounded" alt="200x200" src="https://static1.squarespace.com/static/5682b6f957eb8d0dbae2c4b2/t/5cc7ccb0b208fcc964af5001/1556597945342/EDM+P8+PROMO.jpg" data-holder-rendered="true" style="width: 100%; height: 400px;">
          
        </div>
        <div class="col-lg-8" >
            <?php
              echo  do_shortcode('[sp_responsiveslider cat_id="50"]');
            ?>
        </div>
        <div class="col-lg-2">
          <!-- <img data-src="holder.js/200x200" class="rounded" alt="200x200" src="<?php echo get_template_directory_uri(); ?>/assets/img/fer.jpg" data-holder-rendered="true" style="width: 100%; height: 400px;"> -->
          <img data-src="holder.js/200x200" class="rounded" alt="200x200" src="https://www.gohenryreview.com/wp-content/uploads/2015/01/free.png" data-holder-rendered="true" style="width: 100%; height: 400px;">
        </div>
      </div>
   </div>


 <?php } ?>

<div class="container">
  <div class="row sidebar-row">

    <div id="contents"  role="main" class="main-page  col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="post-9 page type-page status-publish hentry">
        <div class="entry-content">
          <div class="entry-summary">

        <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <ul class="nav nav-tabs">
                    <li class="loaded active">
                      <a style="background-color:blue;" href="javascript:;">
                          <b style="color:white;">Rayon promo</b>
                      </a>
                    </li>
                    <li class="loaded" style="float: right;">
                      <a href="javascript:;">
                          <b>Voir Plus</b>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="panel-body" style="background-color: #e8f8ff; padding: 30px;border: 3px solid blue; ">
                  <section id="product-deal">
                      <?php  echo do_shortcode('[products limit="10" columns="5" orderby="popularity" class="quick-sale" on_sale="true" ]'); ?>

                      <?php //echo do_shortcode('[woo-product-slider-pro id="402"]'); ?>
                  </section>
                </div>
              </div>

              </div>
        </div>

        <!-- promo -->
        <div class="row">
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/Week11/DB/CI_W11_DB2_Desktop-Climatisseurs.jpg" alt="" srcset="">
          </div>
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/Week11/DB/CI_W11_DB4_Desktop-matelas.jpg" alt="" srcset="">
          </div>
        </div>
        <!-- promo -->

        <!-- loop sur category animaliere -->
        <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <ul class="nav nav-tabs">
                  <li class="loaded active">
                    <a style="background-color:red;" href="javascript:;">
                     <b style="color:white;">Rayon Animalerie</b>
                    </a>
                  </li>
                  <li class="loaded" style="float: right;">
                    <a href="javascript:;">
                        <b>Voir Plus</b>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="panel-body"  style="background-color: #ffff; padding: 30px;border: 3px solid red; ">
                <section id="product-deal">
                    <?php echo do_shortcode('[products limit="10" columns="5" category="uncategorized" cat_operator="AND"]'); ?>
                    <?php //echo do_shortcode('[woo-product-slider-pro id="404"]'); ?>
                </section>
              </div>
            </div>
            </div>
          </div>
          </div>
        </div>
        <!-- fin loop sur category animaliere -->

        <!-- promo -->
        <div class="row">
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/1_MW19/CI_W10_DFB_Mobile-Week-teasign_SKUS.png" alt="" srcset="">
          </div>
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/Week07/CI_W07_DFB-Flash-Sales.jpg" alt="" srcset="">
          </div>
        </div>
        <!-- promo -->

        <!-- loop sur category charcuterie -->
        <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                 <ul class="nav nav-tabs">
                    <li class="loaded active">
                      <a style="background-color:#ff9901;" href="javascript:;">
                        <b style="color:white;">Rayon Charcuterie</b>
                      </a>
                    </li>
                    <li class="loaded" style="float: right;">
                      <a href="javascript:;">
                          <b>Voir Plus</b>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="panel-body"  style="background-color: #ffcd7a1c; padding: 30px;border: 3px solid #ff9901; ">
                  <section id="product-deal">
                      <?php echo do_shortcode('[products limit="10" columns="5" category="uncategorized" cat_operator="AND"]'); ?>
                      <?php //echo do_shortcode('[woo-product-slider-pro id="403"]'); ?>
                  </section>
                </div>
              </div>
            </div>
        </div>

        <!-- promo -->
        <div class="row">
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/1_MW19/CI_W10_DFB_Mobile-Week-teasign_SKUS.png" alt="" srcset="">
          </div>
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/Week07/CI_W07_DFB-Flash-Sales.jpg" alt="" srcset="">
          </div>
        </div>
        <!-- promo -->

        <!-- loop sur category Divers -->
         <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
               <ul class="nav nav-tabs">
                  <li class="loaded active">
                    <a style="background-color:green;" href="javascript:;">
                      <b style="color:white;">Rayon Divers</b>
                    </a>
                  </li>
                  <li class="loaded" style="float: right;">
                    <a href="javascript:;">
                        <b>Voir Plus</b>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="panel-body"  style="background-color: #c2ecc55c; padding: 30px;border: 3px solid green; ">
                <section id="product-deal">
                    <?php echo do_shortcode('[products limit="10" columns="5" category="uncategorized" cat_operator="AND"]'); ?>
                    <?php //echo do_shortcode('[woo-product-slider-pro id="405"]'); ?>
                </section>
              </div>
            </div>
            </div>
          </div>
          </div>
        </div>
        <!-- fin loop sur category Divers -->
        
        <!-- promo -->
        <div class="row">
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/Week11/DB/CI_W11_DB2_Desktop-Climatisseurs.jpg" alt="" srcset="">
          </div>
          <div class="col-lg-6">
            <img src="https://static.jumia.ci/cms/1_2019/Week11/DB/CI_W11_DB4_Desktop-matelas.jpg" alt="" srcset="">
          </div>
        </div>
        <!-- promo -->
      </div>
    </div>
        <!-- fin loop sur category charcuterie -->


        
        <style>
          .woocommerce ul.products {
              margin: 0 0 -3em;
              padding: 0;
              list-style: none outside;
              clear: both;
          }
          .woocommerce ul.products li.product .button {
              margin-top: 1em;
              /* display: -webkit-box; */
          }

          .tinv-wraper.tinv-wishlist {
              font-size: 100%;
              display: none;
          }

          .panel-body {
            /* border-bottom: 5px solid beige; */
            border: 5px solid beige;
            border-radius: 2%;
          }



            .panel-default>.panel-heading {
                color: #333;
                background-color: #ffff;
                border-color: #ddd;
            }

            .panel {
                  margin-bottom: 20px;
                  background-color: #fff;
                  border: 1px solid transparent;
                  border-radius: 4px;
                  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.05);
                  box-shadow: 0 1px 1px rgba(0,0,0,0.05);
              }

            li.loaded.active a b {
                color: orange;
            }

            main {
              margin-bottom: 200%;
            }
            .floating-menu {
                font-family: sans-serif;
                background: #fad7a9;
                padding: 5px;
                width: 35px;
                left: 5%;
                z-index: 100;
                position: fixed;
                border-radius: 12%;
            }
            .floating-menu a, 
            .floating-menu h3 {
              font-size: 0.9em;
              display: block;
              margin: 0 0.5em;
              color: white;
            }
        </style>
        <script>
          jQuery(document).ready(function(){
            jQuery(this).find('.button').fadeOut();
            jQuery('.woocommerce ul.products li.product').mouseenter(function() {
              jQuery(this).find('.button').show();
            })
            .mouseleave(function() {
              jQuery(this).find('.button').fadeOut();
            });
          })
        </script>
        </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?php   
$productid = '335';
$product = wc_get_product( $productid );
//echo $product->get_date_on_sale_from('y.m.d').'</br>';
//echo $product->get_date_on_sale_to('y.m.d').'</br>';
?>



