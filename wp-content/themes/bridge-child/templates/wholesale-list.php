<?php 
/*
Template Name: Wholesale Product List
*/ 

get_header();


	$user_ID = get_current_user_id(); 


	if ( !empty($user_ID) ){
		$user_data = get_userdata( $user_ID );
	}

	define('DONOTCACHEPAGE', true);
	define('DONOTCACHEDB', true);
	define('DONOTMINIFY', true);
	define('DONOTCDN', true);
	define('DONOTCACHCEOBJECT', true);

?>


<?php if ( !empty($user_ID) && in_array('wholesale_customer', $user_data->roles) ){  ?>




<div class="separator  transparent center  " style="margin-top: 40px;margin-bottom: 20px;opacity: 0;"></div>

<div class="full_width wholesale-template">
	<div class="full_width_inner">
		<div class="vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">
			<div class=" section_inner clearfix">
				<div class="woocommerce section_inner_margin clearfix">
			
					<div class="vc_col-sm-12 wpb_column vc_column_container" style="color:#000000;">
						
						<div class="wpb_wrapper">

							<div class="separator  transparent center  " style="margin-top: 40px;margin-bottom: 20px;opacity: 0;"></div>

							<?php if ( !empty($_GET['subscribe-alerts']) && $_GET['subscribe-alerts'] == 'true' ): ?>  
							<div class="message success">Thank you! We will notify you when your item is back in stock.</div>
							<?php endif; ?>
							<?php if ( !empty($_GET['subscribe-alerts']) && $_GET['subscribe-alerts'] == 'false' && empty($_GET['error']) ): ?>  
							<div class="message success">Thank you! We will notify you when your item is back in stock.</div>
							<?php endif; ?>
							<?php if ( !empty($_GET['subscribe-alerts']) && $_GET['subscribe-alerts'] == 'false' && !empty($_GET['error']) ): ?>  
							<div class="message error">Error. Please try again.</div>
							<?php endif; ?>
							
							<div class="separator  transparent center  " style="margin-top: 40px;margin-bottom: 20px;opacity: 0;"></div>


							<div class="btns-account">
								<a class="button" href="<?php echo wp_logout_url( get_permalink() ); ?>">Logout</a>
								<a class="button" href="<?php echo get_permalink(17558); ?>">Media</a>
							 	<a class="button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>">View my account</a>
						 	</div>


							<h1 style="text-align: left;"><span style="color: #1b1919;">WHOLESALE ORDER</span></h1>
							<p>View your most recent orders and tracking numbers in my account.</p>

							<div class="separator  transparent center  " style="margin-top: 40px;margin-bottom: 20px;opacity: 0;"></div>

							<div class="woocommerce-cart">

								<form action="http://www.autodip.com/cart/" method="post">
											


								<?php

									// $className = 'WC_Geolocation_Based_Products_Frontend';
									// $country = $className::get_location_data();


									// $user_info = file_get_contents('https://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
									// $user_info = json_decode($user_info);



									function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
									    $output = NULL;
									    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
									        $ip = $_SERVER["REMOTE_ADDR"];
									        if ($deep_detect) {
									            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
									                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
									            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
									                $ip = $_SERVER['HTTP_CLIENT_IP'];
									        }
									    }
									    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
									    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
									    $continents = array(
									        "AF" => "Africa",
									        "AN" => "Antarctica",
									        "AS" => "Asia",
									        "EU" => "Europe",
									        "OC" => "Australia (Oceania)",
									        "NA" => "North America",
									        "SA" => "South America"
									    );
									    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
									        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
									        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
									            switch ($purpose) {
									                case "location":
									                    $output = array(
									                        "city"           => @$ipdat->geoplugin_city,
									                        "state"          => @$ipdat->geoplugin_regionName,
									                        "country"        => @$ipdat->geoplugin_countryName,
									                        "country_code"   => @$ipdat->geoplugin_countryCode,
									                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
									                        "continent_code" => @$ipdat->geoplugin_continentCode
									                    );
									                    break;
									                case "address":
									                    $address = array($ipdat->geoplugin_countryName);
									                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
									                        $address[] = $ipdat->geoplugin_regionName;
									                    if (@strlen($ipdat->geoplugin_city) >= 1)
									                        $address[] = $ipdat->geoplugin_city;
									                    $output = implode(", ", array_reverse($address));
									                    break;
									                case "city":
									                    $output = @$ipdat->geoplugin_city;
									                    break;
									                case "state":
									                    $output = @$ipdat->geoplugin_regionName;
									                    break;
									                case "region":
									                    $output = @$ipdat->geoplugin_regionName;
									                    break;
									                case "country":
									                    $output = @$ipdat->geoplugin_countryName;
									                    break;
									                case "countrycode":
									                    $output = @$ipdat->geoplugin_countryCode;
									                    break;
									            }
									        }
									    }
									    return $output;
									}

								    if ( ip_info("Visitor", "Country Code") == "CA" ){
								    	$price_type = '_ca_price';
								    	$cat_type = 'products-ca';
								    }else{
								    	$price_type = '_us_price';
								    	$cat_type = 'products-us';
								    }


									$args = array(
										'post_type' => 'product',
										'posts_per_page' => -1,
										'meta_query' => array(
											array(
												'key' => $price_type,
												'value' => '',
												'compare' => '!='
											)
										),
										'tax_query' => array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'product_cat',
												'field'    => 'slug',
												'terms'    => array( 'wholesale' ),
												'operator' => 'IN'
											),
											array(
												'taxonomy' => 'product_cat',
												'field'    => 'slug',
												'terms'    => array( $cat_type ),
												'operator' => 'IN'
											),
										)
									);
									$loop = new WP_Query( $args );
									if ( $loop->have_posts() ) { ?>



										<table id="products" class="shop_table cart responsive-table" cellspacing="0">
											<thead>
												<tr>
													<th scope="col" class="product-thumbnail">&nbsp;</th>
													<th scope="col" class="product-name">Product</th>
													<th scope="col" class="product-sku">Series</th>
													<th scope="col" class="product-msrp">MAP</th>
													<th scope="col" class="product-cost">Cost</th>
													<th scope="col" class="product-inventory">Inventory</th>
													<th scope="col" class="product-quantity">Quantity</th>
													<th scope="col" class="product-subtotal">Subtotal</th>
													<th scope="col" class="product-addtocart"></th>
												</tr>
											</thead>
											<tbody>



												<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>


													<tr class="cart_item">

														<td scope="row" class="product-thumbnail">
															<a href="<?php echo the_permalink(); ?>">
																<?php the_post_thumbnail(); ?>
															</a>					
														</td>

														<td data-title="Product" class="product-name">
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>					
														</td>

														<td  data-title="Serie" class="product-serie">
															<span class="amount"><?php echo get_field('category')->name; ?></span>
														</td>

														<td  data-title="Cost" class="product-cost">
															<span class="amount">$<?php echo the_field('_regular_price'); ?></span>					
														</td>

														<td data-title="MSRP" class="product-msrp">
															<span class="amount">$<?php echo the_field($price_type); ?></span>					
														</td>

														<td data-title="Inventory" class="product-inventory">
															<span class="amount"><?php echo get_field('_stock_status') == "instock" ? "<span style='color: #60D86F;'>IN STOCK</span>" : "<span style='color: red;'>OUT OF STOCK</span>"; ?></span>					
														</td>
													
														<td data-title="Quantity" class="product-quantity">
															<div class="quantity buttons_added">
																<input type="button" value="-" class="minus">
																<input type="text" step="1" min="1" data-wholesale="<?php echo the_field($price_type); ?>" name="cart[6f3e9169e4fcfbe4a52606c013348650][qty]" value="1" title="Qty" class="input-text qty text" size="4">
																<input type="button" value="+" class="plus">
															</div>
														</td>

														<td data-title="Subtotal" class="product-subtotal">
															$<span class="amount"><?php echo the_field($price_type); ?></span>					
														</td>

														<td class="product-addtocart">
															<span class="amount">
															<?php if ( get_field('_stock_status') == "instock" ):  ?>
																<button type="submit" data-quantity="1" data-product_id="<?php the_ID(); ?>" class="button alt add_to_cart_button product_type_simple">Add to Cart</button>
															<?php else: ?>
																<?php 
																	$className = 'BE_Bolder_Stock_Alerts';
																	$className::process_email_form_custom();
																	$className::add_email_form_custom(get_the_ID(), 'simple');
																?>
															<?php endif; ?>
															</span>					
														</td>
															
													</tr>

													<tr></tr>


											<?php endwhile; ?>
											

											</tbody>
										</table>


										<?php

											} else {
												echo __( 'No products found' );
											}
											wp_reset_postdata();
										?>


								</form>

							</div>

							<div class="separator  transparent center  " style="margin-top: 40px;margin-bottom: 20px;opacity: 0;"></div>

							<div class="separator  transparent center  " style="margin-top: 100px;margin-bottom: 20px;opacity: 0;"></div>




						</div>

					</div>									
															
				</div>
			</div>
		</div>

	</div>
