<?php


function avia_woocommerce_enabled()
{
	if (defined("WOOCOMMERCE_VERSION")) { return true; }
	return false;
}


global $avia_config;

//product thumbnails 
$avia_config['imgSize']['shop_thumbnail'] 	= array('width'=>80, 'height'=>80);
$avia_config['imgSize']['shop_catalog'] 	= array('width'=>450, 'height'=>355);
$avia_config['imgSize']['shop_single'] 		= array('width'=>450, 'height'=>355);
avia_backend_add_thumbnail_size($avia_config);

include('admin-options.php');
include('admin-import.php');



//check if the plugin is enabled, otherwise stop the script
if(!avia_woocommerce_enabled()) { return false; }


//register my own styles, remove wootheme stylesheet
if(!is_admin()){
	add_action('init', 'avia_woocommerce_register_assets');
}

function avia_woocommerce_register_assets()
{
	wp_enqueue_style( 'avia-woocommerce-css', AVIA_BASE_URL.'config-woocommerce/woocommerce-mod.css');
	wp_enqueue_script( 'avia-woocommerce-js', AVIA_BASE_URL.'config-woocommerce/woocommerce-mod.js', array('jquery'), 1, true);
}

define('WOOCOMMERCE_USE_CSS', false);






######################################################################
# config
######################################################################

//add avia_framework config defaults

$avia_config['shop_overview_column']  = get_option('avia_woocommerce_column_count');  // columns for the overview page
$avia_config['shop_overview_products']= get_option('avia_woocommerce_product_count'); // products for the overview page

$avia_config['shop_single_column'] 	 = 4;			// columns for related products and upsells
$avia_config['shop_single_column_items'] 	 = 4;	// number of items for related products and upsells
$avia_config['shop_overview_excerpt'] = false;		// display excerpt

if(!$avia_config['shop_overview_column']) $avia_config['shop_overview_column'] = 3;


######################################################################
# Create the correct template html structure
######################################################################

//remove woo defaults
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
//single page removes
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 2);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 2);

remove_action( 'woocommerce_product_tabs', 'woocommerce_product_description_tab', 10 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action( 'woocommerce_before_single_product', array($woocommerce, 'show_messages'), 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30, 2 );



//add theme actions && filter
add_action( 'woocommerce_before_main_content', 'avia_woocommerce_before_main_content', 10);
add_action( 'woocommerce_after_main_content', 'avia_woocommerce_after_main_content', 10);
add_action( 'woocommerce_before_shop_loop', 'avia_woocommerce_before_shop_loop', 1);
add_action( 'woocommerce_after_shop_loop', 'avia_woocommerce_after_shop_loop', 10);
add_action( 'woocommerce_before_shop_loop_item', 'avia_woocommerce_thumbnail', 10);
add_action( 'woocommerce_after_shop_loop_item_title', 'avia_woocommerce_overview_excerpt', 10);
add_filter( 'loop_shop_columns', 'avia_woocommerce_loop_columns');
add_filter( 'loop_shop_per_page', 'avia_woocommerce_product_count' );


//single page adds
add_action( 'woocommerce_before_single_product', 'check_avia_title', 1);
add_action( 'woocommerce_single_product_summary', array($woocommerce, 'show_messages'), 10);
add_action( 'woocommerce_single_product_summary', 'avia_woocommerce_template_single_excerpt', 10, 2);
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 50);
add_action( 'woocommerce_single_product_summary', 'avia_woocommerce_output_related_products', 60);
add_action( 'woocommerce_single_product_summary', 'avia_woocommerce_output_upsells', 70);
add_action( 'woocommerce_before_single_product_summary', 'avia_woocommerceproduct_prev_image', 1,  2);
add_action( 'woocommerce_before_single_product_summary', 'avia_add_summary_div', 2);
add_action( 'woocommerce_after_single_product_summary',  'avia_close_summary_div', 1000);
add_action( 'avia_add_to_cart', 'woocommerce_template_single_add_to_cart', 30, 2 );

//add_action( 'woocommerce_product_thumbnails', 'avia_woocommerceproduct_prev_image_after', 1000 );

