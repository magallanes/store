<?php 

/*

Template Name: Old Shop

*/ 

	global $wp_query;
	$id = $wp_query->get_queried_object_id();
	$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

	$enable_page_comments = false;
	if(get_post_meta($id, "qode_enable-page-comments", true) == 'yes') {
		$enable_page_comments = true;
	}

	if(get_post_meta($id, "qode_page_background_color", true) != ""){
		$background_color = get_post_meta($id, "qode_page_background_color", true);
	}else{
		$background_color = "";
	}

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }


	get_header();
?>

	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/flex/jquery.flexslider-min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/js/flex/flexslider.css">


<?php 

	if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)): ?>


	<script>
		var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
	</script>

	<?php endif; 

	get_template_part( 'title' );


	$revslider = get_post_meta($id, "qode_revolution-slider", true);


	if (!empty($revslider)): ?>

		<div class="q_slider">
			<div class="q_slider_inner">
				<?php echo do_shortcode($revslider); ?>
			</div>
		</div>

	<?php endif; ?>

<style type="text/css" media="screen">
	.dark:not(.sticky):not(.scrolled) nav.main_menu>ul>li>a, .dark:not(.sticky):not(.scrolled) nav.main_menu>ul>li.active>a, .dark:not(.sticky):not(.scrolled) nav.main_menu>ul>li:not(:first-child):before{
	color: #000;
}

</style>

<div class="full_width full_width_shop" <?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
	<div class="full_width_inner">

		<div class="vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">

			<div class="section_inner clearfix">


				 <?php

					$args = array(
					  'taxonomy'     => 'product_cat',
					  'orderby'      => 'name',
					  'show_count'   => 0,
					  'pad_counts'   => 0,
					  'hierarchical' => 1,
					  'title_li'     => '',
					  'hide_empty'   => 0
					);

					
					$all_categories = get_categories( $args );

					$arr_categories = array();

					foreach ($all_categories as $cat) {

					    $category_id = $cat->term_id;
					    
					    if($cat->category_parent == 0 && ($category_id == 76 || $category_id == 77 || $category_id == 75 ) ) {

					        $args = array( 
					        	'post_type' => 'product', 
					        	'posts_per_page' => -1, 
					        	'product_cat' => $cat->name
					        );


					        $arr_productos = array();


					        $loop = new WP_Query( $args );

					        while ( $loop->have_posts() ) : $loop->the_post(); 

					        	global $product; 

								$args_a = array(

									'post_type' => 'attachment',

									'numberposts' => -1,

									'post_parent' => $loop->post->ID

								);

								$arr_images = array();

								foreach ($product->get_gallery_attachment_ids() as $key => $attachment_id){

									$arr_images[] = wp_get_attachment_url( $attachment_id );

								}


							    $args_r = array ('post_type' => 'product', 'post_id' => $loop->post->ID);

							    $comments = get_comments( $args_r );


						      	$arr_productos[] = array(
						      		"id"			=> $loop->post->ID,
						      		"name" 			=> $loop->post->post_title,
						      		"slug"			=> $loop->post->post_name,
						      		"price"			=> get_post_meta( get_the_ID(), '_regular_price', TRUE),
						      		"reviews_link"	=> get_site_url().'/product/'.$loop->post->post_name,
						      		"image"			=> wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), 'full'),
						      		"images"		=> $arr_images,
						      		"reviews"		=> count($comments),
						      		"description"	=> preg_replace( "/\r|\n/", "", get_post_field('post_content', $loop->post->ID)),
						      		"is_in_stock"	=> $product->is_in_stock(),
						      		"stock_status"	=> get_post_meta( get_the_ID(), '_stock_status', TRUE)
						      	);


						    endwhile;

						    wp_reset_query();

				        	$arr_categories[] = array(
				        		"name" 			=> $cat->name,
				        		"link" 			=> get_term_link($cat->slug, 'product_cat'),
				        		"slug" 			=> $cat->slug,
				        		'products'		=> $arr_productos
				        	);


					    }     

					}



				?>

