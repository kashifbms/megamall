<?php
get_header('single');
?>
<style>
    .leasing_form_page.mm-single-tenant{
        background-image: none;
        background-repeat: no-repeat;
        background-position: right center;
    }
</style>
<main class="mm-single-tenant leasing_form_page">
<div class="content_wrapper">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!-- Breadcrumbs -->
    <section class="mm-breadcrumbs">
		<div class="breadcrumb-links">
			<a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
			<span>&#62;</span>
			<span><?php the_title(); ?></span>
		</div>
	</section>

    <?php
    // ACF fields (YOUR EXISTING ONES)
    $header_image = get_field('tenant_header_image');
    ?>

    <!-- Hero / Carousel -->
    <section class="mm-tenant-hero">
        <div class="container">

            <?php if ($header_image): ?>
                <img class="tenant-header-image"
                     src="<?php echo esc_url(wp_get_attachment_url($header_image)); ?>"
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

                </div>
                <div class="single-form">
                    <?php the_content(); ?>
                </div>

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
                    <a href="#">

                        <?php if (has_post_thumbnail()): ?>
                            <div class="mm-offer-image">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($end_date = get_field('offer_expiry_date')): ?>
                            <span class="mm-offer-date">
                                Last Date: <span><?php echo esc_html($end_date); ?></span>
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
