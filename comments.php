<?php

	if ( post_password_required() ) {
		return;
	}

	require_once(get_template_directory() . '/functions/class-wp-comment-walker.php');

	// Customise Login Form

	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$fields = array(

  		'author' => '<div class="form-group"><label for="author" class="comment-form-author wp-comment-title">' . __( 'Name', 'domainreference' ) .
    				( $req ? '<span class="wp-comment-required">*</span>' : '' ) . '</label>' .
    				'<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) .
    				'" size="30"' . $aria_req . ' /></div>',

  		'email' => '<div class="form-group"><label class="comment-form-email wp-comment-title" for="email">' . __( 'Email', 'domainreference' ) .
    				( $req ? '<span class="wp-comment-required">*</span>' : '' ) . '</label>' .
    				'<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    				'" size="30"' . $aria_req . ' /></div>',
	
		'url' => ''
	);

	// Set Up Comment Form
	$comments_args = array(
		'title_reply_before' => '<h6 class="wp-comment-title">',
		'title_reply_after' => '</h6>',
  		'comment_notes_after' => '',
  		'logged_in_as' => '',
  		'comment_field' => '<div class="form-group"><textarea class="form-control" rows="10" cols="50" id="comment" name="comment" aria-required="true"></textarea></div>',
  		'submit_button' => '<input class="btn float-right wp-comment-submit-btn" name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
  		'label_submit' => 'Submit',
  		'fields' => $fields
	)	
?>

<div id="comments" class="wp-comments-area">

	<?php if ( have_comments() ) : ?>
		<h5 class="wp-comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One comment on %s', 'comments title'), get_the_title());
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s comment on %2$s',
							'%1$s comments on %2$s',
							$comments_number,
							'comments title',
							'twentysixteen'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h5>

		<ol class="list-unstyled">
			<?php 
  				wp_list_comments( array(
      				'style'         => 'ol',
      				'max_depth'     => 8,
      				'short_ping'    => true,
      				'avatar_size'   => '50',
     				'walker'        => new Comment_Walker(),
  				));
			?>
		</ol>

		<div class="wp-paginate">
			<?php paginate_comments_links(); ?>
		</div>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="wp-no-comments"><?php _e( 'Comments are closed.'); ?></p>
	<?php endif; ?>

	<?php comment_form($comments_args); ?>

</div><!-- .comments-area -->
