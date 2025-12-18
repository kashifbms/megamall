<?php
$tenants = new WP_Query([
    'post_type'      => 'tenant',
    'posts_per_page' => 10,
    'tax_query'      => [
        [
            'taxonomy' => 'tenant_category',
            'field'    => 'slug', // or 'term_id'
            'terms'    => ['entertainment'],
        ]
    ],
    'post_status'    => 'publish'
]);
?>
<style>
    .entertainment_wrapper .mm-home-shop-text{
        background-image: none;
        background-repeat: no-repeat;
        background-position: top center;
    }
    .single-enter-item{
        background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home-entertainment-bg.png');
        background-repeat: no-repeat;
        background-position: top right;
    }
</style>
<section class="mm-home-shop">
    <div class="container">

        <!-- Header -->
        <div class="mm-home-shop-header">
            <div class="mm-home-shop-text">
                <span class="mm-section-label">ABOUT US</span>
                <h2 class="mm-section-title">ENTERTAINMENT</h2>

                <p class="mm-section-description">
                    Mega Mall offers more than shopping — from cinemas to family attractions, it’s a place where fun, warmth, and excitement come together.
                </p>
            </div>
        </div>
        

        <!-- Carousel -->
        <?php if ($tenants->have_posts()): ?>
            <div class="home-entertainment-wrapper">
                <div class="single-column-wrapper">

                    <?php while ($tenants->have_posts()): $tenants->the_post(); ?>
                        <div class="single-enter-item">
                            <div class="image-column">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php endif; ?>
                            </div>

                            <div class="text-column">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                                <a href="<?php the_permalink(); ?>" class="">Read More →</a>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>