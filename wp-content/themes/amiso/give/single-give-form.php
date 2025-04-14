<?php
/**
 * The Template for displaying all single Give Forms.
 *
 * Override this template by copying it to yourtheme/give/single-give-forms.php
 *
 * @package       Give/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

amiso_get_title_area_parts();

/**
 * Fires in single form template, before the main content.
 *
 * Allows you to add elements before the main content.
 *
 * @since 1.0
 */
?>


<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 main-content-area">


<?php
do_action( 'give_before_main_content' );


while ( have_posts() ) :
	the_post();
    $current_page_id = get_the_ID();

    $form_style = amiso_get_rwmb_group( 'amiso_' . "give_form_details_page", 'form_style', $current_page_id );

    if( amiso_metabox_opt_val_is_empty( $form_style ) ) {
        $form_style = amiso_get_redux_option( 'give-form-details-page-style', 'form-style1' );
    }

	give_get_template_part( 'single-give-form/content', $form_style );

endwhile; // end of the loop.

/**
 * Fires in single form template, after the main content.
 *
 * Allows you to add elements after the main content.
 *
 * @since 1.0
 */
do_action( 'give_after_main_content' );
?>

            </div>
        </div>
    </div>
</section>

<?php
/**
 * Fires in single form template, on the sidebar.
 *
 * Allows you to add elements to the sidebar.
 *
 * @since 1.0
 */
do_action( 'give_sidebar' );

get_footer();
