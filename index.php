<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rtCamp
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="welcome-area">
                <div class="container">
                    <div class="row row-eq-height custom-border">
                        <div class="col-sm-12 col-md-12 col-lg-8 no-padding">
                            <div id="mainCarousel" class="carousel slide" data-ride="carousel">
                                  <!-- The slideshow -->
                                  <div class="carousel-inner">
                                        <?php $i = 0 ?>
                                        <?php $slider = new WP_Query( 'post_type=Slideshow&posts_per_page=4' );
                                        if ( $slider->have_posts() ):
                                        while ( $slider->have_posts() ): $slider->the_post(); ?>
                                    <div class="<?php echo $i == 0 ? 'active' : '' ?> carousel-item">
                                      <img src="<?php the_post_thumbnail_url(); ?>" alt="" class="img-fluid">
                                    </div>
                                    <?php $i ++; 
                                    endwhile; 
                                    else: echo '<img src="http://via.placeholder.com/800x500" alt="pagethumbnail"  />';
                                    endif;
                                    wp_reset_postdata(); 
                                    ?>
                                  </div>

                                  <!-- Indicators -->
                                  <ul class="carousel-indicators">
                                    <?php $entries = $slider->post_count; ?>
                                    <?php for ( $i = 0; $i < $entries; $i ++ ) { ?>
                                    <li data-target="#mainCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : '' ?>"></li>
                                    <?php } ?>
                                  </ul>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4 welcome-text">
                                 <?php
                                    $ID = get_option('static_page');
                                    $title = get_the_title($ID);
                                    echo '<h3 style="font-weight:bold;">' . $title . '</h3>';
                                    $page_data = get_page($ID);
                                    $post_thumbnail_id = get_post_thumbnail_id($ID);
                                    if ($post_thumbnail_id) {
                                        echo '<img src="' . wp_get_attachment_image_url($post_thumbnail_id, 'post-thumbnail') . '" alt="pagethumbnail" class="welcome-img float-left img-fluid" />';
                                    }
                                    else{
                                        echo "";
                                    }
                                    
                                    $string = apply_filters('the_content', $page_data->post_content);
                                    if (strlen($string) > 25) {
                                        $trimstring = substr($string, 0, 450) . ' <a href="' . get_permalink($ID) . '">
                                        Read More...</a>';
                                    } else {
                                        $trimstring = $string;
                                    }
                                    echo '<p>' . $trimstring . '</p>';
                                    ?>
                        </div>



                    </div>
                </div>
            </section>

			 <section class="video-section">
                <div class="container">
                    <div class="row">
                        <hr class="divider">
                        <div class="video-slider" data-aos="fade-up">
                            <?php
                            add_thickbox();
                            $url = get_option('youtube_slider');
                             if($url== false || count(array_filter($url)) == 0){?>
                                <div>
                                        <a title='Youtube Video' href='https://www.youtube.com/embed/qzq0kEUa5lU; ?>?wmode=transparent&TB_iframe=true' class="thickbox">
                                            <img class="video" src="http://img.youtube.com/vi/qzq0kEUa5lU/default.jpg">
                                        </a>
                                    </div>
                            <?php }else{

                            $x = 0;
                            foreach ($url as $key) { if(!empty($key)){
                            parse_str(parse_url($key, PHP_URL_QUERY), $output);
                            
                                ?>
                                    <div>
                                        <a title='Youtube Video' href='https://www.youtube.com/embed/<?php echo $output['v']; ?>?wmode=transparent&TB_iframe=true' class="thickbox">
                                            <img class="video" src="http://img.youtube.com/vi/<?php echo $output['v']; ?>/default.jpg">
                                        </a>
                                    </div>
                                <?php  }} }?>
                            </div>
                        <hr class="divider">
                    </div>
                </div>
            </section>

            <section class="exhibition-section">
                <div class="container p-0">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="title">Glimpses of Exhibition</h3>
                            <div class="row row1" data-aos="fade-up">
                                <?php  
                                $args = array( 'post_type' => 'Exhibitions', 'posts_per_page' => 8 );
                                $the_query = new WP_Query( $args );
                                if ( $the_query->have_posts() ):
                                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <div class="item col-lg-3">
                                    <figure class="thumbnail">
                                        <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="img-golf" title="golf" />
                                        <figcaption><a href="#"><?php the_title(); ?></a></figcaption>
                                    </figure>
                                </div>
                                <?php endwhile; ?>
                                <?php else: echo "No Post Found"; ?>
                                <?php endif; ?>
                            </div>

                              

                            <hr class="divider">

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="twitter-widget" data-aos="fade-up">                                     
                                        <h3 class="title">Latest Tweets</h3>
                                        <?php if(get_option( 'twitter_username' )): ?>
                                        <div class="marquee">
                                        <div>
                                        <a class="twitter-timeline" href="https://twitter.com/<?php echo get_option( 'twitter_username' ); ?>?ref_src=twsrc%5Etfw">Tweets by AM_Navin</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                        </div>
                                        </div>
                                        <?php else: echo "Add Twitter Username in theme options"; ?>
                                        <?php endif;?>
                                    </div>
                                </div>

                                <div class="col-sm-7 fb-widget" data-aos="fade-up">
                                    <h3 class="title">Follow us on Facebook</h3>
                                    <div class="fb-widget">
                                        <?php if(get_option( 'fb_username' )): ?>
                                      <div class="fb-page" data-href="https://www.facebook.com/<?php echo get_option( 'fb_username' ); ?>"
                                        data-tabs="timeline"
                                        data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                                        data-show-facepile="true">
                                        <blockquote cite="https://www.facebook.com/<?php echo get_option( 'fb_username' ); ?>"
                                                    class="fb-xfbml-parse-ignore"><a
                                                    href="https://www.facebook.com/<?php echo get_option( 'fb_username' ); ?>">I&#039;m
                                                mediocre</a></blockquote>
                                        </div>
                                        <?php else:echo "Add Facebook Username in theme options"; ?>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>

            <!-- Right Sidebar Start -->
                        <div class="col-lg-4 right-sidebar">
                            <div class="news-widget" data-aos="fade-up">
                                <h3 class="title">News</h3>
                                <div id="myCarouselnews" class="carousel slide">
                                    <div class="carousel-inner">
                                
                                                <div class="carousel-item active">
                                            <div class="news-main">
                                                <?php
                                                $args = array(
                                                            'post_type'      => 'post',
                                                            'post__in'  => get_option( 'sticky_posts' ),
                                                            'ignore_sticky_posts' => 1
                                                    );
                                                $the_query = new WP_Query( $args ); 
                                                if ( $the_query->have_posts() ):
                                                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                                <div class="col-md-4 p-0">
                                                    <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="">
                                                </div>
                                                <div class="col-md-8 pr-0">
                                                    <div class="news-heading">
                                                        <a href="#"><p><?php the_title(); ?></p>
                                                        <span><?php the_date(); ?></span></a>
                                                    </div>
                                                </div>
                                                <?php endwhile;
                                                else: echo "No Post Found";
                                                endif;?>    
                                                </div>
                                                <div class="news-list">
                                                    
                                                    <ul>
                                                        <?php if ( have_posts() ): ?>
                                                    <?php
                                                    $args      = array( 'category_name' => 'News', 'posts_per_page' => 8 );
                                                    $the_query = new WP_Query( $args );
                                                    ?>
                                                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?> 
                                                        <li><a href="<?php the_permalink(); ?>"> <?php the_title(); ?>
                                                            </a>
                                                        </li>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                    </ul>
                                                    
                                                </div>
                                            </div>

                                    </div>

                                        <div class="news-bottom">
                                                <a class="" href="#myCarouselnews" data-slide="prev"><img alt="left arrow" src="wp-content/themes/rtcamp/images/left-arrow-news.png" /></a>
                                                <a class="" href="#myCarouselnews" data-slide="next"><img alt="right arrow" src="wp-content/themes/rtcamp/images/right-arrow-news.png" /></a>
                                                <a class="more-news float-right" href="#">More News</a>
                                            </div>

                                </div>
                                <hr class="divider">
                            </div>

                            
 
                            <div class="date-widget" data-aos="fade-up">
                                <h3 class="title">Date And Time</h3>
                               <?php if (is_active_sidebar('date_widget')) :
                                     dynamic_sidebar('date_widget'); 
                                     else: echo "Activate Date and Time Widget";
                                     endif;
                                 ?>
                            </div>

                        </div>
            <!-- Right Sidebar End -->

                    </div>
                    <hr class="divider">
                </div>
            </section>
				
			<section class="partners">
                <div class="container">
                    <div class="row" ><h3 class="title" style="width: 100%;">Our Partners</h3>
                        <div class="partners-slider" data-aos="fade-up">
                            
                             <?php
                                $args = array( 'post_type' => 'Partners', 'posts_per_page' => 8 );
                                $the_query = new WP_Query( $args );
                                if ( $the_query->have_posts() ):    
                                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>   
                            <div>
                                <img class="partners" src="<?php the_post_thumbnail_url(); ?>" alt="sport video">
                            </div>
                            <?php endwhile; ?>
                            <?php else: echo "No Post Found"; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr class="divider">
                </div>
            </section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
