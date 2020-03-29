<!DOCTYPE html>
<html class="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript">
    document.documentElement.className = document.documentElement.className + ' yes-js js_active js'
  </script>
  <title>
  <?php if(is_front_page() || is_home()){
        echo get_bloginfo('name');
    } else{
        echo wp_title('');
    }?>
  </title>
  <style>
    .wishlist_table .add_to_cart,
    a.add_to_wishlist.button.alt {
      border-radius: 16px;
      -moz-border-radius: 16px;
      -webkit-border-radius: 16px;
    }

  </style>

  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/settings.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/header.css">
  <style id="rs-plugin-settings-inline-css" type="text/css">
    #rs-demo-id {}

    .hermes.tp-bullets {}

    .hermes .tp-bullet {
      overflow: hidden;
      border-radius: 50%;
      width: 16px;
      height: 16px;
      background-color: rgba(0, 0, 0, 0);
      box-shadow: inset 0 0 0 2px rgb(255, 255, 255);
      -webkit-transition: background 0.3s ease;
      transition: background 0.3s ease;
      position: absolute;
    }

    .hermes .tp-bullet:hover {
      background-color: rgba(0, 0, 0, 0.21);
    }

    .hermes .tp-bullet:after {
      content: ' ';
      position: absolute;
      bottom: 0;
      height: 0;
      left: 0;
      width: 100%;
      background-color: rgb(255, 255, 255);
      box-shadow: 0 0 1px rgb(255, 255, 255);
      -webkit-transition: height 0.3s ease;
      transition: height 0.3s ease;
    }

    .hermes .tp-bullet.selected:after {
      height: 100%;
    }

  </style>
  <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/woocommerce-layout.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/woocommerce-smallscreen.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/woocommerce.css"> -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/colorbox.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/prettyPhoto.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery.selectBox.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style(1).css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style(2).css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/js_composer.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery.fancybox.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app-default.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app-responsive.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style(3).css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style(4).css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style(5).css">


  <!--test here to see changes -->
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.js"></script>
  
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-migrate.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.themepunch.tools.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.themepunch.revolution.min.js"></script>
  
  <script type="text/javascript">
    /* <![CDATA[ */
    var wc_add_to_cart_params = {
      "ajax_url": "\/themes\/sw_topdeal\/wp-admin\/admin-ajax.php",
      "wc_ajax_url": "http:\/\/demo.wpthemego.com\/themes\/sw_topdeal\/?wc-ajax=%%endpoint%%",
      "i18n_view_cart": "View cart",
      "cart_url": "http:\/\/demo.wpthemego.com\/themes\/sw_topdeal\/cart\/",
      "is_cart": "",
      "cart_redirect_after_add": "no"
    };
    /* ]]> */

  </script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/add-to-cart.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/woocommerce-add-to-cart.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/modernizr-2.6.2.min.js"></script>
  <link rel="https://api.w.org/" href="<?php echo get_site_url(); ?>/wp-json/">
  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo get_site_url(); ?>/xmlrpc.php?rsd">
  <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo get_site_url(); ?>/wp-includes/wlwmanifest.xml">
  <meta name="generator" content="WordPress 4.9.8">
  <meta name="generator" content="WooCommerce 3.2.6">
  <link rel="shortlink" href="<?php echo get_site_url(); ?>/">
  <link rel="alternate" type="application/json+oembed" href="<?php echo get_site_url(); ?>/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fdemo.wpthemego.com%2Fthemes%2Fsw_topdeal%2F">
  <link rel="alternate" type="text/xml+oembed" href="<?php echo get_site_url(); ?>/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fdemo.wpthemego.com%2Fthemes%2Fsw_topdeal%2F&amp;format=xml">
  <noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
  <meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress.">
  <!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="<?php echo get_site_url(); ?>/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen"><![endif]-->
  <meta name="generator" content="Powered by Slider Revolution 5.4.6.3.1 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface.">
  <style></style>
  <script type="text/javascript">
    function setREVStartSize(e) {
      try {
        var i = jQuery(window).width(),
          t = 9999,
          r = 0,
          n = 0,
          l = 0,
          f = 0,
          s = 0,
          h = 0;
        if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
            f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
          }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
          var u = (e.c.width(), jQuery(window).height());
          if (void 0 != e.fullScreenOffsetContainer) {
            var c = e.fullScreenOffsetContainer.split(",");
            if (c) jQuery.each(c, function(e, i) {
              u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
            }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
          }
          f = u
        } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
        e.c.closest(".rev_slider_wrapper").css({
          height: f
        })
      } catch (d) {
        console.log("Failure at Presize of Slider:" + d)
      }
    };

  </script>
  <noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
  <style type="text/css">
    .fancybox-margin {
      margin-right: 16px;
    }

  </style>
  <!-- slick begin -->
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/slick/slick.css"/>
  <!-- slick ends -->
  <script style="display: none;">
    var tvt = tvt || {};
    tvt.captureVariables = function(a) {
      for (var b =
          new Date, c = {}, d = Object.keys(a || {}), e = 0, f; f = d[e]; e++)
        if (a.hasOwnProperty(f) && "undefined" != typeof a[f]) try {
          var g = [];
          c[f] = JSON.stringify(a[f], function(a, b) {
            try {
              if ("function" !== typeof b) {
                if ("object" === typeof b && null !== b) {
                  if (b instanceof HTMLElement || b instanceof Node || -1 != g.indexOf(b)) return;
                  g.push(b)
                }
                return b
              }
            } catch (H) {}
          })
        } catch (l) {}
      a = document.createEvent("CustomEvent");
      a.initCustomEvent("TvtRetrievedVariablesEvent", !0, !0, {
        variables: c,
        date: b
      });
      window.dispatchEvent(a)
    };
    window.setTimeout(function() {
      tvt.captureVariables({
        'dataLayer.hide': (function(a) {
          a = a.split(".");
          for (var b = window, c = 0; c < a.length && (b = b[a[c]], b); c++);
          return b
        })('dataLayer.hide'),
        'gaData': window['gaData'],
        'dataLayer': window['dataLayer']
      })
    }, 2000);

  </script>
  <script style="display: none;">
    var tvt = tvt || {};
    tvt.captureVariables = function(a) {
      for (var b =
          new Date, c = {}, d = Object.keys(a || {}), e = 0, f; f = d[e]; e++)
        if (a.hasOwnProperty(f) && "undefined" != typeof a[f]) try {
          var g = [];
          c[f] = JSON.stringify(a[f], function(a, b) {
            try {
              if ("function" !== typeof b) {
                if ("object" === typeof b && null !== b) {
                  if (b instanceof HTMLElement || b instanceof Node || -1 != g.indexOf(b)) return;
                  g.push(b)
                }
                return b
              }
            } catch (H) {}
          })
        } catch (l) {}
      a = document.createEvent("CustomEvent");
      a.initCustomEvent("TvtRetrievedVariablesEvent", !0, !0, {
        variables: c,
        date: b
      });
      window.dispatchEvent(a)
    };
    window.setTimeout(function() {
      tvt.captureVariables({
        'studioV2': window['studioV2'],
        'richMediaIframeBreakoutCreatives': window['richMediaIframeBreakoutCreatives'],
        'dataLayer.hide': (function(a) {
          a = a.split(".");
          for (var b = window, c = 0; c < a.length && (b = b[a[c]], b); c++);
          return b
        })('dataLayer.hide'),
        'gaData': window['gaData'],
        'dataLayer': window['dataLayer']
      })
    }, 2000);

  </script>

  <?php wp_head(); ?>
  </head>



  <body class="">
    <div id="yith-wcwl-popup-message" style="display: none;" class="">
      <div id="yith-wcwl-message"></div>
    </div>
    <div class="body-wrapper theme-clearfix">
      <div class="body-wrapper-inner">
        <header id="header" class="header header-style1">
            <?php // get_template_part('includes/header-part/header-top-sale'); ?>
            <?php // get_template_part('includes/header-part/header-top'); ?>
            <?php get_template_part('includes/header-part/header-mid'); ?>
            <?php // get_template_part('includes/header-part/header-bottom'); ?>
            <?php // get_template_part('includes/header-part/header-bar'); ?>
        </header>
