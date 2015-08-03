<?php 

/*

Template Name: Media

*/ 
	define('DONOTCACHEPAGE', true);
	define('DONOTCACHEDB', true);
	define('DONOTMINIFY', true);
	define('DONOTCDN', true);
	define('DONOTCACHCEOBJECT', true);
 
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
<?php 

	$user_ID = get_current_user_id(); 


	if ( !empty($user_ID) ){
		$user_data = get_userdata( $user_ID );
	}

	if ( !(!empty($user_ID) && in_array('wholesale_customer', $user_data->roles)) ){ 

		wp_redirect( get_page_link(17134) ); exit;

	} 

?>

<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
	<script>
	var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
	</script>
<?php } ?>
	<?php get_template_part( 'title' ); ?>
<?php
$revslider = get_post_meta($id, "qode_revolution-slider", true);
if (!empty($revslider)){ ?>
	<div class="q_slider"><div class="q_slider_inner">
	<?php echo do_shortcode($revslider); ?>
	</div></div>
<?php
}
?>


<div class="full_width" style="background-color:#ffffff"> 
	<div class="full_width_inner"> 
		<div class="vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">
			<div class=" section_inner clearfix">

				<div class="content-box">
										
					<?php

					// check if the repeater field has rows of data
					if( have_rows('list_box') ):

					 	// loop through the rows of data
					    while ( have_rows('list_box') ) : the_row(); ?>

			        		<div class="list-box">
								<h3><?php the_sub_field('title'); ?></h3>		
								<ul>

									<?php

									// check if the repeater field has rows of data
									if( have_rows('list') ):

									 	// loop through the rows of data
									    while ( have_rows('list') ) : the_row(); ?>

									        <li><a href="<?php echo wp_get_attachment_url(get_sub_field('file')); ?>" download="<?php the_sub_field('name'); ?>"><?php the_sub_field('name'); ?></a></li>

										<?php
									    endwhile;

									else :

									    // no rows found

									endif;

									?>

								</ul>				
							</div>

						<?php
					    endwhile;

					else :

					    // no rows found

					endif;

					?>





				</div>

			</div>
		</div>
	</div>
</div>

<style type="text/css" media="screen">

	.content{
		background-color: #fff;
	}

		
</style>

<?php get_footer(); ?>