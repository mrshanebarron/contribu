<?php get_header(); ?>

<div class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 800px;">
        <?php while (have_posts()) : the_post(); ?>
            <div style="color: var(--text-secondary); line-height: 1.8; font-size: 1rem;">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
