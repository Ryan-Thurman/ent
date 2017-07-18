<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();

$context['title'] = 'Showing results for '.'"'.get_search_query().'"' ;

$posts = Timber::get_posts();

$article_posts = array();
$project_posts = array();

foreach($posts as $post) {
	if($post->post_type === 'post') {
		array_push($article_posts, $post);
	} else if ($post->post_type === 'projects') {
		array_push($project_posts, $post);
	};
}

$context['posts'] = $article_posts;
$context['projects'] = $project_posts;

Timber::render( 'search.twig', $context );
