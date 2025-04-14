<li data-date="<?php echo esc_html( $date ); ?>" class="each-timeline-content <?php if($selected === 'yes') { echo esc_html( 'selected' ); }?>">
<div class="">
      <?php
        if ( $tabs_content_type == 'content' ) {
            echo do_shortcode( $tabs_content );
        } else if ( $tabs_content_type == 'template' ) {
            $id = $tabs_content_templates;
            $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($id);
            echo $content;
        }
      ?>
</div>
</li>