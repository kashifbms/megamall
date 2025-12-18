<?php
get_header('single');
?>
<style>
    .mm-single-tenant{
        background-image: url( '<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single_tenat_side_bg.png');
        background-repeat: no-repeat;
        background-position: right center;
    }
</style>
<main class="mm-single-tenant">
<div class="content_wrapper">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!-- Breadcrumbs -->
    <section class="mm-breadcrumbs">
		<div class="breadcrumb-links">
			<a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
			<span>&#62;</span>
			<a href="<?php echo site_url('tenants'); ?>">Shop</a>
			<span>&#62;</span>
			<span><?php the_title(); ?></span>
		</div>
	</section>

    <?php
    // ACF fields (YOUR EXISTING ONES)
    $header_image = get_field('tenant_header_image');
    
    $header_image_url = $header_image
    ? wp_get_attachment_url($header_image)
    : site_url('/wp-content/themes/megamall/assets/images/tenant_header1.png');

    $carousel     = get_field('tenant_carousel_images');
    $phone        = get_field('tenant_phone');
    $email        = get_field('tenant_email');
    $floor        = get_field('tenant_floor');
    $shop         = get_field('tenant_shop_number');
    ?>

    <!-- Hero / Carousel -->
    <section class="mm-tenant-hero">
        <div class="container">

            <?php if ($carousel): ?>
                <div class="tenant-carousel">
                    <?php foreach ($carousel as $img): ?>
                        <img src="<?php echo esc_url($img['url']); ?>" alt="">
                    <?php endforeach; ?>
                </div>

            <?php elseif ($header_image_url): ?>
                <img class="tenant-header-image"
                     src="<?php echo esc_url($header_image_url); ?>"
                     alt="">
            <?php endif; ?>
        
        </div>
    </section>

    <!-- Content + Sidebar -->
    <section class="mm-tenant-details">
        <div class="container">
            <div class="mm-tenant-layout">

                <!-- LEFT -->
                <div class="mm-tenant-content">
                    <h1 class="mm-tenant-title"><?php the_title(); ?></h1>

                    <div class="mm-tenant-description">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- RIGHT -->
                <aside class="mm-tenant-sidebar">

                    <h3>Contact Details</h3>

                    <ul class="mm-tenant-contact">
                        <?php if ($floor): ?>
                            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/location_icon_single.svg" alt="Floor Icon"><strong>Shop # <?php echo esc_html($shop); ?> </strong> <?php echo esc_html($floor); ?></li>
                        <?php endif; ?>

                        

                        <?php if ($phone): ?>
                            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phone_icon_single.svg" alt="Phone Icon"><strong>Phone:</strong> <?php echo esc_html($phone); ?></li>
                        <?php endif; ?>

                        <?php if ($email): ?>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/email_icon_single.svg" alt="Email Icon">
                                <strong>Email:</strong>
                                <a href="mailto:<?php echo esc_attr($email); ?>">
                                    <?php echo esc_html($email); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>

                </aside>

            </div>
        </div>
    </section>
<?php endwhile; endif; ?>

<?php
$tenant_id = get_the_ID();

$offers = new WP_Query([
    'post_type'      => 'offer',
    'posts_per_page' => 3,
    'meta_query'     => [
        [
            'key'     => 'offer_tenant',
            'value'   => $tenant_id,
            'compare' => '=',
        ]
    ]
]);
?>

<?php if ($offers->have_posts()): ?>
<section class="mm-tenant-offers">
    <div class="container">

        <h2 class="mm-tenant-title">Offers</h2>

        <div class="mm-offers-grid">

            <?php while ($offers->have_posts()): $offers->the_post(); ?>

                <article class="mm-offer-card">
                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">

                        <?php if (has_post_thumbnail()): ?>
                            <div class="mm-offer-image">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($end_date = get_field('offer_expiry_date')): ?>
                           <?php 
                            if ($end_date) {
                                $formatted_date = DateTime::createFromFormat('Y-m-d', $end_date)
                                    ->format('j M, Y');
                            }
                            ?> 
                            <span class="mm-offer-date">
                                Last Date: <span><?php echo esc_html($formatted_date); ?></span>
                            </span>
                        <?php endif; ?>

                        <h3 class="mm-offer-title">
                            <?php the_title(); ?>
                        </h3>

                    </a>
                </article>

            <?php endwhile; ?>

        </div>

    </div>
</section>
<?php endif; wp_reset_postdata(); ?>


</div>
</main>

<?php get_footer('main'); ?>
