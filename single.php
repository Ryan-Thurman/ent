<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

$sidebarArgs = array(
	'post_type' => 'projects',
	'posts_per_page' => 3
);

$recentArgs = array(
	'post_type' => 'post',
	'posts_per_page' => 2
);

$sidebar_context = array();
$sidebar_context['latest'] = Timber::get_posts($sidebarArgs);
$sidebar_context['post'] = $context['post'];
$context['sidebar'] = Timber::get_sidebar('sidebar.twig', $sidebar_context);
$context['recent'] = Timber::get_posts($recentArgs);

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
