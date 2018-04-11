<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class Erudus_Admin {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;


    /**
     * Start up
     */
    public function __construct()
    {
        // Set class property
        $this->options = get_option( 'erudus_options' );

        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
        add_action( 'admin_notices', array( $this,'admin_notice' ));
    }

    /**
     * Add options page
     */
    public function add_options_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin',
            'Erudus One',
            'manage_options',
            'erudus-one-admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'erudus_options' );
        ?>
        <div class="wrap">
            <h1>Erudus One Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'erudus_options_group' );
                do_settings_sections( 'erudus-one-admin' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'erudus_options_group', // Option group
            'erudus_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'erudus-one', // ID
            'Setup', // Title
            array( $this, 'print_section_info' ), // Callback
            'erudus-one-admin' // Page
        );

        add_settings_field(
            'erudus_client_key', // secret key
            'Erudus API Client Key', // Title
            array( $this, 'erudus_client_key_callback' ), // Callback
            'erudus-one-admin', // Page
            'erudus-one' // Section
        );

        add_settings_field(
            'erudus_client_secret', // secret key
            'Erudus API Client Secret', // Title
            array( $this, 'erudus_client_secret_callback' ), // Callback
            'erudus-one-admin', // Page
            'erudus-one' // Section
        );

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     * @return array
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['erudus_client_key'] ) )
            $new_input['erudus_client_key'] = sanitize_text_field( $input['erudus_client_key'] );

        if( isset( $input['erudus_client_secret'] ) )
            $new_input['erudus_client_secret'] = sanitize_text_field( $input['erudus_client_secret'] );

        // try new keys
        $client = new Erudus_Api(  $input['erudus_client_key'], $input['erudus_client_secret']);

        if( $client->newAccessToken() == false)
            add_settings_error('erudus_options_notice', 'erudus_options_notice', 'Unable to access API with these credentials.', 'error');

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Please enter you Erudus PUBLIC API key and secret.';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function erudus_client_key_callback()
    {
        printf(
            '<input type="text" id="erudus_client_key" name="erudus_options[erudus_client_key]" value="%s" class="regular-text"/>',
            isset( $this->options['erudus_client_key'] ) ? esc_attr( $this->options['erudus_client_key']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function erudus_client_secret_callback()
    {
        printf(
            '<input type="text" id="erudus_client_secret" name="erudus_options[erudus_client_secret]" value="%s" class="regular-text"/>',
            isset( $this->options['erudus_client_secret'] ) ? esc_attr( $this->options['erudus_client_secret']) : ''
        );
    }

    /**
     * Notice to enter client credentials
     */
    public function admin_notice(){

        if( !($this->options['erudus_client_key'] && $this->options['erudus_client_secret']) )
        {
            echo '<div class="notice notice-error is-dismissible">';
            echo '<p>Please enter your Erudus API keys in the <a href="'.admin_url('options-general.php?page=erudus-one-admin').'" title="Erudus One Settings" >Erudus One settings page</a>.</p>';
            echo '</div>';
        }

    }


}