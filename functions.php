<?php
/**
 * rtCamp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rtCamp
 */

if ( ! function_exists( 'rtcamp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rtcamp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rtCamp, use a find and replace
		 * to change 'rtcamp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rtcamp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'rtcamp' ),
			'secondary' => esc_html('secondary', 'onetheme'),
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
		add_theme_support( 'custom-background', apply_filters( 'rtcamp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'rtcamp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rtcamp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rtcamp_content_width', 640 );
}
add_action( 'after_setup_theme', 'rtcamp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rtcamp_widgets_init() {
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'rtcamp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rtcamp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
	) );

	 register_sidebar(array(
            'name' => 'Footer Left',
            'id' => 'footer-left-widget',
            'description' => 'Left Footer widget position.',
            'before_widget' => '<ul id="%1$s" class="footer-list">',
            'after_widget' => '</ul>',
            'before_title' => '<h2 class="footer-head">',
            'after_title' => '</h2>'
        ));

        register_sidebar(array(
            'name' => 'Footer Center',
            'id' => 'footer-center-widget',
            'description' => 'Centre Footer widget position.',
            'before_widget' => '<ul id="%1$s" class="footer-list">',
            'after_widget' => '</ul>',
            'before_title' => '<h2 class="footer-head">',
            'after_title' => '</h2>'
        ));
        register_sidebar(array(
            'name' => 'Footer Right',
            'id' => 'footer-right-widget',
            'description' => 'Right Footer widget position.',
            'before_widget' => '<div id="%1$s" class="">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="d-none">',
            'after_title' => '</h2>'
        ));

}
add_action( 'widgets_init', 'rtcamp_widgets_init' );



//create sidebar widget for date and time
function date_widget_init() {
    register_sidebar(array(
        'name' => 'Date and Time',
        'id' => 'date_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ));
    register_widget('Date_Widget');
}

add_action('widgets_init', 'date_widget_init');

class Date_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'date_widget', // Base ID
                __('Date and Time', 'text_domain'), // Name
                array('description' => __('A Date and Time Widget', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {

        if (!empty($instance['date_widget'])) {
            $res = apply_filters('widget_title', $instance['date_widget']);
            if ($res == "Dubai") {
                $timezone = "Asia/Dubai";
            } else if ($res == "Amity") {
                $timezone = "Australia/Brisbane";
            } else if ($res == "Ellensburg") {
                $timezone = "Pacific/Efate";
            } else {
                $timezone = "Asia/Kolkata";
            }
            $date = new DateTime('now', new DateTimeZone($timezone));
            $localday = $date->format('l,d M');
            $localtime = $date->format('h:i:s');
            echo '
                <div class="date">' . $localday . '</div>
                <div class="time">' . $localtime . '</div>';
        }
    }

    public function form($instance) {
        $city = array("Mumbai", "Dubai", "Surat", "Kolkata", "Amity", "Ellensburg");

        $dateandtime = !empty($instance['date_widget']) ? $instance['date_widget'] : "Select City";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('date_widget'); ?>"><?php _e('City:'); ?></label> 
            <select name="<?php echo $this->get_field_name('date_widget'); ?>" id="<?php echo $this->get_field_id('date_widget'); ?>"> 
                <option>
                    <?php echo esc_attr($dateandtime); ?></option> 
                <?php
                $option = "";

                foreach ($city as $name) {
                    $option .= "<option " . selected($instance['date_widget'], $name) . "value='" . $name . "'>" . $name . "</option>";
                }
                echo $option;
                ?>
            </select>            
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();

        $instance['date_widget'] = (!empty($new_instance['date_widget']) ) ? strip_tags($new_instance['date_widget']) : 'Enter URL';

        return $instance;
    }

}




class Footer_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'footer_widget', 
                __('Footer Page Link', 'text_domain'),
                array('description' => __('A Footer Widget', 'text_domain'),)
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $cnt = 1;
        while ($cnt <= 5) {
            if (!empty($instance['page-dropdown' . $cnt])) {
                $res = apply_filters('widget_title', $instance['page-dropdown' . $cnt]);
                $pages = get_pages();
                foreach ($pages as $page) {
                    if ($page->post_title == $res) {
                        echo "<li><a href='" . get_page_link($page->ID) . "'>" . $res . "</a></li>";
                    }
                }
            }
            $cnt++;
        }
        echo $args['after_widget'];
    }

    public function form($instance) {
        $cnt = 1;
        while ($cnt <= 5) {

            $page_name = !empty($instance['page-dropdown' . $cnt]) ? $instance['page-dropdown' . $cnt] : "Select Page";
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('page-dropdown' . $cnt); ?>"><?php _e('Page' . $cnt . ':'); ?></label> 
                <select name="<?php echo $this->get_field_name('page-dropdown' . $cnt); ?>" id="<?php echo $this->get_field_id('page-dropdown' . $cnt); ?>"> 
                    <option>
                        <?php echo esc_attr($page_name); ?></option> 
                    <?php
                    $pages = get_pages();
                    foreach ($pages as $page) {
                        $option = "<option " . selected($instance['page-dropdown' . $cnt], $page->post_title) . "value='" . $page->post_title . "'>";
                        $option .= $page->post_title;
                        $option .= '</option>';
                        echo $option;
                    }
                    ?>
                </select>            
            </p>
            <?php
            $cnt++;
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $cnt = 1;
        while ($cnt <= 5) {

            $instance['page-dropdown' . $cnt] = (!empty($new_instance['page-dropdown' . $cnt]) ) ? strip_tags($new_instance['page-dropdown' . $cnt]) : 'Select Page';
            $cnt++;
        }
        return $instance;
    }

}
function footer_widgets_init() {
	register_widget('Footer_Widget');
}
add_action('widgets_init', 'footer_widgets_init');



class Footer_Link_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'footer_link_widget', // Base ID
                __('Important Link', 'text_domain'), // Name
                array('description' => __('A Footer Link Widget', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {
    	echo $args['before_widget'];
        $cnt = 1;     
        while ($cnt <= 5) {
            if (!empty($instance['link' . $cnt])) {
                $res = apply_filters('widget_title', $instance['link' . $cnt]);
                echo "<li><a target='_blank' href='" . $res . "'>" . $res . "</a></li>";
            }
            $cnt++;
        }
        echo $args['after_widget'];
    }

    public function form($instance) {
        $cnt = 1;
        while ($cnt <= 5) {

            $link_name = !empty($instance['link' . $cnt]) ? $instance['link' . $cnt] : "";
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('link' . $cnt); ?>"><?php _e('Page' . $cnt . ':'); ?></label> 
                <input type="text" value=" <?php echo esc_attr($link_name); ?>" name="<?php echo $this->get_field_name('link' . $cnt); ?>" id="<?php echo $this->get_field_id('link' . $cnt); ?>"/>                    
            </p>
            <?php
            $cnt++;
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $cnt = 1;
        while ($cnt <= 5) {

            $instance['link' . $cnt] = (!empty($new_instance['link' . $cnt]) ) ? strip_tags($new_instance['link' . $cnt]) : 'Enter URL';
            $cnt++;
        }
        return $instance;
    }

}

function footer_link_widgets_init() {
    register_widget('Footer_Link_Widget');
}

add_action('widgets_init', 'footer_link_widgets_init');


/**
create shortcode for footer
 */
function load_term($atts) {
    extract(shortcode_atts(array(
        'url' => "#",
        'class' => "links",
        'copyright' => "Copyrigths © 2012. All rights reserved.",
                    ), $atts));
    return "<p>" . $copyright . " </p><ul class='" . $class . "'>
               <li><a href='" . $url . "'>Terms of Use<a></li>
               <li><a href='" . $url . "'>Privacy Policy<a></li>
               <li><a href='" . $url . "'>Designed by rtCamp<a></li>
            </ul>";
}

add_shortcode('rt-link', 'load_term');


/**
 * Enqueue scripts and styles.
 */
function rtcamp_scripts() {
	wp_enqueue_style( 'rtcamp-style', get_stylesheet_uri() );

	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/lib/css/bundle.css', array(), '1.0.0', 'all');	

	wp_enqueue_script( 'rtcamp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'rtcamp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'custom-jQuery', get_template_directory_uri() . '/lib/js/jquery.min.js', array(), '20151215', true );

	wp_enqueue_script( 'custom-bootstrap', get_template_directory_uri() . '/lib/js/bootstrap.min.js', array(), '20151215', true );

	wp_enqueue_script( 'custom-bootstrap2', get_template_directory_uri() . '/lib/js/slick.js', array(), '20151215', true );

	wp_enqueue_script( 'custom-jQuery2', get_template_directory_uri() . '/lib/js/aos.js', array(), '20151215', true );

	wp_enqueue_script( 'custom-bootstrap3', get_template_directory_uri() . '/lib/js/main.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rtcamp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/*
Custom post type Exhibitions
*/
require_once (get_template_directory() .'/custom-post-type/custom-post-type-Exhibitions.php');


/*
Custom post type Exhibitions
*/
require_once (get_template_directory() .'/custom-post-type/custom-post-type-Partners.php');

/*
Custom post type Exhibitions
*/
require_once (get_template_directory() .'/custom-post-type/custom-post-type-Slideshow.php');


/*
theme options
*/
require_once (get_template_directory() .'/themeoptions.php');



/* Nav Walker*/
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