</div>



<div class="cart-collaterals sticky grid_section">

	<div class="section_inner">

		<div class="cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

			<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<?php /*
			<table cellspacing="0">
	*/ ?>
				<div class="cart-subtotal">
					<th><?php _e( 'Subtotal', 'woocommerce' ); ?>:&nbsp;&nbsp;&nbsp;</th>
					<td><?php wc_cart_totals_subtotal_html(); ?></td>
				</div>
	<?php /*
				<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
						<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
						<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

					<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

				<?php elseif ( WC()->cart->needs_shipping() ) : ?>

					<tr class="shipping">
						<th><?php _e( 'Shipping', 'woocommerce' ); ?></th>
						<td><?php woocommerce_shipping_calculator(); ?></td>
					</tr>

				<?php endif; ?>

				<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<tr class="fee">
						<th><?php echo esc_html( $fee->name ); ?></th>
						<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
					<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
						<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
							<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
								<th><?php echo esc_html( $tax->label ); ?></th>
								<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr class="tax-total">
							<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
							<td><?php echo wc_cart_totals_taxes_total_html(); ?></td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>

				<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<tr class="order-total">
				<?php 

					ob_start();
					wc_cart_totals_subtotal_html();
					$subtotal = ob_get_contents();
					ob_end_clean();

					$subtotal = preg_replace("/<span[^>]+\>/i", "", $subtotal);
					$subtotal = substr($subtotal, 5);
					$subtotal = str_replace(',', '', $subtotal );


					$tax = str_replace('&#036;', '', wp_kses_post( $tax->formatted_amount ) );
					$tax = preg_replace("/<span[^>]+\>/i", "", $tax);
					$tax = str_replace(',', '', $tax );

														
				?>
					<th><?php _e( 'Total', 'woocommerce' ); ?></th>
					<td><strong>&#036;<span class="amount"><?php echo floatval($tax) + floatval($subtotal); ?></span></strong></td>
				</tr>

				<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

			</table>
			<?php if ( WC()->cart->get_cart_tax() ) : ?>
				<p><small><?php

					$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
						? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
						: '';

					printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

				?></small></p>
			<?php endif; ?>

			<div class="wc-proceed-to-checkout">

				<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

			</div> 

			*/ ?>

			<?php do_action( 'woocommerce_after_cart_totals' ); ?>

			<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button view-cart">Cart <i class="fa fa-shopping-cart"></i></a>
			<a href="<?php echo $woocommerce->cart->get_checkout_url() ?>" class="button" title="<?php echo __( 'Checkout' ); ?>">Proceed to checkout</a>

		</div>

	</div>

