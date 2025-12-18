<?php
/**
 * Template Name: Home Page New
 */

get_header();
?>

<main class="mm-tenants-page home_page_wrapper">

    <?php
    get_template_part('template-parts/hero-slider', null, ['height' => 'full']);
    ?>

    
    
    <div class="content_wrapper ">
        <?php get_template_part('template-parts/home/home-shop'); ?>
        <div class="full_width_image">
            <a href="<?php echo site_url('tenants'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home_frame1.png" alt="Mega Mall Mid Image"></a>
        </div>
    </div>
    
    


</main>
<div class="dine_full_width dine_wrapper">
    <div class="content_wrapper">
        <?php get_template_part('template-parts/home/home-dine'); ?>
    </div>
</div>

<div class="content_wrapper entertainment_wrapper">
     <?php get_template_part('template-parts/home/home-entertainment'); ?>
</div>
<div class="dine_full_width dine_wrapper">
    <div class="content_wrapper">
        <?php get_template_part('template-parts/home/home-grow'); ?>
    </div>
</div>
<?php get_footer(); ?>