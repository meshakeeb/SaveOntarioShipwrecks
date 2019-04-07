<?php get_header(); ?>

        <?php if (have_posts()) : ?>

        <section id="heading">
            <h1><?php the_title(); ?></h1>
            <p>This is a description.</p>
        </section>

        <section id="about">
            <div class="container">
                
                
                <?php while (have_posts()) : the_post(); ?>
                
                <?php the_content(); ?>
                
                <?php endwhile; ?>
                
            </div>
        </section>

        <?php endif; ?>

<?php get_footer(); ?>