</div>


<style type="text/css" media="screen">

	footer{
		display: none;
	}
	
</style>

<script type="text/javascript">
	
	$(document).ready(function() {
		

		/* when product quantity changes, update quantity attribute on add-to-cart button */

		jQuery("body").on("change", ".product-quantity input.qty", function() {

 		    jQuery(this.form).find("button[data-quantity]").attr("data-quantity", this.value);

 		    var tnum = parseFloat(this.value) * parseFloat(jQuery(this).data('wholesale'));
 		    var total = tnum.toFixed(2);

		    jQuery(this).parents('.product-quantity').next().find('.amount').html(total);

		});


	});


</script>
	

<?php }else if ( !empty($user_ID) && in_array('wholesale_pending', $user_data->roles) ){ ?>



<div class="q_slider">
	<div class="q_slider_inner">
		<div id="qode-become-a-dealer" class="carousel slide   responsive_height q_auto_start   header_not_transparent" data-slide_animation="6000" data-height="500" data-parallax="yes" style="height: 500px;">
			<div class="qode_slider_preloader" style="height: 500px; display: none;">
				<div class="ajax_loader" style="display: block;">
					<div class="ajax_loader_1">
						<div class="pulse"></div>
					</div>
				</div>
			</div>
			<div class="carousel-inner skrollable skrollable-between" data-start="transform: translateY(0px);" data-1440="transform: translateY(-500px);" style="-webkit-transform: translateY(0px); transform: translateY(0px);">
				<div class="item  active" style="height: 500px;">
					<div class="image" style="background-image:url(http://autodip.com/wp-content/uploads/2014/10/become_a_dealer.jpg);">
						<img src="http://autodip.com/wp-content/uploads/2014/10/become_a_dealer.jpg" alt="Become a Dealer">
					</div>
					<div class="slider_content_outer">
						<div class="slider_content skrollable skrollable-between" style="width: 50%; left: 25%; top: 40%; opacity: 1;" data-start="width:50%; opacity:1; left: 25%; top:40%;" data-300="opacity: 0; left: 25%; top:30%;">
							<div class="text all_at_once no_subtitle no_separator">
								<h2 class="" style=""><span style="">Wholesale</span></h2>
								<p style=""><span></span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>

<div class="full_width  wholesale-template woocommerce">
	<div class="full_width_inner">
		<div class="vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">
			<div class=" section_inner clearfix">
				<div class="section_inner_margin clearfix">
			
					<div class="vc_col-sm-12 wpb_column vc_column_container" style="color:#000000;">
						
						<div class="wpb_wrapper">

							<div class="separator  transparent center  " style="margin-top: 10px;"></div>
					
							<div class="separator  transparent center  " style="margin-top: 40px;margin-bottom: 20px;opacity: 0;"></div>


							<div class="btns-account">
								<a class="button" href="<?php echo wp_logout_url( get_permalink() ); ?>">Logout</a>
							 	<a class="button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>">View my account</a>
						 	</div>

							<div class="wpb_text_column wpb_content_element ">
								<div class="wpb_wrapper">

									<h2>Your request was sent successfully!</h2>

									<p>You should receive a message from us in the next 1-2 business days to let you know if you are approved.</p>

								</div> 
							</div> 

							<div class="separator  transparent center  " style="margin-top: 10px;"></div>

							<div class="separator  transparent center  " style="margin-top: 20px;margin-bottom: 20px;"></div>
							
							<div class="separator  transparent center  " style="margin-top: 20px;margin-bottom: 20px;"></div>


						</div>

					</div>									
															
				</div>
			</div>
		</div>

	</div>
</div>

<style type="text/css" media="screen">

.dark:not(.sticky):not(.scrolled) nav.main_menu>ul>li>a{
	color: #fff !important;
}

body .shopping_cart_header .header_cart {
  background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/css/img/header_shopping_bag_white.png') !important;
}

body header.dark:not(.sticky):not(.scrolled) .shopping_cart_header .header_cart span{
	color: #000;
}

</style>



<?php }else{ ?>


<div class="separator  transparent center  " style="margin-top: 60px;margin-bottom: 20px;opacity: 0;"></div>


<div class="full_width wholesale-template">
	<div class="full_width_inner">
		<div class="vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">
			<div class=" section_inner clearfix">
				<div class="section_inner_margin clearfix">
			
					<div class="vc_col-sm-12 wpb_column vc_column_container" style="color:#000000;">
						
						<div class="wpb_wrapper">

							<div class="separator  transparent center  " style="margin-top: 60px;"></div>

							<h2>Login</h2>	

							<div class="separator  transparent center  " style="margin-top: 10px;"></div>


							<?php $args = array(
							        'echo'           => true,
							        'redirect'       => site_url( $_SERVER['REQUEST_URI'] ), 
							        'form_id'        => 'loginform',
							        'label_username' => __( 'Username' ),
							        'label_password' => __( 'Password' ),
							        'label_remember' => __( 'Remember Me' ),
							        'label_log_in'   => __( 'Log In' ),
							        'id_username'    => 'user_login',
							        'id_password'    => 'user_pass',
							        'id_remember'    => 'rememberme',
							        'id_submit'      => 'wp-submit',
							        'remember'       => true,
							        'value_username' => NULL,
							        'value_remember' => false
							); 

							wp_login_form( $args ); ?> 

					
							<div class="separator  transparent center  " style="margin-top: 40px;margin-bottom: 20px;opacity: 0;"></div>

							<div class="wpb_text_column wpb_content_element ">
								<div class="wpb_wrapper">
									<h2>NEW ACCOUNT APPLICATION</h2>
									<p><strong>Thank you for your interest in Autodip and wanting to be a part of our mission; to bring innovative premium peelable paint products to automotive communities worldwide.</strong></p>
									<p>Autodip is dedicated to providing extensive support and flexible supplying options to its retail partners. By ordering directly through Autodip’s direct wholesale program, retailers will benefit from using an online ordering platform with live inventory, shipment within 24 hours, no minimum order requirements, direct manufacturer support and wholesale pricing. Our warehouses are strategically located in Toronto, Philadelphia and Los Angeles to support our partners nation-wide. We currently offer two partner programs.</p><br>
									<h3>AUTODIP CERTIFIED DEALER</h3>
									<p>Autodip’s certified dealer program was created for dealerships, shops, parts stores, etc. By being part of the program, Autodip certified dealers will be listed in our certified retail directory, have access to the complete line of Autodip aerosol and maintenance products as well as exclusive merchandise and point-of-sale marketing material. </p><br>
										<h3>AUTODIP CERTIFIED INSTALLER</h3>
										<p>Autodip’s certified installer program was created for professional paint shops. By being part of the program, installers will have exclusive access to the Autodip Professional Series’ ready-to-spray gallons, exclusive market territories, direct manufacturer support, exclusive colours and finishes and benefit from leads generated from our advertising program.</p><br>
												<h3>APPLY</h3>
													<p>To apply to become a certified installer or a retail partner, submit the following form and a representative will contact you shortly.</p>

								</div> 
							</div> 

							<div class="separator  transparent center  " style="margin-top: 10px;"></div>

							<div class="separator  transparent center  " style="margin-top: 20px;margin-bottom: 20px;"></div>
							
							<?php echo do_shortcode('[contact-form-7 id="17140" title="Untitled"]'); ?>

							<script type="text/javascript">

								$(document).ready(function(){
			

									$('[type="file"]').each(function(index, el) {


										$(el).on('change', function() {
									        var filename = $(this).val();
									        $(el).next('.file').val('Image: '+filename);
									    });

										file = '<input type="text" class="file wpcf7-form-control wpcf7-text" value="Select image">';

										$(file).on('click', function(event) {
											event.preventDefault();

											$(this).prev().trigger('click');

										}).on('focus', function(event) {
											event.preventDefault();

											$(this).blur();

										}).insertAfter($(el));

										
									});

								})

							</script>

							<div class="separator  transparent center  " style="margin-top: 20px;margin-bottom: 20px;"></div>


						</div>

					</div>									
															
				</div>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function() {

		var states_text = '<?php $array = new WC_Countries; echo json_encode($array->get_states()); ?>';
		var states = eval ("(" + states_text + ")");


		$('[name="country"]').on('change', function(event) {
			event.preventDefault();

			var country_code = $('[name="country"]').val();
			var options = "";


			if (typeof states[country_code] == "undefined"){
				options = "<option value>---</option>";
			}else{

				for (var key in states[country_code]) {
				  if (states[country_code].hasOwnProperty(key)) {
				    options += '<option value="'+key+'">'+states[country_code][key]+'</option>';
				  }
				}

			}


			$('[name="state"]').html(options);




		});

		<?php 
			$countries = $allowed_countries_raw = get_option( 'woocommerce_specific_allowed_countries' );
			$countries_names = (include get_template_directory().'/../../plugins/woocommerce/i18n/countries.php');

			foreach ($countries as $key => $country_code) { ?>


			    $('[name="country"]').append($('<option>', { 
			        value: '<?php echo $country_code; ?>',
			        text : '<?php echo $countries_names[$country_code]; ?>'
			    }));


		<?php
			}
		?>
	});