add_filter( 'single_product_small_thumbnail_size', 'avia_woocommerce_thumb_size');
add_filter( 'avia_sidebar_menu_filter', 'avia_woocommerce_sidebar_filter');



######################################################################
# FUNCTIONS
######################################################################




#
# create the shop navigation with account links, as well as cart and checkout
#

function avia_woocommerce_template_single_excerpt($post, $_product)
{
	
	if(is_singular() && avia_post_meta('hero'))
	{
		echo "<div class='hero-text entry-content'>";
		the_excerpt();
		echo "<span class='seperator extralight-border'></span>";
		echo "</div>";
	}
	
	echo "<div class='summary-main-content entry-content'>";
	the_content();
	echo "</div>";
}


function check_avia_title()
{
	global $avia_config;
	if(empty($avia_config['slide_output'])) 
	{
		add_action( 'woocommerce_before_single_product', 'avia_title', 2, 2);
	}
}


function avia_add_summary_div()
{
	global $avia_config;
	$units = "eight";
	//if(!empty($avia_config['slide_output'])) $units = "nine";

	echo "<div class='$units units'>";
}

function avia_close_summary_div()
{
	echo "</div>";
}



function avia_shop_nav($args)
{
	$output = "";
	$url = avia_collect_shop_urls();
	
	$output .= "<ul>";
	
	if( is_user_logged_in() )
	{
		$output .= "<li class='account_overview_link'><a href='".$url['account_overview']."'>".__('My Account', 'avia_framework')."</a>";
			$output .= "<ul>";
			$output .= "<li class='account_change_pw_link'><a href='".$url['account_change_pw']."'>".__('Change Password', 'avia_framework')."</a></li>";
			$output .= "<li class='account_edit_adress_link'><a href='".$url['account_edit_adress']."'>".__('Edit Address', 'avia_framework')."</a></li>";
			$output .= "<li class='account_view_order_link'><a href='".$url['account_view_order']."'>".__('View Order', 'avia_framework')."</a></li>";
			$output .= "<li class='account_logout_link'><a href='".$url['logout']."'>".__('Log Out', 'avia_framework')."</a></li>";
			$output .= "</ul>";
		$output .= "</li>";
	}
	else
	{
		if(get_option('users_can_register')) 
		{
			$output .= "<li class='register_link'><a href='".$url['register']."'>".__('Register', 'avia_framework')."</a></li>";
		}
		
		$output .= "<li class='login_link'><a href='".$url['account_overview']."'>".__('Log In', 'avia_framework')."</a></li>";
	}
	
	$output .= "<li class='shopping_cart_link'><a href='".$url['cart']."'>".__('Cart', 'avia_framework')."</a></li>";
	$output .= "<li class='checkout_link'><a href='".$url['checkout']."'>".__('Checkout', 'avia_framework')."</a></li>";
	$output .= "</ul>";
	
	if($args['echo'] == true) 
	{
		echo $output;
	}
	else
	{
		return $output;
	} 
}


#
# helper function that collects all the necessary urls for the shop navigation
#

function avia_collect_shop_urls()
{
	global $woocommerce;
	
	$url['cart']				= $woocommerce->cart->get_cart_url();
	$url['checkout']			= $woocommerce->cart->get_checkout_url();
	$url['account_overview'] 	= get_permalink(get_option('woocommerce_myaccount_page_id'));
	$url['account_edit_adress']	= get_permalink(get_option('woocommerce_edit_address_page_id'));
	$url['account_view_order']	= get_permalink(get_option('woocommerce_view_order_page_id'));
	$url['account_change_pw'] 	= get_permalink(get_option('woocommerce_change_password_page_id'));
	$url['logout'] 				= wp_logout_url(home_url('/'));
	$url['register'] 			= site_url('wp-login.php?action=register', 'login');

	return $url;
}




#
# check which page is displayed and if the sidebar menu should be prevented
#
function avia_woocommerce_sidebar_filter($menu)
{
	$id = avia_get_the_ID();
	if(is_cart() || is_checkout() || get_option('woocommerce_thanks_page_id') == $id){$menu = "";}
	return $menu;
}

