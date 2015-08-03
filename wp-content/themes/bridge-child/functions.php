<?php

add_action('wp_logout', 'mj_flush_w3tc_cache');
add_action('wp_login', 'mj_flush_w3tc_cache');
function mj_flush_w3tc_cache()
{
    if (function_exists('w3tc_pgcache_flush')) {
        w3tc_pgcache_flush();
    }
}

// remove related products (woocommerce)
function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);

// enqueue the child theme stylesheet
function wp_schools_enqueue_scripts() {
wp_register_style( 'stylesheet-css', get_stylesheet_directory_uri() . '/css/stylesheet.min.css'  );
wp_enqueue_style( 'stylesheet-css' );
wp_register_style( 'style_dynamic-css', get_stylesheet_directory_uri() . '/css/style_dynamic.css'  );
wp_enqueue_style( 'style_dynamic-css' );
wp_register_style( 'responsive-css', get_stylesheet_directory_uri() . '/css/responsive.min.css'  );
wp_enqueue_style( 'responsive-css' );
wp_register_style( 'custom_style', get_stylesheet_directory_uri() . '/css/custom_css.css'  );
wp_enqueue_style( 'custom_style' );
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
wp_enqueue_style( 'childstyle' );
wp_register_style( 'lato', '//fonts.googleapis.com/css?family=Lato:100,200,300,400,600,700,800&subset=latin,latin-ext'  );
wp_enqueue_style( 'lato' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


function custom_scripts() {

wp_register_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom_js.js', array() , false, true );

wp_enqueue_script( 'custom-script' );

}

add_action( 'wp_enqueue_scripts', 'custom_scripts', 99 );

function select2_scripts() {
	
wp_register_script( 'select2', get_stylesheet_directory_uri() . '/js/select2.min.js', array() , false, true );

wp_enqueue_script( 'select2' );

}
add_action( 'wp_enqueue_scripts', 'select2_scripts', 99 );

function woocommerce_scripts() {

wp_register_script( 'woocommerce-script', get_stylesheet_directory_uri() . '/js/woocommerce.js', array() , false, true );

wp_enqueue_script( 'woocommerce-script' );

}
add_action( 'wp_enqueue_scripts', 'woocommerce_scripts', 99 );





remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);




$role = add_role( 'wholesale_pending', 'Wholesale Pending', array(
    'read' => true, // True allows that capability
));




function wpcf7_before_action($cfdata) {
  $formid = $cfdata->id;

  if ( $formid == 17140) {


    $submission = WPCF7_Submission::get_instance();
    
      if ( $submission ) {
          $posted_data = $submission->get_posted_data();
      }

   
      $userdata = array(
          'user_login'      => $posted_data['username'],
          'user_email'      => $posted_data['email'],
          'user_pass'       => $posted_data['password'],
          'display_name'    => $posted_data['username'],
          'role'            => 'wholesale_pending',
          'first_name'      => $posted_data['first_name'],
          'last_name'       => $posted_data['last_name']
      );

      $user_id = wp_insert_user( $userdata );

   
      // Return
      if( is_wp_error($user_id) ) {
          
      $cfdata->skip_mail = true;

          die('{"mailSent":false,"into":"#wpcf7-f17140-o1","captcha":null,"message":"'.$user_id->get_error_message().'"}');
          // echo $user_id->get_error_message();
      
      }

    update_user_meta( $user_id, 'url', sanitize_text_field( $posted_data['website']) );
    update_user_meta( $user_id, 'facebook', sanitize_text_field( $posted_data['facebook']) );
    update_user_meta( $user_id, 'wpseo_author_title', sanitize_text_field( $posted_data['first_name'].' '.$posted_data['last_name']) );
    update_user_meta( $user_id, 'billing_first_name', sanitize_text_field( $posted_data['first_name']) );
    update_user_meta( $user_id, 'billing_last_name', sanitize_text_field( $posted_data['last_name']) );
    update_user_meta( $user_id, 'billing_company', sanitize_text_field( $posted_data['company_name']) );
    update_user_meta( $user_id, 'billing_address_1', sanitize_text_field( $posted_data['address']) );
    update_user_meta( $user_id, 'billing_city', sanitize_text_field( $posted_data['city']) );
    update_user_meta( $user_id, 'billing_postcode', sanitize_text_field( $posted_data['zip']) );
    update_user_meta( $user_id, 'billing_country', sanitize_text_field( $posted_data['country']) );
    update_user_meta( $user_id, 'billing_state', sanitize_text_field( $posted_data['state']) );
    update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $posted_data['phone']) );
    update_user_meta( $user_id, 'billing_email', sanitize_text_field( $posted_data['email']) );
    update_user_meta( $user_id, 'shipping_first_name', sanitize_text_field( $posted_data['first_name']) );
    update_user_meta( $user_id, 'shipping_last_name', sanitize_text_field( $posted_data['last_name']) );
    update_user_meta( $user_id, 'shipping_company', sanitize_text_field( $posted_data['company_name']) );
    update_user_meta( $user_id, 'shipping_address_1', sanitize_text_field( $posted_data['address']) );
    update_user_meta( $user_id, 'shipping_city', sanitize_text_field( $posted_data['city']) );
    update_user_meta( $user_id, 'shipping_postcode', sanitize_text_field( $posted_data['zip']) );
    update_user_meta( $user_id, 'shipping_country', sanitize_text_field( $posted_data['country']) );
    update_user_meta( $user_id, 'shipping_state', sanitize_text_field( $posted_data['state']) );


  }

}
add_action('wpcf7_before_send_mail', 'wpcf7_before_action',1);


