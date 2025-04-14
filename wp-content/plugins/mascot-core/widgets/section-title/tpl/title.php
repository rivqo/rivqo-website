	<<?php echo esc_attr( $title_tag );?> class="title <?php echo esc_attr(implode(' ', $title_classes)); ?>">

		<?php if ( $title_shadow_text ) { ?>
		<span class="title-shadow-text <?php echo esc_attr(implode(' ', $title_shadow_text_class)); ?>"><?php echo esc_html( $title_shadow_text );?></span>
		<?php } ?>

		<?php if ( $title_text ) { ?>
		<span class="title-part1 <?php echo esc_attr(implode(' ', $title_part1_classes)); ?>"><?php echo ( $title_text );?></span>
		<?php } ?>
		
		<?php 
		foreach (  $title_list as $item ) {
			$title_part_classes = array();
			$title_part_classes[] = 'elementor-repeater-item-'.$item['_id'];
			if( $item['title_other_slide_animation'] == 'yes' ) {
				$title_part_classes[] = 'tm-onappear-slide-animation';
			}
			?>
			<span class="<?php echo esc_attr(implode(' ', $title_part_classes)); ?>"><?php echo esc_html( $item['title_other_text'] );?></span>
		<?php } ?>

	</<?php echo esc_attr( $title_tag );?>>
	<div class="title-seperator-line"></div>