<!-- 
				<div class="mail-div">
                	<div class="left-text">
                    	<span>Products will be available online and in stores summer 2015.</span>
                    </div>
                    <div class="mail-form">

    <form action="#" method="post" id="mc-embedded-subscribe-form-1" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

	<input class="input-field" type="email" id="mc4wp_email_1" name="EMAIL" placeholder="Enter Your Email for Updates..." required />

	<input class="button" type="submit" value="Subscribe" />

    </form>
    
    <div style="display:none;color:#0F0;" id="success">Thank You! To complete the subscription process, please click the link in the email we just sent you. </div>

    <div style="display:none;color:#F00;" id="error">Sorry. Unable to subscribe. Please try again later.</div>

    <div style="display:none;color:#F00;" id="server-error">Sorry. Unable to subscribe. Please try again later.</div>
                    </div>
               </div>

                -->
				<!-- Product shop -->

				<div class="product-shop" style="background: url(<?php if ( count($arr_categories) > 0 ): ?>
														
							<?php if ( count( $arr_categories[0]["products"] ) ): ?>

								<?php echo $arr_categories[0]["products"][0]["image"][0]; ?>

							<?php endif; ?>

						<?php endif; ?>) no-repeat -167px 50px;">
										



					<?php if ( count($arr_categories) > 0 ): ?>

						<?php if ( count( $arr_categories[0]["products"] ) ): ?>

							<img class="product-img" src="<?php echo $arr_categories[0]["products"][0]["image"][0]; ?>" alt="<?php echo $arr_categories[0]["products"][0]["name"]; ?>">

						<?php endif; ?>

					<?php endif; ?>
                    






					<div class="old-shop-cont">
						
						<a href="<?php echo get_site_url(); ?>/all-products">View all products</a>

					</div>
                    
                    <div class="products-titles">
						<div class="p-title">Series</div>
                        <div class="p-title">Color</div>
                        <div class="p-title p-title-last">Quantity</div>
					</div>



					<div class="select-products-cont">



					 

						<select class="select-2 select-categories">

							<?php foreach ($arr_categories as $key => $category): ?>

								<option value="<?php echo $key; ?>"><?php echo $category['name']; ?></option>

							<?php endforeach; ?>

						</select>



						 

						<select class="select-2 select-products">

							<?php if ( count($arr_categories) > 0 ): ?>

								<?php foreach ($arr_categories[0]["products"] as $key => $product): ?>

									<option value="<?php echo $key; ?>"><?php echo $product['name']; ?></option>

								<?php endforeach; ?>

							<?php endif; ?>

						</select>



						 

						<select class="select-2 select-quantity">

							<?php for ($i = 1; $i < 16; $i++): ?>

								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>

							<?php endfor; ?>

						</select>




						<?php if ( count($arr_categories) > 0 ): ?>

							<?php if ( count( $arr_categories[0]["products"] ) ): ?>

								<div class="price-cont">
									<p>Price:</p>
									<span data-price="<?php echo $arr_categories[0]["products"][0]["price"]; ?>">$<?php echo $arr_categories[0]["products"][0]["price"]; ?></span>
								</div>


								<button type="submit" data-quantity="1" data-product_id="<?php echo $arr_categories[0]["products"][0]["id"]; ?>" class="button alt add_to_cart_button product_type_simple">
								   	Add to Cart
								</button>


							<?php endif; ?>

						<?php endif; ?>





					</div>



					<div class="product-details-cont">

						<div class="col">



							<?php if ( count($arr_categories) > 0 ): ?>



								<?php if ( count( $arr_categories[0]["products"] ) ): ?>

									<p class="product-description"><?php echo $arr_categories[0]["products"][0]["description"]; ?></p>

								<?php endif; ?>



								<?php if ( count( $arr_categories[0]["products"] ) ): ?>


									<img class="alignnone size-full wp-image-1085 chart" src="<?php echo get_stylesheet_directory_uri(); ?>/img/autodip_shop_coveragechart.png" alt="PNGShop" width="300" height="231">


								<?php endif; ?>



							<?php endif; ?>





							

						</div>

						<div class="col">

							

							<a href="<?php echo get_site_url(); ?>/cart" class="btn-checkout">checkout</a>

						</div>

					</div>





				</div>

				<!-- Product shop -->







			</div>



		</div>



	</div>

</div>





	<div class="slider-cont">

		<div class="flexslider">



			<ul class="slides">



			<?php if ( count($arr_categories) > 0 ): ?>

				<?php if ( count( $arr_categories[0]["products"] ) ): ?>

					<?php  foreach ($arr_categories[0]["products"][0]["images"] as $key => $image): ?>

						<li><img src="<?php echo $image; ?>" /></li>

					<?php endforeach; ?>

				<?php endif; ?>

			<?php endif; ?>

			</ul>

		</div>



	</div>



</div>

