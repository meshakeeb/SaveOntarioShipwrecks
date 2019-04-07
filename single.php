<?php 
global $shortname;
$current_user = wp_get_current_user();
acf_form_head();
get_header(); 
if (have_posts()) : 
    while (have_posts()) : the_post(); ?>

	<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1><?php the_title(); ?></h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
								<li><span>Blog</span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	<?php 
        if( isset( $_GET['post'] ) && !empty( $_GET['post'] ) && !isset( $_GET['updated'] ) && empty( $_GET['updated'] ) && $current_user->has_cap('publish_chapters') ):
            echo '<div class="container">';
                acf_form(array(
                    'post_id'	   => $_GET['post'], //Variable that you'll get from the URL
                    'post_title'   => true,
                    'post_content' => true,
                    'fields'       => array('_thumbnail_id', 'add_multiple_attachments', 'attachment', 'attachments' ),          
                    'submit_value' => 'Update Content'
                )); 
            echo '</div>';
        else:
    ?>
	<div class="about-single">
		<div class="container row-eq-height">
			<div class="col-md-8 col-sm-7 blog-single">

				<?php if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail( 'full', array( 'class' => 'featured-image img-full' ) ); ?>
                <?php } else { ?>
				<img src="<?php bloginfo('template_url'); ?>/images/news-default.png" class="featured-image img-full" />
				<?php } ?>

                <h1 class="post-title"><?php the_title(); ?></h1>
				<?php if ( in_array( 'administrator', (array) $current_user->roles ) ) { ?> 
                <a href="<?php the_permalink(); ?>?post=<?php echo get_the_ID(); ?>" class="edit-btn">Edit Post</a>
				<?php } ?>
				<div class="post-meta">Published on <a href="#"><?php the_time('F j, Y'); ?></a></div>
					
                <?php the_content(); ?>
				
				<?php if ( get_field('add_multiple_attachments') ) { ?>
				
				<?php if( have_rows('attachments') ): ?>
				
				<hr/>
				
				<h3 class="heading">Attachments</h3>
				
				<?php while ( have_rows('attachments') ) : the_row(); ?>
				<?php 
					$multifile = get_sub_field('multi_attachment');
					$url = $multifile['url'];
					$title = $multifile['title'];
					$caption = $multifile['caption']; 
				?>
				
				<p><a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a></p>
				
				<?php endwhile; ?>
				<?php endif; ?>
				
				<?php } else { ?>
				
				<?php if ( get_field('attachment') ) { ?>
				
				<hr/>
				
				<h3 class="heading">Attachment</h3>
				
				<?php
					$file = get_field('attachment');
					$url = $file['url'];
					$title = $file['title'];
					$caption = $file['caption']; 
				?>
				
				<p><a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a></p>
				
				<?php } ?>
				
				<?php } ?>

                <div class="nav-post">
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                        	<?php previous_post_link('%link', '<i class="fa fa-arrow-left"></i> prev'); ?>
                        </div>
                        
                        <div class="col-sm-4 hidden-xs text-center">
                        	&nbsp;
                        </div>
                        
                        <div class="col-sm-4 col-xs-6 text-right">
                        	<?php next_post_link('%link', 'next <i class="fa fa-arrow-right"></i>'); ?>
                        </div>
                    </div>
                </div>
			</div>
                <div class="col-md-4 col-sm-5 about-single-sidebar">
                    <div class="sidebar">
                        <?php dynamic_sidebar( 'news-sidebar' ); ?>
                    </div>
                </div>
		</div>
	</div>
    <?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
