
<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>

    <?php //if(is_shop() || is_product_category() || is_product() || is_cart()){?> 
        <div class="listings-title" style="background: url( <?php echo get_template_directory_uri(); ?>/assets/img/bg-bread.jpg );background-repeat-y: no-repeat;background-position: center;background-size: 125%;">
            <div class="container">
                <div class="wrap-title">
                <h1 class="entry-title">
                    Boutique
                </h1>
                <div class="bread">
                    <div class="breadcrumbs theme-clearfix">
                    <div class="container">
                        <ul class="breadcrumb">
                        <li><a href="<?php echo get_site_url(); ?>">Acceuil</a><span class="go-page"></span></li>
                        <li class="active"><span>Categorie</span></li>
                        </ul>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <?php// } ?>

<div class="container">
   <div class="row 
    <?php if(is_shop() || is_product_category()){
            echo "sidebar-row";
    }
    ?>
    ">
     <?php if(is_shop() || is_product_category()){
        
        $categories = get_categories( array(
            'parent'  => 0
        ) );
         
        $terms = get_terms(['taxonomy' => 'product_cat','hide_empty' => false, 'parent' => 0]);
      ?> 
            
        <aside id="left" class="sidebar col-lg-3 col-md-3 col-sm-12">
            <div class="widget-1 widget-first widget woocommerce_product_categories-6 woocommerce widget_product_categories">
                <div class="widget-inner">
                    <div class="block-title-widget">
                        <h2><span>Categories</span></h2>
                            </div>
                                <ul class="product-categories" data-number="8" data-moretext="Voir Plus" data-lesstext="Voir Moins">
                                <?php  
                                        foreach ( $terms as $category ) {
                                            if($category->name == "Uncategorized" || $category->name == "Non classé"){ ?>
                                                <li class="cat-item cat-item-<?php echo $category->term_id; ?>"><a href="<?php echo get_category_link( $category->term_id );?>"><?php echo 'Toutes Autres Categories' ?></a></li>
                                                    <?php  } else {?>
                                                <li class="cat-item cat-item-<?php echo $category->term_id; ?>"><a href="<?php echo get_category_link( $category->term_id );?>"><?php echo $category->name; ?></a></li>
                                                <?php }
                                        }
                                ?>
                                    
                                    <li class="cat-item cat-item-324"><a href="bras/">Bras</a></li>
                                    <li class="cat-item cat-item-326" style="display: none;"><a href="<?php echo get_site_url();?>/digital/">Digital</a></li>
               
                                    <li class="showMore"><a> </a></li>
                                </ul>
                            </div>
                        </div>

        <?php if(is_shop() || is_product_category()){?> 
            <div class="widget-2 widget woocommerce_price_filter-5 woocommerce widget_price_filter"><div class="widget-inner"><div class="block-title-widget"><h2><span>Par prix</span></h2></div><form method="get" action="<?php echo get_template_directory_uri(); ?>/shop/">
                <div class="price_slider_wrapper">
                    <div class="price_slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style=""><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span></div>
                    <div class="price_slider_amount">
                        <input type="text" id="min_price" name="min_price" value="2" data-min="2" placeholder="Min price" style="display: none;">
                        <input type="text" id="max_price" name="max_price" value="340" data-max="340" placeholder="Max price" style="display: none;">
                        <button type="submit" class="button">Filtre</button>
                        <div class="price_label" style="">
                            Price: <span class="from">2.76 CFA</span> — <span class="to">469.60 CFA</span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
            </form>
                </div>
                </div>
            <div class="widget-3 widget woocommerce_layered_nav-10 woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                <div class="widget-inner"><div class="block-title-widget"><h2><span>Couleur</span></h2></div><ul class="woocommerce-widget-layered-nav-list"><li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a href="<?php echo get_template_directory_uri(); ?>/shop/?filter_color=black">Noir</a> <span class="count">(1)</span></li><li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a href="<?php echo get_template_directory_uri(); ?>/shop/?filter_color=green">Vert</a> <span class="count">(1)</span></li><li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a href="<?php echo get_template_directory_uri(); ?>/shop/?filter_color=red">Rouge</a> <span class="count">(1)</span></li></ul></div></div>
            <div class="widget-4 widget woocommerce_layered_nav-11 woocommerce widget_layered_nav woocommerce-widget-layered-nav"><div class="widget-inner"><div class="block-title-widget"><h2><span>Taille</span></h2></div><ul class="woocommerce-widget-layered-nav-list"><li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a href="<?php echo get_template_directory_uri(); ?>/shop/?filter_color=black">Noir</a> <span class="count">(1)</span></li><li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a href="<?php echo get_template_directory_uri(); ?>/shop/?filter_color=green">Vert</a> <span class="count">(1)</span></li><li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term "><a href="<?php echo get_template_directory_uri(); ?>/shop/?filter_color=red">Rouge</a> <span class="count">(1)</span></li></ul></div></div>
            <div class="widget-5 widget-last widget media_image-4 widget_media_image">
                <div class="widget-inner">
                    <img width="270" height="427" src="<?php echo get_template_directory_uri(); ?>/assets/img/banner-sidebar.jpg" class="image wp-image-3753  attachment-full size-full" alt="" style="max-width: 100%; height: auto;" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/banner-sidebar.jpg 270w, <?php echo get_template_directory_uri(); ?>/assets/img/banner-sidebar-190x300.jpg 190w" sizes="(max-width: 270px) 100vw, 270px">
                </div>
            </div>	
        <?php } ?>
        </aside>
     <?php } ?>
        
        <div id="contents" class="content 
            <?php if( is_product()){
            echo "col-lg-12";
            } else {
            echo "col-lg-9";
            }
            ?>
         col-md-12 col-sm-12" role="main">
            <div class="container">
                <div class="content woocommerce" role="main">
                        <?php woocommerce_content(); ?>
                </div>
            </div>
        </div>

   </div>
</div>


<?php get_footer(); ?>