if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Wholesale Email',
    'menu_title'  => 'Wholesale Email',
    'menu_slug'   => 'wholesale-email',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
    
}



/* remove wholesale products (shop) */
add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'wholesale' ), // Don't display products in the knives category on the shop page
			'operator' => 'NOT IN'
		)));
	
	}

	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}


function callback($buffer){
    return $buffer;
}

function add_ob_start(){
    ob_start("callback");
}

function flush_ob_end(){
    ob_end_flush();
}

add_action('init', 'add_ob_start');
add_action('wp_footer', 'flush_ob_end');


/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
	return get_site_url().'/shop';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );


/**
 * Set page url when cart is empty
 */
add_filter('wpmenucart_emptyurl', 'add_wpmenucart_emptyurl', 1, 1);
function add_wpmenucart_emptyurl ($empty_url) {
	return get_site_url().'/shop';
}



add_action( 'login_form_register', 'wpse45134_catch_register' );
/**
 * Redirects visitors to `wp-login.php?action=register` 
 */
function wpse45134_catch_register()
{
    wp_redirect( home_url( '/' ) );
    exit(); // always call `exit()` after `wp_redirect`
}








add_filter( 'manage_edit-product_columns', 'show_product_order',15 );
function show_product_order($columns){

   //remove column
   unset( $columns['wholesale'] );
   unset( $columns['price'] );

   //add column
   $columns['price_canada'] = __( 'Price Canada'); 
   $columns['price_usa'] = __( 'Price USA'); 

   return $columns;
}


add_action( 'manage_product_posts_custom_column', 'wpso23858236_product_column_offercode', 10, 2 );

function wpso23858236_product_column_offercode( $column, $postid ) {
    if ( $column == 'price_canada' ) {
        echo get_post_meta( $postid, '_ca_price', true );
    }
    if ( $column == 'price_usa' ) {
        echo get_post_meta( $postid, '_us_price', true );
    }
}



// add_action( 'woocommerce_product_options_pricing', 'wc_wpc_product_field' );
// function wc_wpc_product_field() {
//     woocommerce_wp_text_input( array( 'id' => 'wpc_price', 'class' => 'wc_input_price short', 'label' => __( 'Wholesale Price Canada', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
// }

// add_action( 'save_post', 'wc_wpc_save_product' );
// function wc_wpc_save_product( $product_id ) {
//     // If this is a auto save do nothing, we only save when update button is clicked
// 	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
// 		return;
// 	if ( isset( $_POST['wpc_price'] ) ) {
// 		if ( is_numeric( $_POST['wpc_price'] ) )
// 			update_post_meta( $product_id, 'wpc_price', $_POST['wpc_price'] );
// 	} else delete_post_meta( $product_id, 'wpc_price' );
// }






// add_action( 'woocommerce_product_options_pricing', 'wc_wpu_product_field' );
// function wc_wpu_product_field() {
//     woocommerce_wp_text_input( array( 'id' => 'wpu_price', 'class' => 'wc_input_price short', 'label' => __( 'Wholesale Price USA', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
// }

// add_action( 'save_post', 'wc_wpu_save_product' );
// function wc_wpu_save_product( $product_id ) {
//     // If this is a auto save do nothing, we only save when update button is clicked
// 	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
// 		return;
// 	if ( isset( $_POST['wpu_price'] ) ) {
// 		if ( is_numeric( $_POST['wpu_price'] ) )
// 			update_post_meta( $product_id, 'wpu_price', $_POST['wpu_price'] );
// 	} else delete_post_meta( $product_id, 'wpu_price' );
// }


