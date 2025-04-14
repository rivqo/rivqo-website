
			<?php if ( $show_social_icons ) : ?>
			<?php if ( !empty( $social_icons_list ) ) : ?>
			<ul class="styled-icons icon-dark icon-circled icon-xs icon-theme-colored1 author-social m-0">
				<?php foreach ( $social_icons_list as $each_icon ) : ?>
				<li><a class="styled-icons-item" target="_blank" href="<?php echo esc_url( $each_icon['url'] );?>"><i class="<?php echo esc_html( $each_icon['class'] );?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			<?php endif; ?>