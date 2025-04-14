<?php
/**
 * The template for displaying form content in the single-give-form.php template
 *
 * Override this template by copying it to yourtheme/give/single-give-form/content-single-give-form.php
 *
 * @package       Give/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Fires in single form template, before the form.
 *
 * Allows you to add elements before the form.
 *
 * @since 1.0
 */
do_action( 'give_before_single_form' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

	<div id="give-form-<?php the_ID(); ?>-content" <?php post_class('tm-give-single-form-style2'); ?>>

		<div class="tm-give-single-wrapper">
			<div class="thumb-wrapper">
				<div class="tm-give-single-thumb">
					<?php
					// Featured Thumbnail
					if ( has_post_thumbnail() ) {

						$image_size = give_get_option( 'featured_image_size' );
						$image      = get_the_post_thumbnail( $post->ID, apply_filters( 'single_give_form_large_thumbnail_size', ( ! empty( $image_size ) ? $image_size : 'large' ) ) );

						echo apply_filters( 'single_give_form_image_html', $image );

					} else {

						// Placeholder Image
						echo apply_filters( 'single_give_form_image_html', sprintf( '<img src="%s" alt="%s" />', give_get_placeholder_img_src(), esc_attr__( 'Placeholder', 'amiso' ) ), $post->ID );

					}
					?>
				</div>
				<div class="tm-give-single-progress-goal">
					<?php
						/*$args = array(
							'show_text' => true,
							'show_bar' => false,
							'income_text' => __( 'of', 'bearsthemes-addons' ),
							'goal_text' => __( 'raised', 'bearsthemes-addons' ),
						);*/
						//mascot_core_amiso_elementor_goal_progress( $post->ID, $args );
						echo do_shortcode('[give_goal id="'.$post->ID.'" show_bar="false"]');
						echo do_shortcode('[give_goal id="'.$post->ID.'" show_text="false"]');
					?>
				</div>
			</div>

			<div class="tm-give-form-wrapper">
				<?php
					$atts = array(
						'id' => $post->ID,  // integer.
						'show_title' => false, // boolean.
						'show_goal' => false, // boolean.
						'show_content' => 'none', //above, below, or none
						'display_style' => 'modal', //modal, button, and reveal
						'continue_button_title' => '' //string

					);
					echo give_get_donation_form( $atts );
				?>
			</div>

			<div class="tm-give-single-content">
				<div class="tm-give-single-content-inner">
					<?php the_title( '<h3 class="give-form-title entry-title">', '</h3>' ); ?>
					<?php give_form_display_content( $post->ID, $args = array() ); ?>
				</div>
				<div class="tm-give-single-donor-wall">
					<h5 class="title-recent-donations"><?php esc_html_e( 'Recent Donations', 'amiso' ); ?></h5>
					<?php
						echo do_shortcode('[give_donor_wall form_id="'.$post->ID.'" show_name="true" show_avatar="true" orderby="donation_amount" show_comments="false"]');
					?>
				</div>
			</div>

		</div>
	</div>

<?php
/**
 * Fires in single form template, after the form.
 *
 * Allows you to add elements after the form.
 *
 * @since 1.0
 */
do_action( 'give_after_single_form' );
?>
