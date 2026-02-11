<?php get_header(); ?>

<div class="page-header">
    <div class="container">
        <h1>Blog</h1>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 800px;">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article style="margin-bottom: 40px; padding-bottom: 40px; border-bottom: 1px solid var(--border-light);">
                    <h2 style="font-size: 1.4rem; margin-bottom: 8px;">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 12px;"><?php echo get_the_date(); ?></p>
                    <p style="color: var(--text-secondary);"><?php the_excerpt(); ?></p>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p style="color: var(--text-secondary);">No posts found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
