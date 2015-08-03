<?php
/**
 * In-Stock Notification Emails
 *
 * @author		Bolder Elements
 * @package 	WooCommerce-Bolder-Stock-Alerts/Templates/Emails
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<?php do_action( 'woocommerce_email_before_stock_notification', $product, $sent_to_admin, $plain_text ); ?>

<p><strong><?php _e('Good News!', 'bolder-stock-alerts-woo'); ?></strong></p>
<p><?php _e('You have been waiting patiently and now it is finally here...', 'bolder-stock-alerts-woo'); ?></p>

<div style="margin:15px auto;text-align:center">
	<div class="product_image"><?php echo $product->get_image( 'shop_catalog' ); ?></div>
	<div class="product_title"><?php echo $product->get_title(); ?></div>
	<div class="product_price"><?php echo $product->get_price_html(); ?></div>
</div>

<p><?php _e('The much loved', 'bolder-stock-alerts-woo'); ?> <a href="<?php echo $product->get_permalink(); ?>"><?php echo $product->get_title(); ?></a> <?php _e('is now back in stock! Quantities are still limited so hurry and pick one up today before it runs out again!', 'bolder-stock-alerts-woo'); ?></p>

<p><?php _e('Happy Shopping,', 'bolder-stock-alerts-woo'); ?><br />
<?php echo bloginfo('name'); ?></p>

<?php do_action( 'woocommerce_email_after_stock_notification', $product, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>