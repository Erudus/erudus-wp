=== Erudus One for WordPress ===
Contributors: livingos
Tags: comments, spam
Requires at least: 3.8
Tested up to: 3.9.5
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use Erudus product data inside of WordPress using the Erudus API.

== Description ==

This plugin uses the [Erudus](https://erudus.com) API to display and use product information in WordPress.

[Erudus](https://erudus.com) provides a trusted data source for thousands of food products. The Erudus data is sourced directly from food manufacturers and suppliers, giving you reliable data on allergens, nutrients and other important information about food products.

To use this plugin you will need Erudus API credentials.

= Shortcode =

To show a product specification, you can use the shortcode:

```[erudus-product id="eruduesproductid"]```

Simply find the product you need from erudus and replace the id attribute with the correct Erudus ID.

= Customisation =
To customise display of product information, copy  product.php found in the plugin's templates folder to a folder named erudus inside your theme and edit the file.

= Template Functions =
To further customise and use product data, you can use the template function erudus_get_product($erudus_id) to get product data for a product. This will return an object containing all fields found in the API.

Please note that product data is cached by the plugin for 24 hours. Fresh data is only requested when product data is needed.
 
== Installation ==

1. Upload plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enter your Erudus API client keys in Settings->Erudus One


== Frequently Asked Questions ==

= How often is product data updated? =
The plugin caches each product for 24 hours. After 24 hours it will request a fresh copy of data from Erudus.

== Screenshots ==



== Changelog ==

= 1.0 =
* Frist release.

