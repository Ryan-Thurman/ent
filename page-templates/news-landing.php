<?php
/*
 * Template Name: News Landing Page
 * Description: A Page Template with a darker design.
 */

$context = Timber::get_context();

$newsArgs = array(
	'post_type' => 'post',
	'posts_per_page' => 25,
	'meta_key'		=> 'featured',
	'meta_value'	=> 0
);

$featuredArgs = array(
	'numberposts'	=> 1,
	'post_type'		=> 'post',
	'meta_key'		=> 'featured',
	'meta_value'	=> 1
);

$context['posts'] = Timber::get_posts($newsArgs);
$context['featured'] = Timber::get_posts($featuredArgs);

Timber::render( 'news-landing.twig', $context );