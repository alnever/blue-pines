<?php
/**
* Header of the Blue Pines Theme
*
* The file contains the definitions of the main loop of the theme
*
* @package SWTK
* @subpackage blue_pines
* @since Funny Colors 1.0
*/
 ?>
<!-- header -->
<header class="swtk-header" style="background-image:url( <?php header_image(); ?> );">
    <div class="swtk-header-logo">
        <?php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            if ($custom_logo_id) {
                $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
                echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="">';
            }
        ?>
    </div>
    <div class="swtk-header-text-block">
        <div class="swtk-social-menu">
            <!-- TODO:: insert social menu -->
        </div>
        <div class="swtk-header-title" style="color: #<?php header_textcolor(); ?>">
            <?php bloginfo('name'); ?>
        </div>
        <div class="swtk-header-text">
            <?php bloginfo('description'); ?>
        </div>
    </div>
</header>