</script>


<?php } ?>




<style type="text/css" media="screen">


	.dark:not(.sticky):not(.scrolled) nav.main_menu>ul>li>a, .dark:not(.sticky):not(.scrolled) nav.main_menu>ul>li.active>a, .dark:not(.sticky):not(.scrolled) nav.main_menu>ul>li:not(:first-child):before{
		color: #000;
	}

	.blockUI.blockOverlay{
		opacity: 0 !important;
	}

	.added_to_cart{
		display: none !important;
	}

	.woocommerce table.cart tbody tr td img{
		width: 100%;
		display: block !important;
	}

	.shopping_cart_header .header_cart{
		background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/css/img/header_shopping_bag.png') !important;
	}

	header.dark:not(.sticky):not(.scrolled) .shopping_cart_header .header_cart span{
		color: #fff;
	}



@media (min-width: 48em) {

	.woocommerce table.cart tbody tr td img{
		width: 100px;
	}

}

@media (max-width: 1000px){

	.woocommerce{
		position: relative;
		top: -80px;
	}


}

@media (max-width: 48em) {

	.responsive-table tbody td.product-addtocart{
		text-align: center;
	}

	.woocommerce-cart table.cart tbody tr, .woocommerce-account table.my_account_orders tbody tr{
		border: 0;
	}

	.wholesale-template .woocommerce input[type='text']{
		max-width: 60px;
	}


	.btns-account a.button, .wholesale-template .shopping_cart_header .button{
		text-align: center;
		margin-bottom: 15px;
		display: block;
	}

	.shopping_cart_outer{
		float: none;
	}

	.woocommerce div.cart-collaterals div.cart_totals{
		width: 100%;
		float: none;
	}

}

