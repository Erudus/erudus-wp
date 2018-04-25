<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Erudus_Api
{
    protected $baseUrl  = "https://services.erudus.com";

    private $key;
    private $secret;
    private $cache;

    protected $token;


    /**
     * Erudus_Api constructor.
     * @param string $key
     * @param string $secret
     */
    public function __construct($key ='',$secret='')
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->cache = new Erudus_Cache();

        $options = get_option('erudus_options');

        if($key === '') $this->key = $options['erudus_client_key'];
        if($secret ==='') $this->secret = $options['erudus_client_secret'];

    }

    /**
     * Get access token using client credenntials
     *
     * @return int
     */
    public function newAccessToken()
    {

        $data = array(
            'client_id'     => $this->key,
            'client_secret' => $this->secret,
            'grant_type'    => 'client_credentials',
            'scope'         => 'PUBLIC'
        );

        $args = array(
            'body' => json_encode($data),
            'timeout' => '5',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array('Content-Type' => 'application/json'),
            'cookies' => array()
        );

        $response = wp_remote_post( sprintf('%s/api/access_token', $this->baseUrl), $args );

        if ( is_wp_error( $response ) ) {
            return false;
        }

        $response = json_decode( wp_remote_retrieve_body( $response ) );

        $this->setToken( $response->access_token );

        return $this->token;

    }

    /**
     *  get token from cache or generate new one
     *
     * @return int|mixed
     */
    protected function getToken()
    {
        if ( $token = get_transient( 'erudus_token' ) ) {
            $this->token = $token;
        }

        if( !$this->token ){
            $this->token = $this->newAccessToken();
        }

        return $this->token;

    }

    /**
     * set the access token
     *
     * @param $token
     */
    protected function setToken($token)
    {
        $this->token = $token;

        // cache token (tokens expire after one hour so say 50min)
        set_transient( 'erudus_token', $token,  50 * 60 );

    }

    /**
     * Get a product from erudus using the Erudus ID. Product data is cached for 24 hours
     *
     * @param $erudusId
     * @return array|bool|mixed|object
     */
    public function getProduct($erudusId)
    {

        // force refresh of cache ?
        if (isset($_GET['erudus-refresh'])) $this->cache->remove($erudusId);

        // get cached version
        $cached = $this->cache->get($erudusId);

        if($cached && !$cached->is_expired) return $cached;

        // else get fresh version
        $product = $this->getProductFromErudus($erudusId);

        // cannot get new product so just returned cached
        if(!$product) return $cached;

        // replace cached
        $this->cache->set($erudusId,$product);

        return $product;

    }

    protected function getProductFromErudus($id)
    {
        // get product data from Erudus
        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getToken()
        );

        $args = array(
            'headers' => $headers
        );

        $response = wp_remote_get( sprintf('%s/api/public/v1/products/%s?full=1', $this->baseUrl, $id), $args );

        if ( is_wp_error( $response ) ) {
            return false;
        }

        if(wp_remote_retrieve_response_code( $response ) != 200) return false;

        $product = json_decode( wp_remote_retrieve_body( $response ) )->data;

        // check we have some data
        if(empty($product)|| empty($product->id)) return false;

        return $product;

    }

    public function clearCache()
    {
        $this->cache->clearAll();
    }


}