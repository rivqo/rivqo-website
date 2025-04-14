
	<?php if ( $show_working_hours == 'yes' ) { ?>
	<?php
	//working hours
	$working_hours_array = array();
	for ($i=1; $i <= 7 ; $i++) {
		$day = amiso_get_rwmb_group( 'amiso_' . "staff_mb_working_hours", 'staff_opening_hours_day_'.$i );
		$day_time = amiso_get_rwmb_group( 'amiso_' . "staff_mb_working_hours", 'staff_opening_hours_day_'.$i.'_time' );
		if( !empty( $day ) ) :
		$working_hours_array[$day] = $day_time;
		endif;
	}
	if( !empty( $working_hours_array ) ) :
	?>
	<div class="staff-working-hours">
		<ul class="working-hours">
			<?php foreach( $working_hours_array as $day => $day_time ) { ?>
			<li class="clearfix">
				<span><?php echo esc_html( $day ); ?></span>
				<div class="value"><?php echo esc_html( $day_time ); ?></div>
			</li>
			<?php } ?>
		</ul>
	</div>
	<?php endif; ?>
	<?php } ?>