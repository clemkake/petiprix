<?php
if ( ! defined('ABSPATH')) exit;  // if direct access









add_action('wp_footer','wcps_builder_tools');

function wcps_builder_tools(){

    ?>
    <div id="wcps-builder-tools">

        wcps_builder_tools

    </div>
    <?php

}

add_action('wcps_builder','wcps_builder');
function wcps_builder(){
    ?>
    <div id="wcps-builder">

        wcps_builder

    </div>
    <?php
}