<?php 
/*
Template Name: Home
*/ 
?>

<?php 
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

?>
	<?php get_header(); ?>
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
	<div class="full_width"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
	<div class="full_width_inner">
		<?php if(($sidebar == "default")||($sidebar == "")) : ?>
			<?php if (have_posts()) : 
					while (have_posts()) : the_post(); ?>
						<?php
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );

							$home_content = explode('<p>CF</p>', $content );
							echo $home_content[0]
						?>	


						<div class="block-slide">
							

							<div class="slide">

								<div class="col">
									<div class="center">
										<div class="mwidth">
											<img src="<?php echo wp_get_attachment_image_src(get_field('a_can_1'), 'full')[0]; ?>" class="can" alt="">
											<h4><?php the_field('a_subtitle_1') ?></h4>
											<div class="text">
												<?php the_field('a_text_1') ?>
											</div>
											<?php

											// check if the repeater field has rows of data
											if( have_rows('a_buttons_1') ):

											 	// loop through the rows of data
											    while ( have_rows('a_buttons_1') ) : the_row();

											?>
												<a href="<?php the_sub_field('link') ?>"><?php the_sub_field('name') ?></a>
											<?php
											    endwhile;
											else :
											    // no rows found
											endif;
											?>
										</div>
									</div>
								</div>
								<div class="col">
								
									<div class="center">
										<div class="mwidth">
											<h3><?php the_field('a_title_1') ?></h3>
										</div>
									</div>

								</div>
								<div class="background" style="background-image: url('<?php echo wp_get_attachment_image_src(get_field('a_background_1'), 'full')[0]; ?>')"></div>
								<a class="icon-close" href="#"></a>

							</div>
							

							<div class="slide">

								<div class="col">
								
									<div class="center">
										<div class="mwidth">
											<h3><?php the_field('a_title_2') ?></h3>
										</div>
									</div>

								</div>
								<div class="col">
									<div class="center">
										<div class="mwidth">
											<img src="<?php echo wp_get_attachment_image_src(get_field('a_can_2'), 'full')[0]; ?>" class="can" alt="">
											<h4><?php the_field('a_subtitle_2') ?></h4>
											<div class="text">
												<?php the_field('a_text_2') ?>
											</div>
											<?php

											// check if the repeater field has rows of data
											if( have_rows('a_buttons_2') ):

											 	// loop through the rows of data
											    while ( have_rows('a_buttons_2') ) : the_row();

											?>
												<a href="<?php the_sub_field('link') ?>"><?php the_sub_field('name') ?></a>
											<?php
											    endwhile;
											else :
											    // no rows found
											endif;
											?>
										</div>
									</div>
								</div>
								<div class="background" style="background-image: url('<?php echo wp_get_attachment_image_src(get_field('a_background_2'), 'full')[0]; ?>')"></div>
								<a class="icon-close" href="#"></a>

							</div>

						</div>

						<script type="text/javascript">

							jQuery(document).ready(function($) {

								var z_index = 15;
								
								$('.icon-close').on('click', function(event) {
									event.preventDefault();
								});
								$('.slide').on('click', function(event) {
									

									$(this).toggleClass('active').css('z-index', z_index++);
								});
							});


						</script>



							<?php

								$type = 'colors_y_finishes';
								$args = array(
									'post_type' => $type,
									'post_status' => 'publish',
									'posts_per_page' => -1,
									'caller_get_posts'=> 1,
									'orderby' => 'menu_order',
									'order' => 'ASC'
								);

								$my_query = null;
								$my_query = new WP_Query($args);
								if( $my_query->have_posts() ) {
								  while ($my_query->have_posts()) : $my_query->the_post(); ?>



												<?php /*?><div class="vc_row wpb_row section vc_row-fluid" style="background-color:#ffffff; text-align:left;">
													<div class=" full_section_inner clearfix">
														<div class="vc_col-sm-12 wpb_column vc_column_container">
															<div class="wpb_wrapper">
																<div class="q_elements_holder two_columns">
																	<div class="q_elements_item">
																		<div class="q_elements_item_inner">
																			<div class="q_elements_item_content">
																				<div class="wpb_single_image wpb_content_element vc_align_left">
																					<div style="text-align: center">
																						<div class="wpb_wrapper photo-finisheds">

																							<?php 

																							foreach (get_field('colors') as $key => $color_id) {
																								echo wp_get_attachment_image( get_post_meta($color_id->ID, 'product_image', true), 'full' ); 
																							}

																							?>

																						</div> 
																						<ul class="colors">
																							<?php foreach (get_field('colors') as $key => $color_id):  ?>
																								<li style="background: <?php echo get_post_meta($color_id->ID, 'color', true); ?>"></li>
																							<?php endforeach; ?>
																						</ul>	
																						<br><br>
																					</div>
																				</div> 
																			</div>
																		</div>
																	</div>
																	<div class="q_elements_item">
																		<div class="q_elements_item_inner">
																			<div class="q_elements_item_content" style="padding:15px 45px 15px 45px">
																				<div class="wpb_text_column wpb_content_element ">
																					<div class="wpb_wrapper">
																						<h2 style="text-align: left;"><?php the_title(); ?></h2>
																					</div> 
																				</div> 
																				<div class="separator  small left  " style="margin-top: 37px;margin-bottom: 37px;"></div>

																				<div class="wpb_text_column wpb_content_element ">
																					<div class="wpb_wrapper">
																						<p><?php echo get_field('description'); ?></p>
																						<br>
																						<a href="/shop" target="_self" data-hover-background-color=#ff0000 data-hover-border-color=#ff0000 data-hover-color=#ffffff class="qbutton  medium right" style="color: #303030; border-color: #303030; font-style: normal; margin: 0px 0px 0px 0px; background-color: #ffffff;">Shop now</a>
																					</div> 
																				</div> 
																			</div>
																		</div>
																	</div>
																</div>
															</div> 
														</div> 
													</div>
												</div><?php */?>

									<?php
								  endwhile;
								}
								wp_reset_query();  

							?>


						<?php 
							echo $home_content[1]
						?>	


					<?php 
 $args_pages = array(
  'before'           => '<p class="single_links_pages">',
  'after'            => '</p>',
  'pagelink'         => '<span>%</span>'
 );

 wp_link_pages($args_pages); ?>
					<?php
					if($enable_page_comments){
					?>
					<div class="container">
						<div class="container_inner">
					<?php
						comments_template('', true); 
					?>
						</div>
					</div>	
					<?php
					}
					?> 
					<?php endwhile; ?>
				<?php endif; ?>
		<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
			
			<?php if($sidebar == "1") : ?>	
				<div class="two_columns_66_33 clearfix grid2">
					<div class="column1">
			<?php elseif($sidebar == "2") : ?>	
				<div class="two_columns_75_25 clearfix grid2">
					<div class="column1">
			<?php endif; ?>
					<?php if (have_posts()) : 
						while (have_posts()) : the_post(); ?>
						<div class="column_inner">
						
						<?php the_content(); ?>	
						<?php 
 $args_pages = array(
  'before'           => '<p class="single_links_pages">',
  'after'            => '</p>',
  'pagelink'         => '<span>%</span>'
 );

 wp_link_pages($args_pages); ?>
							<?php
							if($enable_page_comments){
							?>
							<div class="container">
								<div class="container_inner">
							<?php
								comments_template('', true); 
							?>
								</div>
							</div>	
							<?php
							}
							?> 
						</div>
				<?php endwhile; ?>
				<?php endif; ?>
			
							
					</div>
					<div class="column2"><?php get_sidebar();?></div>
				</div>
			<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
				<?php if($sidebar == "3") : ?>	
					<div class="two_columns_33_66 clearfix grid2">
						<div class="column1"><?php get_sidebar();?></div>
						<div class="column2">
				<?php elseif($sidebar == "4") : ?>	
					<div class="two_columns_25_75 clearfix grid2">
						<div class="column1"><?php get_sidebar();?></div>
						<div class="column2">
				<?php endif; ?>
						<?php if (have_posts()) : 
							while (have_posts()) : the_post(); ?>
							<div class="column_inner">
							<?php the_content(); ?>		
							<?php 
 $args_pages = array(
  'before'           => '<p class="single_links_pages">',
  'after'            => '</p>',
  'pagelink'         => '<span>%</span>'
 );

 wp_link_pages($args_pages); ?>
							<?php
							if($enable_page_comments){
							?>
							<div class="container">
								<div class="container_inner">
							<?php
								comments_template('', true); 
							?>
								</div>
							</div>	
							<?php
							}
							?> 
							</div>
					<?php endwhile; ?>
					<?php endif; ?>
				
								
						</div>
						
					</div>
			<?php endif; ?>
	</div>
	</div>	

	<?php get_footer(); ?>