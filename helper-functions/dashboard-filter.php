<?php

function filter_init() {
	wp_register_script('dashboard-filter', get_template_directory_uri() . '/src/javascript/dashboard-filter.js', array('jquery'), null, false);
  wp_enqueue_script('dashboard-filter');
}

add_action('wp_enqueue_scripts', 'filter_init', 110);
	
function filter( ) {
	$cat_ids = array();

	foreach($_POST['data'] as $arr) {
		array_push($cat_ids, $arr['value']);
	};

	$args = array(
		'post_type' => 'projects',
		'posts_per_page' => -1,
		'category__in' => $cat_ids
	);

	$context = Timber::get_context();
	$context['filtered'] = Timber::get_posts($args);
	echo Timber::render( 'dashboard-filtered.twig', $context );
			
	die();
}

add_action('wp_ajax_myfilter', 'filter' ); 
add_action('wp_ajax_nopriv_myfilter', 'filter' );
