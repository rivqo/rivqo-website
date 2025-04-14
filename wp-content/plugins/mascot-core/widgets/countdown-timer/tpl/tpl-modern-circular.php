<?php
	$random_number = wp_rand( 111111, 999999 );
	date_default_timezone_set('Asia/Dhaka');
	if( !empty( $thisparent->get_instance_value_skin( 'timezone' ) ) ) {
		date_default_timezone_set($thisparent->get_instance_value_skin( 'timezone' ));
	}

	$end_time = DateTime::createFromFormat("Y/m/d H:i:s", $countdown_future_date_time);
	$end_timestamp = $end_time->getTimestamp();
	$start_timestamp = $end_timestamp - 8553600;

	$now = new DateTime();
	$now_timestamp = $now->getTimestamp();
?>

<div class="tm-sc-countdown-timer final-countdown-modern-circular <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div id="final-countdown-clock-<?php echo esc_attr( $random_number.'-'.get_the_ID() );?>" class="countdown countdown-container container"
		data-start="<?php echo esc_attr( $start_timestamp );?>"
		data-end="<?php echo esc_attr( $end_timestamp );?>"
		data-now="<?php echo esc_attr( $now_timestamp );?>"

		data-borderwidth="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'borderwidth' ) );?>"
		data-bordercolor-second="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'bordercolor_second' ) );?>"
		data-bordercolor-minutes="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'bordercolor_minutes' ) );?>"
		data-bordercolor-hours="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'bordercolor_hours' ) );?>"
		data-bordercolor-days="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'bordercolor_days' ) );?>">
		<div class="clock row">
			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="clock-item clock-days countdown-time-value">
					<div class="wrap">
						<div class="inner">
							<div id="canvas-days" class="clock-canvas"></div>

							<div class="text">
								<p class="val">0</p>
								<p class="type-days type-time"><?php echo esc_attr( $word_day );?></p>
							</div><!-- /.text -->
						</div><!-- /.inner -->
					</div><!-- /.wrap -->
				</div><!-- /.clock-item -->
			</div>

			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="clock-item clock-hours countdown-time-value">
					<div class="wrap">
						<div class="inner">
							<div id="canvas-hours" class="clock-canvas"></div>

							<div class="text">
								<p class="val">0</p>
								<p class="type-hours type-time"><?php echo esc_attr( $word_hr );?></p>
							</div><!-- /.text -->
						</div><!-- /.inner -->
					</div><!-- /.wrap -->
				</div><!-- /.clock-item -->
			</div>

			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="clock-item clock-minutes countdown-time-value">
					<div class="wrap">
						<div class="inner">
							<div id="canvas-minutes" class="clock-canvas"></div>

							<div class="text">
								<p class="val">0</p>
								<p class="type-minutes type-time"><?php echo esc_attr( $word_min );?></p>
							</div><!-- /.text -->
						</div><!-- /.inner -->
					</div><!-- /.wrap -->
				</div><!-- /.clock-item -->
			</div>

			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="clock-item clock-seconds countdown-time-value">
					<div class="wrap">
						<div class="inner">
							<div id="canvas-seconds" class="clock-canvas"></div>

							<div class="text">
								<p class="val">0</p>
								<p class="type-seconds type-time"><?php echo esc_attr( $word_sec );?></p>
							</div><!-- /.text -->
						</div><!-- /.inner -->
					</div><!-- /.wrap -->
				</div><!-- /.clock-item -->
			</div>
		</div><!-- /.clock -->
	</div><!-- /.countdown-wrapper -->
</div>