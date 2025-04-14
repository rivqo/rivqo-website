<?php if (get_the_author_meta('description')) : // Checking if the user has added any author descript or not. If it is added only, then lets move ahead ?>
	<div class="author-info">
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-thumb">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?>
		</a>
		<div class="author-description">
			<h4 class="author-title">
				<span class="author-title-label"><?php esc_html_e('About Author:', 'amiso' ); ?></span>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="">
					<?php
						if( get_the_author_meta( 'first_name' ) != "" || get_the_author_meta( 'last_name' ) != "" ) {
							echo esc_attr( get_the_author_meta( 'first_name' ) ) . ' ' . esc_attr( get_the_author_meta( 'last_name' ) );
						} else {
							echo esc_attr( get_the_author_meta( 'display_name' ) );
						}
					?>
				</a>
			</h4>
			<?php if ( $show_author_email ) : ?>
			<p class="author-email"><a href="mailto:<?php echo esc_attr( get_the_author_meta( 'user_email' ) ); ?>"><?php echo esc_html( get_the_author_meta( 'user_email' ) ); ?></a></p>
			<?php endif; ?>
			<div class="author-text"><p><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p></div>

			<?php if ( $show_social_icons ) : ?>
			<?php if ( !empty( $social_icons_list ) ) : ?>
			<ul class="styled-icons square-sm author-social m-0">
				<?php foreach ( $social_icons_list as $each_icon ) : ?>
				<li><a class="styled-icons-item" target="_blank" href="<?php echo esc_url( $each_icon['url'] );?>"><i class="<?php echo esc_html( $each_icon['class'] );?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="clearfix"></div>
	</div>
<?php endif; ?>