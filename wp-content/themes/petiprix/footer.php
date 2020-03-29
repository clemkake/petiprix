<footer id="footer" class="footer default theme-clearfix ">
  <!-- Content footer -->
  <div class="container">
    <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid footer-contact vc_custom_1475145035303 vc_row-has-fill" style="position: relative; left: -245.333px; box-sizing: border-box; width: 1691px; padding-left: 245.333px; padding-right: 245.667px;">
      <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner vc_custom_1475206880928">
          <div class="wpb_wrapper">
            <div class="vc_row wpb_row vc_inner vc_row-fluid">
              <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6 vc_col-md-6">
                <div class="vc_column-inner ">
                  <div class="wpb_wrapper">
                    <div class="wpb_raw_code wpb_content_element wpb_raw_html">
                      <div class="wpb_wrapper">
                        <div class="title-newsletter">
                          <!-- <h3><span>Sign up to newsletter</span> and receive <span class="flag">$29</span> coupon for first shopping</h3> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6 vc_col-md-6 vc_col-xs-12">
                <div class="vc_column-inner ">
                  <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element  footer-style1-newsletter">
                      <div class="wpb_wrapper">
                        <div class="newsletter-footer">

                        </div>

                      </div>
                    </div>

                    <div class="wpb_raw_code wpb_content_element wpb_raw_html">
                      <div class="wpb_wrapper">
                        <div class="socials-footer">
                          <ul>
                            <li><a href="http://www.facebook.com/wpthemego" title="Face Book"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="https://twitter.com/wpthemego" title="Twitter"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="http://www.pinterest.com/wpthemego/" title="pinterest"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="<?php echo get_site_url(); ?>/?fbclid=IwAR2JeIhwLF3zRj_m54rkGGK5C104XlmfqRETInnH5gVt3KS71lj7fmVlCSI#" title="Instagram"><span class="fa fa-instagram"></span></a></li>
                            <li><a href="https://plus.google.com/u/0/b/117616422700848151321/117616422700848151321" title="Google Plus"><span class="fa fa-google-plus"></span></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="vc_row-full-width vc_clearfix"></div>

    <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid footer-categories" style="position: relative; left: -40px; box-sizing: border-box; width: 1280px; padding-left: 40px; padding-right: 40px;">
      <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
          <div class="wpb_wrapper">
            <div id="slider_category_slide_sw_woo_cat_slider_widget_1" class="sw-category-child-theme clearfix">
              <div class="resp-slider-container">
                <div class="slider">
                    <?php 
                      // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
                      // This code based on wp_nav_menu's code to get Menu ID from menu slug
                      
                      $menu_name = 'footer-menu';
                      $array_menu = wp_get_nav_menu_items($menu_name);
                      $menu = array();
                      foreach ($array_menu as $m) {
                          if (empty($m->menu_item_parent)) {
                              $menu[$m->ID] = array();
                              $menu[$m->ID]['ID']      =   $m->ID;
                              $menu[$m->ID]['title']       =   $m->title;
                              $menu[$m->ID]['url']         =   $m->url;
                              $menu[$m->ID]['children']    =   array();
                          }
                      }
                      $submenu = array();
                      foreach ($array_menu as $m) {
                          if ($m->menu_item_parent) {
                              $submenu[$m->ID] = array();
                              $submenu[$m->ID]['ID']       =   $m->ID;
                              $submenu[$m->ID]['title']    =   $m->title;
                              $submenu[$m->ID]['url']  =   $m->url;
                              $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
                          }
                      }
                    ?>

                  <?php
                      //print_r($submenu);
                    foreach($menu as $Menu){
                  ?>
                  <div class="item item-product-cat">
                    <div class="item-name">
                      <h3><a href="<?php  echo $Menu['url']; ?>"><?php  echo $Menu['title']; ?></h3>
                    </div>

                    <div class="item-childcat">

                        <?php if(!empty($Menu['children'])){ ?> 
                          <ul>
                            <?php
                                foreach($Menu['children'] as $submenu){  
                            ?>  
                              <li class="">
                                <a href="<?php echo $submenu['url']; ?>">
                                  <?php echo $submenu['title']; ?>
                                </a>
                              </li>
                            <?php  
                                } 
                            ?>
                          </ul>
                        <?php } ?>

                    </div>

                  </div>

                  <?php }?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="vc_row-full-width vc_clearfix"></div>
    <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid footer-style1-bottom" style="position: relative; left: -245.333px; box-sizing: border-box; width: 1691px; padding-left: 245.333px; padding-right: 245.667px;">
      <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
          <div class="wpb_wrapper">
            <div class="wpb_single_image wpb_content_element vc_align_center">

              <figure class="wpb_wrapper vc_figure">
                <a href="<?php echo get_site_url(); ?>/" target="_self" class="vc_single_image-wrapper   vc_box_border_grey"><img width="153" height="38" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-default.png" class="vc_single_image-img attachment-large" alt="" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/logo-default.png 153w, <?php echo get_site_url(); ?>/assets/img/logo-default-150x38.png 150w" sizes="(max-width: 153px) 100vw, 153px"></a>
              </figure>
            </div>

            <div class="wpb_raw_code wpb_content_element wpb_raw_html">
              <div class="wpb_wrapper">
                <div class="footer-info">
                  <p>La clé est d'avoir chaque clé, la clé pour ouvrir chaque porte. On ne les voit pas on va les créer</p>
                  <ul>
                    <li><i class="fa fa-map-marker"></i><span>Abidjan Cocody</span></li>
                    <li><i class="fa fa-phone"></i><span>+225 08 00 00 88</span></li>
                    <li><i class="fa fa-envelope"></i><a href="mailto:hello@petiprix.com">hello@petiprix.com</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="wpb_single_image wpb_content_element vc_align_center">

              <figure class="wpb_wrapper vc_figure">
                <a href="<?php echo get_site_url(); ?>/?fbclid=IwAR2JeIhwLF3zRj_m54rkGGK5C104XlmfqRETInnH5gVt3KS71lj7fmVlCSI#" target="_self" class="vc_single_image-wrapper   vc_box_border_grey"><img width="324" height="30" src="<?php echo get_template_directory_uri(); ?>/assets/img/app-footer.png" class="vc_single_image-img attachment-large" alt="" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/app-footer.png 324w, <?php echo get_site_url(); ?>/wp-content/uploads/2016/09/app-footer-300x28.png 300w" sizes="(max-width: 324px) 100vw, 324px"></a>
              </figure>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="vc_row-full-width vc_clearfix"></div>
    <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid footer-copyright-style1" style="position: relative; left: -245.333px; box-sizing: border-box; width: 1691px; padding-left: 245.333px; padding-right: 245.667px;">
      <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
          <div class="wpb_wrapper">
            <div class="wpb_text_column wpb_content_element ">
              <div class="wpb_wrapper">
                <div class="copyright col-sm-6">© 2018<a href="https://petiprix.com/">Petiprix</a> Tout droit Reserve</div>
                <div class="footer-paypal"><img class="alignnone wp-image-4095" src="<?php echo get_template_directory_uri(); ?>/assets/img/paypal.png" alt="" width="333" height="32" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/paypal.png 333w, <?php echo get_template_directory_uri(); ?>/assets/img/paypal-300x29.png 300w"
                    sizes="(max-width: 333px) 100vw, 333px"></div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="vc_row-full-width vc_clearfix"></div>
  </div>
