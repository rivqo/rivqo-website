<ul class="tm-sc-opening-hours tm-sc-opening-hours-compressed opening-hours <?php echo esc_attr( $border_color )?> <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php
		for ($i=1; $i <= 7 ; $i++) {
			$day = 'day_'.$i;
			$day_time = 'day_'.$i.'_time';
			if( !empty( $$day ) ) :
	 ?>
			<li>
				<div class="day"><?php echo esc_html( $$day ); ?></div>
				<div class="time"><?php echo esc_html( $$day_time ); ?></div>
			</li>
	<?php
			endif;
		}
	?>
</ul>
