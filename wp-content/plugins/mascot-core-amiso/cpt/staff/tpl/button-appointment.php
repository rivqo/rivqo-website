<div class="btn-appointment">
    <a <?php if( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_appointment_btn_url_new_window' ) ) { echo 'target="_blank"';} ?> href="<?php the_permalink();?>"
      class="<?php echo esc_attr(implode(' ', $appointment_btn_classes)); ?>">
      <?php echo esc_html( amiso_get_rwmb_group( 'amiso_' . "staff_mb_contact_info", 'staff_appointment_btn_text' ) );?>
    </a>
</div>