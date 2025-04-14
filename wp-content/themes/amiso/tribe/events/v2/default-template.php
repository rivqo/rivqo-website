<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 */

get_header();
amiso_get_title_area_parts();
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-content-area">
                    <?php
                    if ( class_exists( '\Tribe\Events\Views\V2\Template\Page' ) && function_exists( 'tribe' ) ) {
                        echo tribe( \Tribe\Events\Views\V2\Template_Bootstrap::class )->get_view_html();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
