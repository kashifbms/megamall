<?php
$tenants = new WP_Query([
    'post_type'      => 'tenant',
    'posts_per_page' => 10,
    'tax_query'      => [
        [
            'taxonomy' => 'tenant_category',
            'field'    => 'slug',
            'terms'    => ['dine'],
            'operator' => 'NOT IN',
        ]
    ],
    'post_status'    => 'publish'
]);
?>
<style>
    .mm-home-shop-text{
        background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home_top_bg.png');
        background-repeat: no-repeat;
        background-position: top center;
    }
</style>
<section class="mm-home-shop">
    <div class="container">

        <!-- Header -->
        <div class="mm-home-shop-header">
            <div class="mm-home-shop-text">
                <span class="mm-section-label">ABOUT US</span>
                <h2 class="mm-section-title">SHOP</h2>

                <p class="mm-section-description">
                    Explore a world of choice at Mega Mall Sharjah, home to the latest trends in fashion, beauty, and lifestyle for every taste and generation.
                </p>
                <div class="flex_btns_link">
                    <a href="<?php echo esc_url(home_url('/tenants')); ?>"
                    class="mm-btn mm-btn-primary">
                        View All Brands →
                    </a>
                    <div class="mm-home-shop-nav">
                        <div class="mm-shop-prev next_prev_btns">&#10094;</div>
                        <div class="mm-shop-next next_prev_btns">&#10095;</div>
                    </div>
                </div>
                
            </div>

            
        </div>
        

        <!-- Carousel -->
        <?php if ($tenants->have_posts()): ?>
            <div class="swiper mm-shop-swiper">
                <div class="swiper-wrapper">

                    <?php while ($tenants->have_posts()): $tenants->the_post(); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>" class="mm-shop-card">

                                <div class="mm-shop-image">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="mm-shop-name">
                                    <?php the_title(); ?>
                                </div>

                            </a>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>