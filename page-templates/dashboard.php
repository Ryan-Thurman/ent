<?php
/*
 * Template Name: Dashboard Page
 * Description: A Page Template with a darker design.
 */
$context = Timber::get_context();

$context['categories'] = Timber::get_terms('category', array('parent' => 0));

if( is_user_logged_in() ) {
	Timber::render( 'dashboard.twig', $context );
} else {
	wp_redirect('/');
};
