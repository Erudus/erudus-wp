<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Erudus_To_Custom_Fields {

    /**
     *  register hooks
     */
    static public function init()
    {

        if ( !is_plugin_active('advanced-custom-fields-pro/acf.php') ) {
           return;
        }

        add_action('acf/save_post', array(self::class,'save_post'), 20);

    }


    static public function save_post( $post_id )
    {

        // has erudus ID
        $erudus_id = get_post_meta($post_id,'erudus_id',true);

        if(!$erudus_id) return;

        // find product and update from product
        $product = erudus_get_product($erudus_id);

        // only hand single component products
        $component = $product->components[0];

        // allergens
        $allergens = array(
            'contains_cereal',
            'contains_gluten',
            'contains_milk',
            'contains_eggs',
            'contains_peanuts',
            'contains_tree_nuts',
            'contains_crustacea',
            'contains_mustard',
            'contains_fish',
            'contains_lupin',
            'contains_sesame_seeds',
            'contains_celery_celeriac',
            'contains_soybeans',
            'contains_molluscs',
            'contains_sulphur_dioxide'
            );

        foreach($allergens as $allergen)
        {
            self::update_custom_field( $post_id, $allergen, $component->allergens->{$allergen} );
        }

        // nutrients
        $nutrients = array(
            'cal_100_kj',
            'cal_100_kcal',
            'carb_100',
            'sugar_carb_100',
            'fat_100',
            'sat_fat_100',
            'fibre_100',
            'protein_100',
            'salt_100'
        );

        foreach($nutrients as $nutrient)
        {
            self::update_custom_field( $post_id, $nutrient, $component->nutrients->{$nutrient}->value . $component->nutrients->{$nutrient}->unit );
        }

        self::update_custom_field( $post_id, 'ingredients', $component->ingredients );



    }


    static public function update_custom_field($post_id, $field_name, $value)
    {

        // so users can remap fields to a different custom field
        $field_name = apply_filters('erudus_custom_field_name', $field_name);

        update_post_meta( $post_id, $field_name, $value );
    }

}