#
# single page thumbnail and preview image modifications
#
function avia_woocommerceproduct_prev_image($post, $_product)
{
	global $avia_config;

	$extraClass = avia_post_meta('zoom_lightbox');
	$units = "four";
	//if(!empty($avia_config['slide_output'])) $units = "three";
	
	echo "<div class='alpha $units units prev_image_container ".$extraClass."'>";
	
	if(empty($avia_config['slide_output']))
	{	
		$slider = new avia_slideshow(get_the_ID());
		$slider -> setImageSize('portfolio');
		echo $slider->display();
		echo $slider->slideshow_thumbs();
	}
	else
	{
		avia_add_to_cart($post, $_product );
		echo "<h1 class='post-title portfolio-single-post-title'>".get_the_title()."</h1>";
	}
	
	//price	
	if(is_object($_product) && is_singular())  
	{
		echo "<div class='price_container'>";
		woocommerce_template_single_price($post, $_product);
		echo "</div>";
	}
	
	
	if(!empty($slider)) { 
		avia_add_to_cart($post, $_product );
	}
	

	$avia_config['currently_viewing'] = 'shop_single';
	$avia_config['sidebar_class'] = 'alpha';

	get_sidebar();
	wp_reset_query();

	echo "</div>";
}


function avia_add_to_cart($post, $_product )
{
	echo "<div class='avia_cart avia_cart_".$_product->product_type."'>";
	do_action( 'avia_add_to_cart', $post, $_product );
	echo "</div>";
}


function avia_woocommerce_thumb_size()
{
	return 'shop_single';
}


#
# creates the avia framework container arround the shop pages
#
function avia_woocommerce_before_main_content()
{
	global $avia_config;
	
	avia_template_set_page_layout('page_layout');
	if(!isset($avia_config['shop_overview_column'])) $avia_config['shop_overview_column'] = "auto";
	if(is_shop() && $new = avia_post_meta( get_option('woocommerce_shop_page_id'), 'page_layout')) $avia_config['layout'] = $new;
	
	echo "<div id='main' class='container_wrap ".$avia_config['layout']." template-shop shop_columns_".$avia_config['shop_overview_column']."'>";
		echo "<div class='container'>";
		
		if(!is_singular()) 
		{
			$avia_config['overview'] = true;
			avia_woocommerce_advanced_title();
		}
}

#
# creates the title + description for overview pages
#
function avia_woocommerce_advanced_title()
{
	global $wp_query;
	$titleClass 	= "";
	$image		 	= "";
	if(isset($wp_query->query_vars['taxonomy']))
	{
		$term 			= get_term_by( 'slug', get_query_var($wp_query->query_vars['taxonomy']), $wp_query->query_vars['taxonomy']);
		$attachment_id 	= get_woocommerce_term_meta($term->term_id, 'thumbnail_id');
		if(!empty($term->description)) $titleClass .= "title_container_description ";
	}
	
	if(!empty($attachment_id))
	{
		$titleClass .= "title_container_image ";
		$image		= wp_get_attachment_image( $attachment_id, 'thumbnail', false, array('class'=>'category_thumb'));
	}

	echo "<div class='extralight-border title_container shop_title_container $titleClass'>";
	//echo avia_breadcrumbs();
	woocommerce_catalog_ordering();
	echo $image;
}



#
# creates the avia framework content container arround the shop loop
#
function avia_woocommerce_before_shop_loop()
{	

			global $avia_config;
			
			if(isset($avia_config['dynamic_template'])) return;
			
			ob_start();
			if (!empty($avia_config['overview'])) echo "</div>"; // end title_container
			echo "<div class='template-shop content ".$avia_config['content_class']." units'>";
			$content = ob_get_clean();
			echo $content;
			ob_start();
}

#
# closes the avia framework content container arround the shop loop
#
function avia_woocommerce_after_shop_loop()
{
			global $avia_config;
			if(isset($avia_config['dynamic_template'])) return;
			if(isset($avia_config['overview'] )) echo avia_pagination();
			echo "</div>"; //end content
}





