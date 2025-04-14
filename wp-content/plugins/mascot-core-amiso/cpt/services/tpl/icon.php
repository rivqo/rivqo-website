	<?php if ( isset($service_icon_array_new[get_the_ID()]) ) : ?>
		<div class="icon"><?php \Elementor\Icons_Manager::render_icon( $service_icon_array_new[get_the_ID()], [ 'aria-hidden' => 'true' ] ); ?></div>
	<?php endif; ?>