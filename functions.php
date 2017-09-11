<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	
	return;
}

Timber::$dirname = array('templates', 'views');

Timber::$locations = array(
	get_template_directory() . "/templates/Navs",
	get_template_directory() . "/templates/Home",
	get_template_directory() . "/templates/About",
	get_template_directory() . "/templates/Projects",
	get_template_directory() . "/templates/Contact",
	get_template_directory() . "/templates/Dashboard",
	);

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'pre_get_posts', array( $this, 'custom_search' ) );
		add_action('wp_ajax_myfilter', array( $this, 'filter' ) ); 
		add_action('wp_ajax_nopriv_myfilter', array( $this, 'filter' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		/* Example */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('example', new Twig_SimpleFilter('example', array($this, 'example')));
		return $twig;
	}

	function custom_search( $query ) {
    if ( is_search() && $query->is_main_query() && $query->get( 's' ) ) {
        $query->set(
            'post_type', array('post', 'projects'),
            'meta_query', array(
                array(
                'key' => 'wysiwyg',
                'value' => '%s',
                'compare' => 'LIKE',
                ),
            )
        );
        return $query;
    }
	} 
	
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
};

new StarterSite();

function ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/src/javascript/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => home_url() . '/wp-admin/admin-ajax.php',
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

function ajax_login(){

    // First check the nonce, if it fails the function will break
    wp_verify_nonce( 'ajax-login-nonce', 'idwe_login_security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
				wp_set_current_user($user_signon->ID);
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }

    die();
}

