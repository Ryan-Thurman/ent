<?php
/*
 * Template Name: About Page
 * Description: A Page Template with a darker design.
 */

$context = Timber::get_context();

$bioArgs = array(
	'post_type' => 'bio',
	'posts_per_page' => -1
);

$context['bios'] = Timber::get_posts($bioArgs);
$context['options'] = get_fields();

Timber::render( 'about.twig', $context );