<div class="tm-sc-section-title section-title <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="title-wrapper">
		<?php if( $show_title_icon == 'yes' && $title_icon_position == 'icon-top'  && isset( $title_icon ) && !empty( $title_icon ) ): ?>
		<?php include('title-icon.php');?>
		<?php endif; ?>
		<?php if( $sub_title_position == 'above-title' ) include('sub-title.php'); ?>
		<?php include('title.php');?>
		<?php if( $sub_title_position == 'below-title' ) include('sub-title.php'); ?>
		<?php include('paragraph.php');?>
	</div>
</div>