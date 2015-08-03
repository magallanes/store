<?php 
/*
Template Name: Support
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


<div class="full_width" style="background-color:#ffffff">
   <div class="full_width_inner">
      <div class="vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">
         <div class=" section_inner clearfix">
            <div class="section_inner_margin clearfix">
               <div class="vc_col-sm-12 wpb_column vc_column_container">
                  <div class="wpb_wrapper">
                     <div class="separator transparent center " style="margin-top: 70px;"></div>
                     <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                           <h1 style="text-align: center;">FREQUENTLY ASKED QUESTIONS</h1>
                        </div>
                     </div>
                     <div class="separator transparent center " style="margin-top: 30px;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="vc_row wpb_row section vc_row-fluid grid_section" style=" text-align:left;">
         <div class=" section_inner clearfix">
            <div class="section_inner_margin clearfix">
               <div class="vc_col-sm-12 wpb_column vc_column_container">
                  <div class="wpb_wrapper support">
											<?php

											// check if the repeater field has rows of data
											if( have_rows('accordion') ): ?>


                  			<div class="accordion">

                  				<?php while ( have_rows('accordion') ) : the_row(); ?>

													  <h3><?php the_sub_field('title'); ?></h3>
													  <div>
													    
														<?php

														// check if the repeater field has rows of data
														if( have_rows('subaccordion') ): ?>


							                 <div class="accordion">

														 		<?php while ( have_rows('subaccordion') ) : the_row(); ?>


																	  <h3><?php the_sub_field('title'); ?></h3>
																	  <div>
																	    <?php the_sub_field('text'); ?>
																	  </div>


														  	<?php endwhile; ?>

													  	</div>

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
               </div>
            </div>
         </div>
      </div>
      <div class="vc_row wpb_row section vc_row-fluid" style=" text-align:left;">
         <div class=" full_section_inner clearfix">
            <div class="vc_col-sm-12 wpb_column vc_column_container">
               <div class="wpb_wrapper">
                  <div class="separator transparent center " style="margin-top: 70px;"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="vc_row wpb_row section vc_row-fluid vc_custom_1426691240854 grid_section" style="background-color:#f4f4f4; text-align:left;">
         <div class=" section_inner clearfix">
            <div class="section_inner_margin clearfix">
               <div class="vc_col-sm-12 wpb_column vc_column_container vc_custom_1422904883012">
                  <div class="wpb_wrapper">
                     <div class="vc_row wpb_row section vc_inner vc_row-fluid vc_custom_1422904730529 use_row_as_box" style=" text-align:left;">
                        <div class=" full_section_inner clearfix">
                           <div class="vc_col-sm-12 wpb_column vc_column_container">
                              <div class="wpb_wrapper">
                                 <div class="separator transparent center " style="margin-top: 90px;"></div>
                                 	<?php echo do_shortcode('[contact-form-7 id="16818" title="Support Form"]'); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<?php get_footer(); 