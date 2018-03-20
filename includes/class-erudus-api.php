<?php

use GuzzleHttp\Client;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Erudus_Api
{
    protected $baseUrl  = "https://services.erudus.com";

    private $key;
    private $secret;

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

        try {

            $data = array(
                'client_id'     => $this->key,
                'client_secret' => $this->secret,
                'grant_type'    => 'client_credentials',
                'scope'         => 'PUBLIC'
            );

            $client = new Client(['headers' => ['Content-Type' => 'application/json']]);

            $response = $client->post(sprintf('%s/api/access_token', $this->baseUrl), [
                'form_params' => $data
            ]);

        } catch(\GuzzleHttp\Exception\BadResponseException $e) {

          //  $this->lastResponse = $e->getResponse();

            return false;

        }

        $response = json_decode($response->getBody());

        $this->setToken($response->access_token);

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

        // cached ?
        if ( $product = get_transient( 'erudus_product_' . $erudusId ) ) {
            return $product;
        }

        try {

            $client = new Client(
                [
                    'headers' =>
                        [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Bearer ' . $this->getToken()
                        ]
                ]);

            $response = $client->get(sprintf('%s/api/public/v1/products/%s?full=1', $this->baseUrl, $erudusId));

        } catch(\GuzzleHttp\Exception\BadResponseException $e) {

            return false;

        }

        $product = json_decode($response->getBody())->data;

        // cache token (tokens expire after one hour so say 50min)
        set_transient( 'erudus_product_' . $erudusId, $product,  DAY_IN_SECONDS );

        return $product;

    }


}