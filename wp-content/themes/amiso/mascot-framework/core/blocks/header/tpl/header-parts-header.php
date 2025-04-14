	<!-- Header -->
	<?php
		/**
		* amiso_before_header hook.
		*
		*/
		do_action( 'amiso_before_header' );
	?>
	<header id="header" class="header <?php echo esc_attr(implode(' ', $header_classes)); ?>" <?php if( $params['header_layout_type'] == 'header-vertical-nav' ) { ?> style="<?php echo esc_attr( $vertical_nav_bgcolor ); ?> <?php echo esc_attr( $vertical_nav_bgimg ); ?>" <?php } ?>>
		<?php
			/**
			* amiso_header_start hook.
			*
			*/
			do_action( 'amiso_header_start' );
		?>
		<?php
			/**
			* amiso_header_top_area hook.
			*
			* @hooked amiso_get_header_top
			*/
			do_action( 'amiso_header_top_area' );
		?>
		<?php
			amiso_get_header_layout_type();
		?>

		<?php
			/**
			* amiso_header_end hook.
			*
			*/
			do_action( 'amiso_header_end' );
		?>
	</header>
	<?php
		/**
		* amiso_after_header hook.
		*
		*/
		do_action( 'amiso_after_header' );
	?>