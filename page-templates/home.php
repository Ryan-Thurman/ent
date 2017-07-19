<?php
/*
 * Template Name: Home Page
 * Description: A Page Template with a darker design.
 */

$context = Timber::get_context();

$projectArgs = array(
	'post_type' => 'projects',
	'posts_per_page' => 9
);

$carouselArgs = array(
	'post_type' => 'home_sliders',
	'posts_per_page' => -1
);

$newArgs = array(
	'post_type' => 'post',
	'posts_per_page' => 3
);

$context['posts'] = Timber::get_posts($newArgs);
$context['sliders'] = Timber::get_posts($carouselArgs);
$context['projects'] = Timber::get_posts($projectArgs);

Timber::render( 'home.twig', $context );