<?php
/**
 * EarlyZon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package EarlyZon
 */

if ( ! function_exists( 'earlyzon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function earlyzon_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on EarlyZon, use a find and replace
	 * to change 'earlyzon' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'earlyzon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	//Add The custom logo Support
	add_theme_support('custom-logo');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'earlyzon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'earlyzon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'earlyzon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function earlyzon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'earlyzon_content_width', 640 );
}
add_action( 'after_setup_theme', 'earlyzon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function earlyzon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'earlyzon' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'earlyzon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'earlyzon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function earlyzon_scripts() {
	wp_enqueue_style( 'earlyzon-style', get_stylesheet_uri() );

	wp_enqueue_style( 'earlyzon-bootstrap-style', get_template_directory_uri() . '/assets/bootstrap-3.3.7/css/bootstrap.css' );

	wp_enqueue_script('jquery');

	wp_enqueue_script( 'earlyzon-bootstrap-script', get_template_directory_uri() . '/assets/bootstrap-3.3.7/js/bootstrap.js', array(), '20170520', true );

	wp_enqueue_script( 'earlyzon-jquery-countdown', get_template_directory_uri() . '/assets/jquery.countdown-2.0.4/jquery.countdown.js', array(), '20170520', true );

	wp_enqueue_script( 'earlyzon-npm-typedjs', get_template_directory_uri() . '/assets/node_modules/typed.js/lib/typed.min.js', array(), '20170812', true );


	wp_enqueue_script( 'earlyzon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'earlyzon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_add_inline_script('earlyzon-npm-typedjs', '

		jQuery(document).ready(function($){

			new Typed(\'.audience\', {

				strings: ["IT Professionals,", "Designers,", "Web Developers," ],
				startDelay: 2000,
				typeSpeed: 70,
				backSpeed: 30

			});
		})
	');

	wp_add_inline_script('earlyzon-jquery-countdown', '
        jQuery(document).ready(function($) {
        	$(\'.item-countdown\').each(function(i, obj){

				$(this).countdown($(this).data(\'expiration-date\'),function(event){
					//$(this).html(event.strftime(\'%D day%!d %H:%M:%S\'));
					this_countdown_day = event.strftime(\'%D\');
					this_countdown_hr  = event.strftime(\'%H:%M:%S\');
					//console.log( $(this).html(event.strftime(\'%-d day%!d %H:%M:%S\')) );
					//check if day is null
					if( this_countdown_day == \'0\' && this_countdown_hr !== \'00:00:00\'  ){
						$(this).html(event.strftime(\'%H hr %M mn %S sec\'));
					}else{
						$(this).html(event.strftime(\'%D day%!d %H:%M:%S\'));
					}


				}).on(\'finish.countdown\', function(){
					$(this).prev().empty();
					$(this).html(\'Expired\');
					$(this).css({\'font-size\': \'21px\', \'padding\': \'16px\'});
					$(this).parent().css({\'background\':\'#ccc\'});
				})

        	});

        });
        ' );

	if(is_page('submit')){

		wp_add_inline_script('earlyzon-jquery-countdown', '
		jQuery(document).ready(function($){
			//$(\'.standard-button-wrapper\').addClass(\'hidden\');
			//$(\'.basic-button-wrapper form.paypal-button\').hide();
			$(\'.listing-category\').change(function(){
				//alert(this.value)
				if($(\'.listing-category\').find(\':selected\').val() == "Ebook/book"){
					$(\'.starting-date-wrapper\').hide();
					$(\'.end-date-wrapper\').hide();
					$(\'.event-address-wrapper\').hide();

				}else{
					$(\'.starting-date-wrapper\').show();
					$(\'.end-date-wrapper\').show();
					$(\'.event-address-wrapper\').show();
				}
				//$(\'.listing-category\').off(\'change\');
			})



			document.addEventListener( \'wpcf7mailsent\', function( event ) {
				if( $(\'.listing-package\').find(\':selected\').val() == "Basic ($150)" ){
					$(\'.basic-button-wrapper .paypal-button\').click();
				}else if( $(\'.listing-package\').find(\':selected\').val() == "Standard ($300)" ){
					$(\'.standard-button-wrapper .paypal-button\').click();
				}else if( $(\'.listing-package\').find(\':selected\').val() == "FREE" ){
					location = \'https://www.earlyzon.com/success/\';
				}


			}, false );

		});

		');


	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'earlyzon_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function homepage_pagination( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'deals' ) );
	}
}
add_action( 'pre_get_posts', 'homepage_pagination' );

