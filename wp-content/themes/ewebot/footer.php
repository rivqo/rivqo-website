        </div><!-- .main_wrapper -->
	</div><!-- .site_wrapper -->
	<?php


			$footer = apply_filters('theme/print_footer', false);

			if (false === $footer) {
				gt3_get_default_footer();
			}


	wp_footer();

    ?>
</body>
</html>