class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = false;
    protected $info_comment = true;
    protected $remove_comments = true;
 
    // Variables
    protected $html;
    public function __construct($html)
    {
   	 if (!empty($html))
   	 {
   		 $this->parseHTML($html);
   	 }
    }
    public function __toString()
    {
   	 return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
   	 $raw = strlen($raw);
   	 $compressed = strlen($compressed);
   	 
   	 $savings = ($raw-$compressed) / $raw * 100;
   	 
   	 $savings = round($savings, 2);
   	 
   	 return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
   	 $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
   	 preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
   	 $overriding = false;
   	 $raw_tag = false;
   	 // Variable reused for output
   	 $html = '';
   	 foreach ($matches as $token)
   	 {
   		 $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
   		 
   		 $content = $token[0];
   		 
   		 if (is_null($tag))
   		 {
   			 if ( !empty($token['script']) )
   			 {
   				 $strip = $this->compress_js;
   			 }
   			 else if ( !empty($token['style']) )
   			 {
   				 $strip = $this->compress_css;
   			 }
   			 else if ($content == '<!--wp-html-compression no compression-->')
   			 {
   				 $overriding = !$overriding;
   				 
   				 // Don't print the comment
   				 continue;
   			 }
   			 else if ($this->remove_comments)
   			 {
   				 if (!$overriding && $raw_tag != 'textarea')
   				 {
   					 // Remove any HTML comments, except MSIE conditional comments
   					 $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
   				 }
   			 }
   		 }
   		 else
   		 {
   			 if ($tag == 'pre' || $tag == 'textarea')
   			 {
   				 $raw_tag = $tag;
   			 }
   			 else if ($tag == '/pre' || $tag == '/textarea')
   			 {
   				 $raw_tag = false;
   			 }
   			 else
   			 {
   				 if ($raw_tag || $overriding)
   				 {
   					 $strip = false;
   				 }
   				 else
   				 {
   					 $strip = true;
   					 
   					 // Remove any empty attributes, except:
   					 // action, alt, content, src
   					 $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
   					 
   					 // Remove any space before the end of self-closing XHTML tags
   					 // JavaScript excluded
   					 $content = str_replace(' />', '/>', $content);
   				 }
   			 }
   		 }
   		 
   		 if ($strip)
   		 {
   			 $content = $this->removeWhiteSpace($content);
   		 }
   		 
   		 $html .= $content;
   	 }
   	 
   	 return $html;
    }
   	 
    public function parseHTML($html)
    {
   	 $this->html = $this->minifyHTML($html);
   	 
   	 if ($this->info_comment)
   	 {
   		 $this->html .= "\n" . $this->bottomComment($html, $this->html);
   	 }
    }
    
    protected function removeWhiteSpace($str)
    {
   	 $str = str_replace("\t", ' ', $str);
   	 $str = str_replace("\n",  '', $str);
   	 $str = str_replace("\r",  '', $str);
   	 
   	 while (stristr($str, '  '))
   	 {
   		 $str = str_replace('  ', ' ', $str);
   	 }
   	 
   	 return $str;
    }

}
 
function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}
 
function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');



/**
 * Open a preview e-mail.
 *
 * @return null
**/
 
function previewEmail() {
 
    if (is_admin()) {
        $default_path = WC()->plugin_path() . '/templates/';
 
        $files = scandir($default_path . 'emails');
        $exclude = array( '.', '..', 'email-header.php', 'email-footer.php','plain' );
        $list = array_diff($files,$exclude);
        ?><form method="get" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">
<input type="hidden" name="order" value="593">
<input type="hidden" name="action" value="previewemail">
        <select name="file">
        <?php
        foreach( $list as $item ){ ?>
            <option value="<?php echo $item; ?>"><?php echo str_replace('.php', '', $item); ?></option>
        <?php } ?>
        </select><input type="submit" value="Go"></form><?php
        global $order;
        $order = new WC_Order($_GET['order']);
        wc_get_template( 'emails/email-header.php', array( 'order' => $order ) );
 
 
        wc_get_template( 'emails/'.$_GET['file'], array( 'order' => $order ) );
        wc_get_template( 'emails/email-footer.php', array( 'order' => $order ) );
 
    }
    return null; 
}
 
add_action('wp_ajax_previewemail', 'previewEmail');
//Remove checkout
/*function so_27023433_disable_checkout_script(){
    wp_dequeue_script( 'class-wc-checkout' );
}
add_action( 'wp_enqueue_scripts', 'so_27023433_disable_checkout_script' );*/

// Remove query string from static files
function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
?>