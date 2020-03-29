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

<?php if(is_cart() || is_checkout()){?> 
        <div class="listings-title" style="background: url( <?php echo get_template_directory_uri(); ?>/assets/img/bg-bread.jpg )">
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
<li class="active"><span><?php if(is_cart()){?>Panier<?php } else {?> Commander <?php } ?></span></li>
                        </ul>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <?php } ?>

<style>
#content {
    padding-top: 100px;
}
</style>

<div class="page-section section mt-80 mt-lg-60 mt-md-60 mt-sm-60 mt-xs-40 mb-40 mb-lg-20 mb-md-20 mb-sm-20 mb-xs-0">
    <div class=" container">
            <div class="row row-30" id="content">

                <div class="col-xl-12 col-lg-12 col-12 order-1 order-lg-2 mb-40" style="text-align: center;">

                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                     the_content(); 
                    endwhile;
                else :
                    echo wpautop( 'Sorry, no posts were found' );
                endif;
                ?>

                </div>
            </div><!-- .site-main -->
        </div><!-- .content-area -->
    </div>
<?php get_footer(); ?>
