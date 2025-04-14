<ul class="tm-widget tm-widget-opening-hours tm-widget-opening-hours-compressed opening-hours <?php echo esc_attr( $border_color )?>">
	<?php 
		for ($i=1; $i <= 7 ; $i++) { 
			$day = 'day_'.$i;
			$day_time = 'day_'.$i.'_time';
			if( !empty( $$day ) ) :
	 ?>
			<li class="clearfix">
				<span><?php echo esc_html( $$day ); ?></span>
				<div class="value"><?php echo esc_html( $$day_time ); ?></div>
			</li>
	<?php 
			endif; 
		}
	?>
</ul>
