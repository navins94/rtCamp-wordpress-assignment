<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rtCamp
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer rtcamp-footer">
		<div class="container">
                <div class="row pt-4 pb-4">
                    <div class="col-lg-4 col-md-6 pages-footer">
                        <?php if (is_active_sidebar('footer-left-widget')) : ?>
                        <h3 class="footer-head">Pages</h3>
                           <?php dynamic_sidebar('footer-left-widget'); ?>
                         <?php else:echo "Activate Footer"; ?>  
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-4 col-md-6 links-footer">
                        <?php if (is_active_sidebar('footer-center-widget')) : ?>
                        <h3 class="footer-head">Important Links</h3>
                           <?php dynamic_sidebar('footer-center-widget'); ?>
                        <?php endif; ?>
                    </div>

                    <?php if (is_active_sidebar('footer-right-widget')) : ?>
                    <div class="col-lg-4 col-md-12 text-center">
                           <?php dynamic_sidebar('footer-right-widget'); ?>                    
                        <div class="copyrights">
                        <?php
                        echo do_shortcode('[rt-link url="http://anything.com" title="Terms of Use"]');
                        ?></div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="disclaimer">
                <div class="container">
                    <p><span style="font-weight: bold;font-size: 13px;">Disclaimer:</span> Sit arcu nec cras elit? Vut sagittis magna
                    nisi vel integer arcu? Dis pulvinar scelerisque pulvinar
                    rhoncus integer, integer in? Ac, cum etiam tortor duis
                    placerat mid nunc cras integer, aliquam porttitor. Dis
                    pulvinar scelerisque pulvinar rhoncus integer, integer
                    in? Ac, cum etiam tortor duis placerat mid nunc cras
                    integer, aliquam porttitor.</p>
                </div>
            </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
        AOS.init({
            duration: 600,
            once: true,
            easing: 'ease-in',
        });
        </script>
</body>
</html>
