<?php

/**
 * get product content
 *
 * @param $erudus_id
 * @return string
 */
function erudus_show_product($erudus_id)
{

    $product = erudus_get_product($erudus_id);

    ob_start();

    include erudus_product_template_path();

    return ob_get_clean();

}

/**
 * Get product object
 *
 * @param $erudus_id
 * @return object
 */
function erudus_get_product($erudus_id)
{

    $client = new Erudus_Api();

    return $client->getProduct($erudus_id);

}


/**
 * Get product template path
 *
 * @return string
 */
function erudus_product_template_path() {

    // locate in theme
    $template_path = locate_template( 'erudus/product.php', false, false );

    if ( $template_path &&  file_exists( $template_path ) ) {
        return $template_path;
    }

    // use default in plugin folder
    return  apply_filters( 'erudus_product_template', ERUDUS_PLUGIN_PATH . 'templates/product.php');

}