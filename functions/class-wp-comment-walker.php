<?php

class Comment_Walker extends Walker_Comment {
	
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( $args['style'] === 'div' ) ? 'div' : 'li';
?>		
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'has-children' : 'no-children' ); ?>>
			
			<div class="mt-3 wp-comment" id="div-comment-<?php comment_ID(); ?>">
				<div class="card wp-comment-item">
					<div class="card-body">
						<a href="<?php echo get_comment_author_url(); ?>" class="float-left"><?php echo get_avatar( $comment, $args['avatar_size'],'mm','', array('class'=>"comment_avatar rounded mr-3") ); ?></a>
						<span class="wp-comment-author"><?php echo get_comment_author_link() ?></span>
						<a class="wp-comment-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>"><?php comment_date() ?> at <?php comment_time() ?></time>
						</a>
						<div class="wp-comment-content"><?php comment_text(); ?></div>
						<div class="wp-reply-link pull-right">
							<?php
								comment_reply_link( array_merge( $args, array(
									'depth'     => $depth,
									'max_depth' => $args['max_depth']
								)));	
							?>

						</div>
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<div class="alert alert-warning mb-0"><?php _e( 'Your comment is awaiting moderation.' ); ?></div>
						<?php endif; ?>	
					</div>
				</div>				
<?php
	}	
}