</footer>
</div>
</div>
<form method="post" id="cpanel-form" action="<?php echo get_site_url(); ?>/" enctype="multipart/form-data" class="form-horizontal"><input type="hidden" id="last_tab" name="topdeal_theme[last_tab]" value="4">

  <div class="accordion cpanel-inner in" id="cpanel" style="height: auto;">
    <div class="cpanel-title">
      <h4> Theme Settings</h4>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#cpanel" href="<?php echo get_site_url(); ?>/?fbclid=IwAR2JeIhwLF3zRj_m54rkGGK5C104XlmfqRETInnH5gVt3KS71lj7fmVlCSI#cpanel_0">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/glyphicons_163_iphone.png" alt=""> Schemes							</a>
      </div>
      <div id="cpanel_0" class="panel-collapse collapse in">
        <div class="panel-body">
          <div class="control-group"><label class="control-label">Color Scheme</label>
            <div class="controls">
              <fieldset><label class="topdeal-radio-img topdeal-radio-img-selected topdeal-radio-img-scheme" for="scheme_0"><input type="radio" id="scheme_0" name="topdeal_theme[scheme]" value="default" checked="checked"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/default.png" alt="Default" title="Default" onclick="jQuery:topdeal_radio_img_select(&#39;scheme_0&#39;, &#39;scheme&#39;);"><br><span>Default</span></label>
                <label
                  class="topdeal-radio-img topdeal-radio-img-scheme" for="scheme_1"><input type="radio" id="scheme_1" name="topdeal_theme[scheme]" value="pink"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/pink.png" alt="Pink" title="Pink" onclick="jQuery:topdeal_radio_img_select(&#39;scheme_1&#39;, &#39;scheme&#39;);"><br><span>Pink</span></label>
                  <label
                    class="topdeal-radio-img topdeal-radio-img-scheme" for="scheme_2"><input type="radio" id="scheme_2" name="topdeal_theme[scheme]" value="red"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/red.png" alt="Red" title="Red" onclick="jQuery:topdeal_radio_img_select(&#39;scheme_2&#39;, &#39;scheme&#39;);"><br><span>Red</span></label>
                    <label
                      class="topdeal-radio-img topdeal-radio-img-scheme" for="scheme_3"><input type="radio" id="scheme_3" name="topdeal_theme[scheme]" value="blue"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blue.png" alt="Blue" title="Blue" onclick="jQuery:topdeal_radio_img_select(&#39;scheme_3&#39;, &#39;scheme&#39;);"><br><span>Blue</span></label>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#cpanel" href="<?php echo get_site_url(); ?>/?fbclid=IwAR2JeIhwLF3zRj_m54rkGGK5C104XlmfqRETInnH5gVt3KS71lj7fmVlCSI#cpanel_1">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/glyphicons_157_show_lines.png" alt=""> Navbar Options							</a>
      </div>
      <div id="cpanel_1" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="control-group"><label class="control-label">Active sticky menu</label>
            <div class="controls"><input type="checkbox" id="sticky_menu" name="topdeal_theme[sticky_menu]" value="1" class=""></div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#cpanel" href="<?php echo get_site_url(); ?>/">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/glyphicons_083_random.png" alt=""> Advanced							</a>
      </div>
      <div id="cpanel_2" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="control-group"><label class="control-label">Direction</label>
            <div class="controls"><select id="direction" name="topdeal_theme[direction]"><option value="ltr" selected="selected">Left to Right</option><option value="rtl">Right to Left</option></select></div>
          </div>
        </div>
      </div>
    </div>
    <div class="cpannel-button">
      <button id="cpanel-submit" class="btn btn-inverse" type="submit">SAVE</button>
      <button id="cpanel-reset" class="btn btn-inverse" type="button">RESET</button>
    </div>
  </div><a class="cpanel-control" href="<?php echo get_site_url(); ?>/"></a></form><a id="topdeal-totop" href="<?php echo get_site_url(); ?>/"
  style="display: none;" class=""></a>


<div class="modal fade" id="search_form" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog block-popup-search-form">
    <form role="search" method="get" class="form-search searchform" action="<?php echo get_site_url(); ?>/">
      <input type="text" value="" name="s" class="search-query" placeholder="Enter your keyword...">
      <button type="submit" class=" fa fa-search button-search-pro form-button"></button>
      <a href="javascript:void(0)" title="Close" class="close close-search" data-dismiss="modal">X</a>
    </form>
  </div>
</div>




<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.blockUI.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/js.cookie.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/woocommerce.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/cart-fragments.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/woocompare.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.prettyPhoto.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.selectBox.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.yith-wcwl.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/sw_woocommerce_search_products.min.js"></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/img.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/category-ajax.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/isotope.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/wc-quantity-increment.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.nav.js"></script>
<script type="text/javascript">
  /* <![CDATA[ */
  var custom_text = {
    "cart_text": "Add To Cart",
    "compare_text": "Compare",
    "wishlist_text": "WishList",
    "quickview_text": "QuickView"
  };
  /* ]]> */

</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>

<script type="text/javascript">
  /* <![CDATA[ */
  var wc_single_product_params = {
    "i18n_required_rating_text": "Please select a rating",
    "review_rating_required": "yes",
    "flexslider": {
      "rtl": false,
      "animation": "slide",
      "smoothHeight": true,
      "directionNav": false,
      "controlNav": "thumbnails",
      "slideshow": false,
      "animationSpeed": 500,
      "animationLoop": false,
      "allowOneSlide": false
    },
    "zoom_enabled": "1",
    "photoswipe_enabled": "1",
    "photoswipe_options": {
      "shareEl": false,
      "closeOnScroll": false,
      "history": false,
      "hideAnimationDuration": 0,
      "showAnimationDuration": 0
    },
    "flexslider_enabled": ""
  };
  /* ]]> */

</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/single-product.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/underscore.min.js"></script>
<script type="text/javascript">
  /* <![CDATA[ */
  var _wpUtilSettings = {
    "ajax": {
      "url": "\/themes\/sw_topdeal\/wp-admin\/admin-ajax.php"
    }
  };
  /* ]]> */

</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/wp-util.min.js"></script>
<script type="text/javascript">
  /* <![CDATA[ */
  var wc_add_to_cart_variation_params = {
    "wc_ajax_url": "http:\/\/demo.wpthemego.com\/themes\/sw_topdeal\/?wc-ajax=%%endpoint%%",
    "i18n_no_matching_variations_text": "Sorry, no products matched your selection. Please choose a different combination.",
    "i18n_make_a_selection_text": "Please select some product options before adding this product to your cart.",
    "i18n_unavailable_text": "Sorry, this product is unavailable. Please choose a different combination."
  };
  /* ]]> */

</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/add-to-cart-variation.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/wp-embed.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/money.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/accounting.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/conversion.js"></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/megamenu.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/js_composer_front.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/field_radio_img.js"></script>
<script type="text/javascript">

</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/forms-api.min.js"></script>
<!--[if lte IE 9]>
<script type='text/javascript' src='<?php echo get_site_url(); ?>/wp-content/plugins/mailchimp-for-wp/assets/js/third-party/placeholders.min.js?ver=4.1.12'></script>
<![endif]-->

<!-- <div id="indexdm_img" class="" style="display: none;">
  <div class="img-demo"></div>
</div> -->
<script type="text/javascript">
  jQuery(document).delay(2e3).queue(function(e) {
    jQuery(document).ready(function(e) {
      var i = e("#widget_indexdm"),
        a = i.width(),
        d = i.hasClass("right");
      e(".dm-open").on("click", function(s) {
        var n = i.hasClass("right") ? i.css("left") : i.css("right");
        e(this).hasClass("active") ? (e(this).removeClass("active"), e.cookie("demo_index", 1, {
          expires: 1,
          path: "/"
        })) : (e(this).addClass("active"), e.cookie("demo_index", 0, {
          expires: 1,
          path: "/"
        })), parseFloat(n) < -10 ? (e("#indexdm_img").css("display", "flex"), d ? i.animate({
          left: "0px"
        }, 300) : i.animate({
          right: "0px"
        }, 300)) : (e("#indexdm_img").css("display", "none"), d ? i.animate({
          left: "-" + a
        }, 300) : i.animate({
          right: "-" + a
        }, 300)), s.preventDefault()
      }), e.cookie("demo_index") && 1 == e.cookie("demo_index") ? (e(".dm-open").removeClass("active"), e("#indexdm_img").css("display", "none"), d ? i.animate({
        left: "-" + a
      }, 300) : i.animate({
        right: "-" + a
      }, 300)) : (e(".dm-open").addClass("active"), e("#indexdm_img").css("display", "flex"), d ? i.animate({
        left: "0px"
      }, 300) : i.animate({
        right: "0px"
      }, 300)), e(".indexdm-href").each(function() {
        e(this).mouseenter(function() {
          e(this).hasClass("mobiledm-href") && e("#indexdm_img > div").addClass("mobile-hover");
          var i = e(this).data("img"),
            a = e(this).data("height");
          e("#indexdm_img > div").css("display", "block"), e(window).height() < a ? e("body").delay(300).addClass("hover") : e("#indexdm_img > div").css("background-position", "center center"), e("#indexdm_img > div").css("background-image", "url(" + i + ")")
        }).mouseleave(function() {
          e("#indexdm_img > div").css("display", "none"), e("#indexdm_img > div").css("background-position", "center top"), e("body").removeClass("hover"), e("#indexdm_img > div").removeClass("mobile-hover")
        })
      }), e(".header-maintaince img").on("click", function() {
        e.cookie("topdeal-child-theme_theme_maintaince_enable", null, {
          path: "/"
        })
      })
    }), e()
  });

</script>
<script type="text/javascript">
  (function($) {
    /* Responsive Menu */
    $(document).ready(function() {
      $(".show-dropdown").each(function() {
        $(this).on("click", function() {
          $(this).toggleClass("show");
          var $element = $(this).parent().find("> ul");
          $element.toggle(300);
        });
      });
    });
  })(jQuery);

</script>
<script>
  jQuery('#nav-hamburger-menu .nav-icon-a11y.nav-sprite').click(function() {
           jQuery('#hmenu-container #hmenu-canvas').addClass('active');
    });
	jQuery('div#hmenu-canvas-background .nav-sprite.hmenu-close-icon').click(function() {
           jQuery('#hmenu-container #hmenu-canvas').removeClass('active');
    });	
	jQuery('div#hmenu-canvas-background .nav-sprite.hmenu-close-icon').click(function() {
           jQuery('#hmenu-container #hmenu-canvas-background.hmenu-dark-bkg-color').css('display', 'none');
    });
	jQuery('#nav-hamburger-menu .nav-icon-a11y.nav-sprite').click(function() {
           jQuery('#hmenu-container #hmenu-canvas-background.hmenu-dark-bkg-color').css('display', 'block');
    });
</script>
<div id="cboxOverlay" style="display: none;" class=""></div>
<div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;">
  <div id="cboxWrapper">
    <div>
      <div id="cboxTopLeft" style="float: left;"></div>
      <div id="cboxTopCenter" style="float: left;"></div>
      <div id="cboxTopRight" style="float: left;"></div>
    </div>
    <div style="clear: left;">
      <div id="cboxMiddleLeft" style="float: left;"></div>
      <div id="cboxContent" style="float: left;">
        <div id="cboxTitle" style="float: left;"></div>
        <div id="cboxCurrent" style="float: left;"></div><button type="button" id="cboxPrevious"></button><button type="button" id="cboxNext"></button><button id="cboxSlideshow"></button>
        <div id="cboxLoadingOverlay" style="float: left;"></div>
        <div id="cboxLoadingGraphic" style="float: left;"></div>
      </div>
      <div id="cboxMiddleRight" style="float: left;"></div>
    </div>
    <div style="clear: left;">
      <div id="cboxBottomLeft" style="float: left;"></div>
      <div id="cboxBottomCenter" style="float: left;"></div>
      <div id="cboxBottomRight" style="float: left;"></div>
    </div>
  </div>
  <div style="position: absolute; width: 9999px; visibility: hidden; display: none; max-width: none;"></div>
</div>

<!-- begin slick js -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/slick/slick.min.js"></script>
<!-- End slick js -->

<?php wp_footer(); ?>




    
</body>

</html>
