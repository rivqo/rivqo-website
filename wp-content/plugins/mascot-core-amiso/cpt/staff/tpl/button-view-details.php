<div class="btn-view-details">
    <a href="<?php the_permalink();?>"
      class="<?php echo esc_attr(implode(' - ', $btn_classes)); ?>">
      <?php echo esc_html( $view_details_button_text  ); ?>
    </a>
</div>