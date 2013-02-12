<?php


function avia_bbpress_enabled()
{
	if (class_exists( 'bbPress' )) { return true; }
	return false;
}

//check if the plugin is enabled, otherwise stop the script
if(!avia_bbpress_enabled()) { return false; }


global $avia_config;


//register my own styles
if(!is_admin()){ add_action('bbp_enqueue_scripts', 'avia_bbpress_register_assets',15); }


function avia_bbpress_register_assets()
{
	//bbp_theme_compat_enqueue_css	
	wp_enqueue_style( 'avia-bbpress', AVIA_BASE_URL.'config-bbpress/bbpress-mod.css');
	wp_dequeue_style( 'bbpress-style' );
	
}




//remove forum and single topic summaries at the top of the page
add_filter('bbp_get_single_forum_description', 'avia_bbpress_filter_form_message',10,2 );
add_filter('bbp_get_single_topic_description', 'avia_bbpress_filter_form_message',10,2 );



add_filter('avia_style_filter', 'avia_bbpress_forum_colors');
/* add some color modifications to the forum table items */
function avia_bbpress_forum_colors($config)
{
	global $avia_config;

	$config[] = array(
		'elements'	=>'#top .bbp-forum-title, #top .bbp-topic-title a',
		'key'		=>'color',
		'value'		=> $avia_config['colorRules']['body_font']
		);
	
	$config[] = array(
		'elements'	=>'#top .template-forum-wrap div, .bbp-pagination-links, .bbp-pagination-links span, .bbp-pagination-links a, #top .bbp-topic-pagination a, #bbp-your-profile span, img.avatar, table ul',
		'key'		=>'border-color',
		'value'		=> $avia_config['colorRules']['border']
		);	
		
		
	$config[] = array(
		'elements'	=>'#top .bbp-pagination, #top .bbp-topic-pagination a, #entry-author-info #author-description, div.bbp-breadcrumb a, .bbp_widget_login .bbp-lostpass-link:after',
		'key'		=>'color',
		'value'		=> $avia_config['colorRules']['meta_color']
		);
	
	$config[] = array(
		'elements'	=>'.bbp-admin-links',
		'key'		=>'color',
		'value'		=> $avia_config['colorRules']['border']
		);	
		
	return $config;
}


function avia_bbpress_filter_form_message( $retstr, $args )
{
	return false;
}