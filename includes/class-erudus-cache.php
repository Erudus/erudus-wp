<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Erudus_Cache
{

    private $expires =  DAY_IN_SECONDS;

    /**
     * Get product from database cache
     * @param $id
     * @return bool|mixed
     */
    public function get($id)
    {
        global $wpdb;

        $product = $wpdb->get_row( "SELECT * FROM " .
            "{$wpdb->prefix}erudus_cache WHERE erudus_id='$id'" );

        if(!$product) return false;

        // if older than 1 day then is expired
        $expired = (strtotime($product->last_updated) < ( time() - $this->expires));

        $data = unserialize($product->data);
        $data->is_expired= $expired;

        return $data;

    }

    /**
     * Store product to erudus cache
     *
     * @param $id
     * @param $data
     */
    public function set($id, $data)
    {
        global $wpdb;

        $this->remove($id);

        $wpdb->insert(
            $wpdb->prefix.'erudus_cache',
            array(
                'erudus_id' => $id,
                'data' => serialize($data),
                'last_updated' => date ("Y-m-d H:i:s")
            ),
            array(
                '%s',
                '%s',
                '%s'
            )
        );

        return;

    }

    /**
     * Remove product
     *
     * @param $id
     */
    public function remove($id)
    {
        global $wpdb;

        $wpdb->delete($wpdb->prefix.'erudus_cache',array('erudus_id' => $id));

    }

    public function clearAll()
    {
        global $wpdb;

        $wpdb->query(
            $wpdb->prepare(
                "TRUNCATE " .$wpdb->prefix.'erudus_cache',array()
            )
        );

    }
}