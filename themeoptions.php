<?php

function mythemeoptions(){
    add_menu_page( "theme-options", //page title
        "Theme Options",  //Menu Title
        "manage_options", //capability
        "theme-options", //menu slug
        "mycustom_options", // callback functions
         "dashicons-sticky" //icons
     );
}
add_action( "admin_menu", "mythemeoptions");

function mycustom_options(){
        ?>
        <div>
            <h1>Theme Options</h1>
            <span><?php settings_errors(); ?></span>
            <form action="options.php" method="post">
                <?php settings_fields("section");
                      do_settings_sections( "theme-options" );
                      submit_button();
                 ?>
            </form>
        </div>
        <?php

        
}

//Theme options settings page
function theme_options_settings(){
    add_settings_section( "section", //id of setings page
        "All page", //title
        null, //callback function
        "theme-options" //page
    );

    add_settings_field(
        "fb_username", //title
        "Fb Username", //callback function
        "display_fb_name", //page
        "theme-options",
        "section"
    );

    add_settings_field(
        "twitter_username", //title
        "Twitter Username", //callback function
        "display_twitter_name", //page
        "theme-options",
        "section"
    );

    add_settings_field(
        "static_page", //title
        "Static Page", //callback function
        "display_static_page", //page
        "theme-options",
        "section"
    );

    add_settings_field(
        "youtube_slider", //title
        "Youtube Slider", //callback function
        "youtube_slider", //page
        "theme-options",
        "section"
    );

    register_setting("section",
        "fb_username"
    );
     register_setting("section",
        "twitter_username"
    );
     register_setting("section",
        "static_page"
    );
     register_setting("section",
        "youtube_slider"
    );
     register_setting("section",
        "youtube_slider2"
    );
     register_setting("section",
        "youtube_slider3"
    );
     register_setting("section",
        "youtube_slider4"
    );
     register_setting("section",
        "youtube_slider5"
    );
     register_setting("section",
        "youtube_slider6"
    );
}

add_action("admin_init", "theme_options_settings");

function display_fb_name(){
    ?>
    <input type="text" name="fb_username" value="<?php echo get_option( "fb_username" ); ?>" id="fb_username" />
    <?php
}

function display_twitter_name(){
    ?>
    <input type="text" name="twitter_username" value="<?php echo get_option( "twitter_username" ); ?>" id="twitter_username" />
    <?php
}

function display_static_page(){

    ?>
    <select id="pages" name="static_page">
        <option value="">
            <?php echo esc_attr( __( 'Choose Page' ) ); ?></option>
        <?php
        $pages = get_pages();

        foreach ( $pages as $page ) {
            $option = '<option value="' . $page->ID . '">';
            $option .= $page->post_title;
            $option .= '</option>';
            echo $option;
        }
        ?>
    </select>
    <?php

}

function youtube_slider() {
    
    for($x = 0 ;$x < 5; $x++){ ?>
    
    <input id="video1" type="text" name="youtube_slider[]" value="<?php echo get_option( "youtube_slider" )[$x]; ?>" /><br>

   <?php }


}


?>
