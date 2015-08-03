<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


?>




	<?php wc_print_notices(); ?>

	<p class="order-info"><?php printf( __( 'Order #<mark class="order-number">%s</mark> was placed on <mark class="order-date">%s</mark> and is currently <mark class="order-status">%s</mark>.', 'woocommerce' ), $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), wc_get_order_status_name( $order->get_status() ) ); ?></p>

	<h2>Tracking Information</h2>
	<table class="shop_table order_details"> 
		<tbody> 
			<tr class="order_item"> 
				<td style="color: #000"> 
					Order Status:
				</td> 
				<td style="color: #000; text-transform: capitalize"> 
					<?php
						$terms = wp_get_object_terms( $order->get_order_number(), 'shipwire_order_status', array( 'fields' => 'slugs' ) );
						echo ( isset( $terms[0] ) ) ? str_replace( 'wc_shipwire_', '', $terms[0] ) : 'new'; 
					?>
				</td> 
			</tr> 
			<tr class="order_item"> 
				<td style="color: #000"> 
					Tracking Number:
				</td> 
				<td class="product-total"> 
					<a target="_blank" href="<?php echo get_post_meta($order->get_order_number(), '_wc_shipwire_tracking_href', true); ?>"><?php echo get_post_meta($order->get_order_number(), '_wc_shipwire_tracking_number', true); ?></a>
				</td> 
			</tr> 
			<tr class="order_item"> 
				<td style="color: #000"> 
					Expected delivery date:
				</td> 
				<td class="product-total"> 
					<?php echo date('F j, Y', strtotime(get_post_meta($order->get_order_number(), '_wc_shipwire_expected_delivery_date', true))); ?>
				</td> 
			</tr> 
			<tr class="order_item"> 
				<td style="color: #000"> 
					Ship via:
				</td> 
				<td class="product-total"> 
					<?php echo get_post_meta($order->get_order_number(), '_wc_shipwire_shipper_full_name', true); ?>
				</td> 
			</tr> 
			<tr class="order_item"> 
				<td style="color: #000"> 
					Carrier:
				</td> 
				<td class="product-total"> 
					<?php echo get_post_meta($order->get_order_number(), '_wc_shipwire_carrier', true); ?>
				</td> 
			</tr> 
		</tbody> 
	</table>



	<?php if ( $notes = $order->get_customer_order_notes() ) :
		?>
		<h2><?php _e( 'Order Updates', 'woocommerce' ); ?></h2>
		<ol class="commentlist notes">
			<?php foreach ( $notes as $note ) : ?>
			<li class="comment note">
				<div class="comment_container">
					<div class="comment-text">
						<p class="meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
						<div class="description">
							<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
						</div>
		  				<div class="clear"></div>
		  			</div>
					<div class="clear"></div>
				</div>
			</li>
			<?php endforeach; ?>
		</ol>
		<?php
	endif;

	do_action( 'woocommerce_view_order', $order_id );


