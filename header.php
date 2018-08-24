<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rtCamp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <title>rtCamp Theme Assignment</title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- FACEBOOK LIKE BOX REQUIRED CODE-->
 <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=211361625571335";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'rtcamp' ); ?></a>
	
	<header class="rtcamp-header">
                <div class="rtcamp-nav">
                    <div class="header-top-area">
                        <div class="container">
                            <div class="row">
                                <div class="col pr-0">
                                    <div class="top-nav-right">
                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'secondary',
                                            'menu-id' => 'secondary'));
                                        ?>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>

                    <div class="header-middle-area">
                        <div class="container pl-0">
                            <div class="row align-item"> 
                                 <div class="col-sm-4">
                                   <?php the_custom_logo();
									if (!has_custom_logo()) {
									?>
								   <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php echo get_template_directory_uri() . '/images/sitelogo.png';?>"></a>
									<?php
										}
										?>
                                    </div>
                                 <div class="col-sm-8 text-right pr-0">
                                    <form method=GET action="https://www.google.com/search">
                                        <input type="text" name="Search" placeholder="Site Search" class="site-search">
                                 </form>
                                 </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-bottom-area">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container p-0">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                 <span class="navbar-toggler-icon"></span>
                                </button>
                            <div class="collapse navbar-collapse" id="collapsibleNavbar">
								<?php 
								wp_nav_menu( array(
								  'theme_location' => 'primary',
								  'menu_id' => 'primary',
								  'depth' => 2,
								  'container' => false,
								  'menu_class' => 'nav navbar-nav',
								  'walker' => new wp_bootstrap_navwalker())
								);
								?>
                            </div>  
                        </div>
                    </nav>                  
                </div>
            </div>  
        </header>
	
	<div id="content" class="site-content">