#
# closes the avia framework container arround the shop pages
#
function avia_woocommerce_after_main_content()
{	
	global $avia_config;
	$avia_config['currently_viewing'] = "shop";
			
			//reset all previous queries
			wp_reset_query();
			
			//get the sidebar
			if(!is_singular())
			get_sidebar();
			
		echo "</div>"; // end container
	echo "</div>"; // end tempate-shop content
}




#
# creates the post image for each post
#
function avia_woocommerce_thumbnail($asdf)
{
	//circumvent the missing post and product parameter in the loop_shop template
	global $post;
	$_product = &new woocommerce_product( $post->ID );
	//$rating = $_product->get_rating_html(); //rating is removed for now since the current implementation requires wordpress to do 2 queries for each post which is not that cool on overview pages
	ob_start();
	woocommerce_template_loop_add_to_cart($post, $_product);
	$link = ob_get_clean();
	$extraClass  = empty($link) ? "single_button" :  "" ;
	
	echo "<div class='thumbnail_container'>";
	echo "<div class='thumbnail_container_inner'>";
		echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
		echo $link;
		echo "<a class='button show_details_button $extraClass' href='".get_permalink($post->ID)."'>".__('Show Details','avia_framework')."</a>";
		if(!empty($rating)) echo "<span class='rating_container'>".$rating."</span>";
		
		echo "</div>";
	echo "</div>";
}

#
# echo the excerpt
#
function avia_woocommerce_overview_excerpt()
{
	global $avia_config;

	if(!empty($avia_config['shop_overview_excerpt']))
	{
		echo "<div class='product_excerpt'>";
		the_excerpt();
		echo "</div>";
	}
}




#
# shopping cart dropdown in the main menu
#

function avia_woocommerce_cart_dropdown()
{
	global $woocommerce;
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	$link = $woocommerce->cart->get_cart_url();
	
	ob_start();
    the_widget('WooCommerce_Widget_Cart', '', array('widget_id'=>'cart-dropdown',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<span class="hidden">',
        'after_title' => '</span>'
    ));
    $widget = ob_get_clean();
	
	$output = "";
	$output .= "<ul class = 'cart_dropdown' data-success='".__('Product added', 'avia_framework')."'><li class='cart_dropdown_first'>";
	$output .= "<a class='cart_dropdown_link' href='".$link."'>".__('Cart', 'avia_framework')."</a><span class='cart_subtotal'>".$cart_subtotal."</span>";
	$output .= "<div class='dropdown_widget dropdown_widget_cart'>";
	$output .= $widget;
	$output .= "</div>";
	$output .= "</li></ul>";
	
	return $output;
}


#
# modify shop overview column count
#
function avia_woocommerce_loop_columns() 
{
	global $avia_config;
	return $avia_config['shop_overview_column'];
}


#
# modify shop overview product count
#

function avia_woocommerce_product_count() 
{
	global $avia_config;
	return $avia_config['shop_overview_products'];
}



#
# display upsells and related products
#
function avia_woocommerce_output_related_products()
{	
	global $avia_config;
	
	echo "<div class='product_column product_column_".$avia_config['shop_single_column']."'>";
	ob_start();
	woocommerce_related_products($avia_config['shop_single_column_items'],$avia_config['shop_single_column']); // 4 products, 4 columns
	$content = ob_get_clean();
	if($content)
	{
		echo avia_flag(__('Related Products', 'avia_framework'));
		echo $content;
	}


	echo "</div>";
}

function avia_woocommerce_output_upsells() 
{
	global $avia_config;

	echo "<div class='product_column product_column_".$avia_config['shop_single_column']."'>";
	ob_start();
	woocommerce_upsell_display($avia_config['shop_single_column_items'],$avia_config['shop_single_column']); // 4 products, 4 columns
	$content = ob_get_clean();
	if($content)
	{
		echo avia_flag(__('You may also like', 'avia_framework'));
		echo $content;
	}
	echo "</div>";
}




add_filter('avia_style_filter', 'avia_wooceommerce_colors');
/* add some color modifications to the forum table items */
function avia_wooceommerce_colors($config)
{
	require_once( 'woocommerce-mod-css-dynamic.php');			// register the plugins we need
	return $config;
}