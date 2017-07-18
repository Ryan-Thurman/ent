<?php
/*
 * Template Name: Active Projects Page
 * Description: A Page Template with a darker design.
 */

$context = Timber::get_context();

$projectArgs = array(
	'post_type' => 'projects',
	'posts_per_page' => 6
);

$carouselArgs = array(
	'post_type' => 'home_sliders',
	'posts_per_page' => -1
);

$context['sliders'] = Timber::get_posts($carouselArgs);
$context['projects'] = Timber::get_posts($projectArgs);

Timber::render( 'active-projects-landing.twig', $context );