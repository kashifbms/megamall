<?php
/**
 * Template Name: Tenants Page
 */

get_header();
?>

<main class="mm-tenants-page">

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
        <?php get_template_part('template-parts/tenant-grid'); ?>
        <?php get_template_part('template-parts/tenant-categories'); ?>
    </div>
    <!-- 4. TENANTS GRID -->
    


</main>

<?php get_footer(); ?>
