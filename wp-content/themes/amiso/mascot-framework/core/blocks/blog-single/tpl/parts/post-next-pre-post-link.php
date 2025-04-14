<div class="nav-links">
	<div class="prev">
		<?php
			if( $next_pre_link_within_same_cat ) {
				if( !_empty( get_previous_post( true ) ) ){
					previous_post_link('%link', '%title', true );
				}
			} else {
				if( !_empty( get_previous_post() ) ){
					previous_post_link('%link', '%title' );
				}
			}
		?>
	</div>
	<div class="next">
		<?php
			if( $next_pre_link_within_same_cat ) {
				if( !_empty( get_next_post( true ) ) ){
					next_post_link('%link', '%title', true );
				}
			} else {
				if( !_empty( get_next_post() ) ){
					next_post_link('%link', '%title' );
				}
			}
		?>
	</div>
</div>
