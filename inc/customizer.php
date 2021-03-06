<?php
/**
 * materialwp Theme Customizer
 *
 * @package materialwp
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function materialwp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /* Section for Layout settings */
    $wp_customize->add_section( 'layout' , array(
        'title' => 'Layout',
        'description' => 'Options for your layout site/blog',
        'capability' => 'edit_theme_options',
    ) );

	$wp_customize->add_setting( 'navigation_background_color',
         array(
            'default' => '#3f51b5',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_setting( 'complimentary_color',
         array(
            'default' => '#ff5722',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_setting( 'link_color',
         array(
            'default' => '#3f51b5',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
        )
    );

    /* Setting for Archive Layout */
    $wp_customize->add_setting( 'archive_layout',
         array(
            'default' => 'column_3',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
        )
    );

    /* Setting for Sidebar Layout */
    $wp_customize->add_setting( 'sidebar_layout',
         array(
            'default' => 'with_sidebar',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_background_color', array(
		'label' => __( 'Navigation Background Color', 'materialwp' ),
		'section' => 'colors',
		'settings' => 'navigation_background_color',
	)));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'complimentary_color', array(
		'label' => __( 'Complimentary Color', 'materialwp' ),
		'section' => 'colors',
		'settings' => 'complimentary_color',
	)));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label' => __( 'Link Color', 'materialwp' ),
		'section' => 'colors',
		'settings' => 'link_color',
	)));

    /* Control for Archive Layout */
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'archive_layout', array(
        'label' => __( 'Archive Layout', 'materialwp' ),
        'section' => 'layout',
        'settings' => 'archive_layout',
        'type'    => 'select',
        'choices'    => array(
            'column_1' => 'One column',
            'column_2' => 'Two columns',
            'column_3' => 'Three columns',
            'column_4' => 'Four columns',
        ),
    )));

    /* Control for Sidebar Layout */
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'sidebar_layout', array(
        'label' => __( 'Sidebar Layout', 'materialwp' ),
        'section' => 'layout',
        'settings' => 'sidebar_layout',
        'type'    => 'select',
        'choices'    => array(
            'with_sidebar' => 'With sidebar',
            'full' => 'Full Width',
        ),
    )));

}
add_action( 'customize_register', 'materialwp_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function materialwp_customize_preview_js() {
	wp_enqueue_script( 'materialwp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'materialwp_customize_preview_js' );

function materialwp_customize_colors(){

?>
<style type="text/css">
.navbar-inverse.navbar { background-color: <?php echo get_theme_mod('navigation_background_color'); ?>; }
.panel-warning>.panel-heading { background-color: <?php echo get_theme_mod('complimentary_color'); ?>; }
.btn-warning:not(.btn-link):not(.btn-flat), .btn-warning:hover:not(.btn-link):not(.btn-flat), .btn-warning:active:not(.btn-link):not(.btn-flat) { background-color: <?php echo get_theme_mod('complimentary_color'); ?>; }
.entry-content a, .panel a { color: <?php echo get_theme_mod('link_color'); ?>; }
.entry-content a:hover, .entry-content a:focus, .entry-content a:active, .panel a:hover, .panel a:focus, .panel a:active; { color: <?php echo get_theme_mod('link_color'); ?>; }
</style>
<?php
}
add_action( 'wp_head', 'materialwp_customize_colors' );
