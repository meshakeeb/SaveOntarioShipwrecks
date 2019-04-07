<?php
/**
 * The template for displaying Comments.
 */
?>
<!---##########################-->
<div class="content-indenter">
	<div id="comments-container">

		<?php if (get_comments_number($post->ID) > 0) { ?>
		<div id="comments">

		<h3 id="comments-title"><?php comments_number(__('0 thoughts', 'wpstall'),__('1 thought', 'wpstall'), __('% thoughts', 'wpstall'));?> <?php _e('on','wpstall'); ?> &ldquo;<span><?php the_title(); ?></span>&rdquo;</h3>
		
		<?php if ( post_password_required() ) : ?>
			<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'wpstall' ); ?></p>
		<?php return; endif; ?>

		<?php if ( have_comments() ) : ?>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
						<div class="navigation">
							<div class="nav-previous"><?php previous_comments_link( __( "<span class='meta-nav'>&larr;</span> Older Comments", 'wpstall' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( __( "Newer Comments <span class='meta-nav'>&rarr;</span>", 'wpstall' ) ); ?></div>
						</div> <!-- .navigation -->
			<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'style' => 'li', 'callback' => 'wpstall_comment' ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
						<div class="navigation">
							<div class="nav-previous"><?php previous_comments_link( __( "<span class='meta-nav'>&larr;</span> Older Comments", 'wpstall' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( __( "Newer Comments <span class='meta-nav'>&rarr;</span>", 'wpstall' ) ); ?></div>
						</div><!-- .navigation -->
			<?php endif; // check for comment navigation ?>

		<?php else : // or, if we don't have comments:

			/* If there are no comments and comments are closed,
			 * let's leave a little note, shall we?
			 */
			 $needed_comment_form = 0;
			 if ($needed_comment_form == 1) comment_form(); 
		?>
		
			<?php if ( !comments_open() ) : ?>
				<p class="nocomments"><?php _e( 'Comments are closed.', 'wpstall' ); ?></p>
			<?php endif; // end ! comments_open() ?>
		<?php endif; // end have_comments() ?>
		
		</div>
		<!-- end #comments -->
		<?php } ?>

	<?php comment_form_theme(); ?>

	</div>
</div>
<!---##########################-->	