<?php
/**
 * A custom WordPress comment walker class to implement the Bootstrap 3 Media object in wordpress comment list.
 *
 * @package     WP Bootstrap Comment Walker
 * @version     1.0.0
 * @author      Edi Amin <to.ediamin@gmail.com>
 * @license     http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link        https://github.com/ediamin/wp-bootstrap-comment-walker
 */

if( !class_exists( 'Amiso_Bootstrap_Comment_Walker' ) ) {
class Amiso_Bootstrap_Comment_Walker extends Walker_Comment {
	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @access protected
	 * @since 1.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment Comment to display.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '' ); ?>>
			<div class="comment-item-wrapper">
				<?php if ( 0 != $args['avatar_size'] ): ?>
				<div class="comment-thumb">
					<a href="<?php echo get_comment_author_url(); ?>">
						<?php echo get_avatar( $comment, $args['avatar_size'], '', false, array( 'class' => 'media-object' )  ); ?>
					</a>
				</div>
				<?php endif; ?>

				<div id="div-comment-<?php comment_ID(); ?>">
					<div class="comment-body">
						<ul class="list-inline float-none float-sm-end comment-reply-link">
							<?php edit_comment_link( esc_html__( 'Edit', 'amiso' ), '<li class="list-inline-item edit-link">', '</li>' ); ?>

							<?php
								comment_reply_link( array_merge( $args, array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<li class="list-inline-item reply-link">',
									'reply_text'=> sprintf(esc_html__('Reply %s', 'amiso'), ''),
									// 'reply_text'=> sprintf(esc_html__('Reply %s', 'amiso'), '<i class="fa fa-long-arrow-right"></i>'),
									'after'     => '</li>'
								) ) );
							?>

						</ul>

						<?php printf( '<h5 class="comment-author-name">%s</h5>', get_comment_author_link() ); ?>

						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'amiso' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
						</div><!-- .comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation label label-info"><?php esc_html_e( 'Your comment is awaiting moderation.', 'amiso' ); ?></p>
						<?php endif; ?>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->
					</div>
				</div>
			</div>
<?php
	}
}
}