.responsive-table {
  width: 100%;
  margin-bottom: 1.5em;
}
@media (min-width: 48em) {
  .responsive-table {
    font-size: .9em;
  }
}
@media (min-width: 62em) {
  .responsive-table {
    font-size: 1em;
  }
}
.responsive-table thead {
  position: absolute;
  clip: rect(1px 1px 1px 1px);
  /* IE6, IE7 */
  clip: rect(1px, 1px, 1px, 1px);
  padding: 0;
  border: 0;
  height: 1px;
  width: 1px;
  overflow: hidden;
}
@media (min-width: 48em) {
  .responsive-table thead {
    position: relative;
    clip: auto;
    height: auto;
    width: auto;
    overflow: auto;
  }
}
.responsive-table thead th {
  font-weight: normal;
  text-align: center;
  color: white;
}
.responsive-table thead th:first-of-type {
  text-align: left;
}
.responsive-table tbody,
.responsive-table tr,
.responsive-table th,
.responsive-table td {
  display: block;
  padding: 0;
  text-align: left;
  white-space: normal;
}
@media (min-width: 48em) {
  .responsive-table tr {
    display: table-row;
  }
}
.responsive-table th,
.responsive-table td {
  padding: .5em;
  vertical-align: middle;
}
@media (min-width: 30em) {
  .responsive-table th,
  .responsive-table td {
    padding: .75em .5em;
  }
}
@media (min-width: 48em) {
  .responsive-table th,
  .responsive-table td {
    display: table-cell;
    padding: .5em;
  }
}
@media (min-width: 62em) {
  .responsive-table th,
  .responsive-table td {
    padding: .75em .5em;
  }
}
@media (min-width: 75em) {
  .responsive-table th,
  .responsive-table td {
    padding: .75em;
  }
}
.responsive-table caption {
  margin-bottom: 1em;
  font-size: 1em;
  font-weight: bold;
  text-align: center;
}
@media (min-width: 48em) {
  .responsive-table caption {
    font-size: 1.5em;
  }
}
.responsive-table tfoot {
  font-size: .8em;
  font-style: italic;
}
@media (min-width: 62em) {
  .responsive-table tfoot {
    font-size: .9em;
  }
}
@media (min-width: 48em) {
  .responsive-table tbody {
    display: table-row-group;
  }
}
.responsive-table tbody tr {
  margin-bottom: 1em;
}
@media (min-width: 48em) {
  .responsive-table tbody tr {
    display: table-row;
    border-width: 1px;
  }
}
.responsive-table tbody tr:last-of-type {
  margin-bottom: 0;
}
@media (min-width: 48em) {
  .responsive-table tbody tr:nth-of-type(even) {
    background-color: rgba(94, 93, 82, 0.1);
  }
}
.responsive-table tbody th[scope="row"] {
  background-color: #1d96b2;
  color: white;
}
@media (min-width: 48em) {
  .responsive-table tbody th[scope="row"] {
    background-color: transparent;
    color: #5e5d52;
    text-align: left;
  }
}
.responsive-table tbody td {
  text-align: right;
}
@media (min-width: 30em) {
  .responsive-table tbody td {
  }
}
@media (min-width: 48em) {
  .responsive-table tbody td {
    text-align: center;
  }
}
.responsive-table tbody td[data-type=currency] {
  text-align: right;
}
.responsive-table tbody td[data-title]:before {
	content: attr(data-title);
	float: left;
	font-size: .8em;
	text-transform: uppercase;
	color: rgba(94, 93, 82, 0.75);
	font-weight: 700;
	color: #333;
}
@media (min-width: 30em) {
  .responsive-table tbody td[data-title]:before {
    font-size: .9em;
  }
}
@media (min-width: 48em) {
  .responsive-table tbody td[data-title]:before {
    content: none;
  }
}

	
</style>


<?php 

	get_footer();

?>