</div>	

<script type="text/javascript">



	jQuery(window).load(function() {



		jQuery('.full_width_shop').addClass('show');



	});



	jQuery(document).ready(function() {



		var data = JSON.stringify(eval('(<?php echo json_encode($arr_categories); ?>)'));	

		var arr_data = jQuery.parseJSON(data);





		jQuery('.flexslider').flexslider({

			animation: "slide",

			prevText: "",

			nextText: ""

		});



		/* when product quantity changes, update quantity attribute on add-to-cart button */

		jQuery("form.cart").on("change", "input.qty", function() {

		    if (this.value === "0")

		        this.value = "1";

		 

		    jQuery(this.form).find("button[data-quantity]").attr("data-quantity", this.value);



		});





		jQuery(".select-quantity").select2({

	       placeholder: "Quantity",

	       allowClear: true

	    });

		

		jQuery(".select-products").select2({

	       placeholder: "Product"

	    });



		jQuery(".select-categories").select2({

			placeholder: "Category"

	    });







		jQuery('.go-to-slider').on('click', function(event) {

			event.preventDefault();



			jQuery('html,body').animate({scrollTop: jQuery('.flexslider').offset().top},'slow');



		});





		jQuery('select.select-categories').on('change', function(event) {

			event.preventDefault();



			var selected = jQuery(this).val();

			var options = "";



			jQuery('select.select-products option').remove();

			jQuery('select.select-products').select2("val", "").trigger('change');



			for (var i = 0; i < arr_data[selected].products.length; i++) {

				options+= '<option value="'+i+'">'+arr_data[selected].products[i].name+'</option>';

			};



			jQuery('select.select-products').append(options);



			jQuery('.product-shop').css('background','none');

			jQuery('.product-img').animate({'opacity':0},500);





			jQuery('.slider-cont').addClass('hide').css('height', jQuery('.slider-cont').height());



			jQuery('.price-cont span').html( "$0.00" );

			jQuery('.add_to_cart_button').attr('disabled', 'disabled');



			jQuery(".select-products").select2("val", 0).trigger('change');



		});





		jQuery('select.select-quantity').on('change', function(event){



			var quantity = jQuery(this).val();

			var total = Math.round( (jQuery('.price-cont span').data('price') * quantity) *100 ) /100;



			jQuery('.price-cont span').html( "$" + total );

			jQuery('.add_to_cart_button').attr('data-quantity', quantity);



		});





		jQuery('select.select-products').on('change', function(event) {

			event.preventDefault();



			var cat_selected = jQuery('select.select-categories').val();

			var prod_selected = jQuery(this).val() || 0;



			jQuery('.price-cont span').html( "$"+arr_data[cat_selected].products[prod_selected].price ).data('price', arr_data[cat_selected].products[prod_selected].price);

			jQuery('.product-shop').css('background','url("'+arr_data[cat_selected].products[prod_selected].image[0]+'") no-repeat -167px 50px');

			jQuery('.product-img').attr('src', arr_data[cat_selected].products[prod_selected].image[0]).animate({'opacity':1},500);

			jQuery('.product-description').html(arr_data[cat_selected].products[prod_selected].description);

			jQuery('.reviews-link').attr("href", arr_data[cat_selected].products[prod_selected].reviews_link);





			jQuery('.product-img').attr('src', arr_data[cat_selected].products[prod_selected].image[0]).animate({'opacity':1},500);



			jQuery('select.select-quantity').val('1').trigger('change');





			var newslider = '<ul class="slides">';



			for (var i = 0; i < arr_data[cat_selected].products[prod_selected].images.length; i++) {

				newslider += '<li><img src="'+arr_data[cat_selected].products[prod_selected].images[i]+'" /></li>'; 

			};



			newslider += "</ul>";



			jQuery('.slider-cont').addClass('hide').css('height', jQuery('.slider-cont').height());



			setTimeout(function(){ 

				jQuery('.flexslider').removeData("flexslider").html(newslider).flexslider({

					animation: "slide",

					prevText: "",

					nextText: "",

					start: function(){

						jQuery('.slider-cont').removeClass('hide').css('height', 'auto');

					}

				});

			},500);





			jQuery('.button.add_to_cart_button.product_type_simple').attr('data-product_id', arr_data[cat_selected].products[prod_selected].id);

			jQuery('.add_to_cart_button').removeAttr('disabled');





		});







	});
	
	





</script>



<?php get_footer(); ?>