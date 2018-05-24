<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'Erudus_Shortcodes' ) ) :
class Erudus_Shortcodes {

    /**
     *  register hooks
     */
    static public function init()
    {

        add_shortcode('erudus-product', array( self::class, 'show_product'));

    }

    /**
     * display a product shorcode
     *
     * @param array $atts
     * @param null $content
     * @return string
     */
    static public function show_product($atts = [], $content = null)
    {

        // defaults applied
        $atts = shortcode_atts([
            'id' => '',
        ], $atts);

        if(!$atts['id']) return $content;

        $content = erudus_show_product($atts['id']);

        return apply_filters( 'erudus_shortcode', $content );

    }

}
endif;