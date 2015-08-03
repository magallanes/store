<?php 
/*
Template Name: How to Apply
*/ 
	define('DONOTCACHEPAGE', true);
	define('DONOTCACHEDB', true);
	define('DONOTMINIFY', true);
	define('DONOTCDN', true);
	define('DONOTCACHCEOBJECT', true);


get_header(); ?>



  <div class="support howtoapply">
			<?php

			// check if the repeater field has rows of data
			if( have_rows('accordion') ): ?>


  			<div class="accordion">

  				<?php while ( have_rows('accordion') ) : the_row(); ?>

					  <h3>
					  	<span><?php the_sub_field('title'); ?></span>
					  	<span class="background" style="background-image: url('<?php echo wp_get_attachment_image_src(get_sub_field('background'), 'full')[0]; ?>') !important"></span>
					  	<span class="white"></span>
					  </h3>
					  <div>
					    
						<?php

						if( have_rows('content') ): ?>

					 		<?php while ( have_rows('content') ) : the_row(); ?>


						 		<?php if( get_row_layout() == 'video_block' ): ?>

				        	<!-- video block -->
				        	<div class="video-block" style="background-image: url('<?php echo wp_get_attachment_image_src(get_sub_field('background_image'), 'full')[0]; ?>');">
				        		<a rel="video" href="https://www.youtube.com/watch?v=<?php the_sub_field('video_id'); ?>" class="btn-play"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-button.png" alt=""></a>
				        	</div>
				        	<!-- video block -->

				        <?php elseif( get_row_layout() == 'text_block' ): ?>

					 				<div class="block">
					        	<!-- Text block -->
					        	<h4 class="withline"><?php the_sub_field('title'); ?></h4>
					        	<div class="text">
					        		<?php the_sub_field('text'); ?>
					        	</div>
					        	<!-- Text block -->
					        </div>

				        <?php elseif( get_row_layout() == 'list_block' ): ?>

					 				<div class="block">
					        	<!-- List block -->
					        	<div class="list-block">
					        		<h4><?php the_sub_field('title'); ?></h4>

											<?php if( have_rows('list') ): ?>
							        	<ul>
											 		<?php while ( have_rows('list') ) : the_row(); ?>
											  		<li><?php the_sub_field('list_item'); ?></li>
													<?php endwhile; ?>
												</ul>
											<?php endif; ?>
				        		</div>
				        		<!-- List block -->
				        	</div>

				        <?php elseif( get_row_layout() == 'subaccordion_block' ): ?>
				        	
					 				<div class="block">
					        	<!-- subaccordion block -->
					        	<h4 class="withline"><?php the_sub_field('title'); ?></h4>
										<?php if( have_rows('subaccordion') ): ?>
						        	<div class="accordion">
										 		<?php while ( have_rows('subaccordion') ) : the_row(); ?>
										  		<h3><?php the_sub_field('title'); ?></h3>
												  <div>
												    <p><?php the_sub_field('text'); ?></p>
												  </div>
												<?php endwhile; ?>
											</div>
										<?php endif; ?>
					        	<!-- subaccordion block -->
					      	</div>

				        <?php endif; ?>


					  	<?php endwhile; ?>

						<?php endif; ?>

						</div>

			  	<?php endwhile; ?>

				</div>

			<?php endif; ?>
		  



		<script>
			$(function() {
				var to = null;

				$( ".accordion" ).accordion({
					heightStyle: "content",
					active: false,
					collapsible: true,
					beforeActivate: function(e,u){

						if ( to != null ) clearTimeout(to);

						if ( $('.mobile_menu_button').css('display') == "table" ){

							to = setTimeout(function(){
								$('body,html').stop(true,true).animate({
						            scrollTop: $(u.newHeader).offset().top
						        },1000);
							}, 500);

						}else{

							to = setTimeout(function(){
								$('body,html').stop(true,true).animate({
						            scrollTop: $(u.newHeader).offset().top - $('.page_header').height()
						        },1000);
							}, 500);

						}
					}
				});
			});
		</script>

  </div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<style type="text/css">

nav.main_menu>ul>li>a{
	color: #000 !important;
}

.header_cart span.header_cart_span {
  color: #fff!important;
}

.shopping_cart_header .header_cart {
  background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/css/img/header_shopping_bag.png') !important;
}

</style>

<?php get_footer(); 
