<?php
get_header('main');
?>
<main class="mm-tenants-page">
<?php
    $term = get_queried_object();
    ?>
    <?php
    get_template_part('template-parts/hero-slider-tenants', null, ['height' => 'medium']);
    ?>

    <!-- 2. PAGE TITLE + INTRO -->
    <section class="mm-page-header" style="display: none;">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <div class="mm-page-intro">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <!-- 3. FILTERS -->
    
    <div class="content_wrapper">
        <section class="mm-tenants-section">
            <div class="container">
                <h1 class="mm-section-title"><?php single_term_title(); ?></h1>
            </div>
        </section>
        <?php if (have_posts()): ?>
        <div class="mm-tenants-grid">

            <?php while (have_posts()): the_post(); ?>
                <article class="mm-tenant-card">
                    <a href="<?php the_permalink(); ?>">

                        <div class="mm-tenant-image">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php endif; ?>
                        </div>

                        <h3 class="mm-tenant-title">
                            <?php the_title(); ?>
                        </h3>

                    </a>
                </article>
            <?php endwhile; ?>

        </div>

        <?php else: ?>
            <p>No tenants found.</p>
        <?php endif; ?>

       <?php get_template_part('template-parts/tenant-categories'); ?>
    </div>
    <!-- 4. TENANTS GRID -->
    


</main>


<?php
get_footer('main');
