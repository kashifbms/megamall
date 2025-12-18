<?php
get_header('single');


 $offer_expiry = get_field('offer_expiry_date');
 if ($offer_expiry) {
    $formatted_date = DateTime::createFromFormat('Y-m-d', $offer_expiry)
        ->format('j M, Y');
}

$offer_brande_id = get_field('offer_tenant'); // returns Post ID
if ($offer_brande_id) {
    $offer_brande_name = get_the_title($offer_brande_id);
    //echo esc_html($post_title);
}
if ($offer_brande_id) {
    $brand_logo = get_field('brand_logo', $offer_brande_id);

}



if ($offer_expiry) {

    // Convert dates to timestamps
    $expiry_timestamp = strtotime($offer_expiry);
    $today_timestamp  = strtotime(date('Y-m-d'));

    if ($expiry_timestamp < $today_timestamp) {
        $label = 'Offer Expired';
        $label_class = 'expired';
    } else {
        $label = 'Offer Active';
        $label_class = 'active';
    }

    
}
?>


<main class="mm-single-event-wrapper single-offer-page">
    <div class="content_wrapper mm-single-event">
        <section class="mm-breadcrumbs">
		<div class="breadcrumb-links">
			<a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
			<span>&#62;</span>
			<a href="<?php echo site_url('offers'); ?>">Offers</a>
			<span>&#62;</span>
			<span><?php the_title(); ?></span>
		</div>
	</section>

    <div class="mm-event-layout">

        <!-- MAIN -->
        <article class="mm-event-main">

        <div class="mm-event-header">
            <h1 class="mm-event-title"><?php the_title(); ?></h1>

            <span class="mm-event-status <?php echo $label ? 'is-ongoing' : 'is-active'; ?>">
            <?php echo $label; ?>
            </span>
        </div>

        <!-- META -->
        <div class="mm-event-meta">

            <?php if ($formatted_date) : ?>
            <div class="mm-event-meta-item">
            <span class="mm-event-meta-label">OFFER EXPIRY</span>
            <span class="mm-event-meta-value"><?php echo esc_html($formatted_date); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($brand_logo) : ?>
            <div class="mm-event-meta-item">
                <img class="offer_logooffer_brand_logo_single" src="<?php echo esc_url($brand_logo); ?>" alt="<?php echo esc_attr($offer_brande_name); ?>">
            </div>
            <?php endif; ?>

        </div>

        <!-- FEATURED IMAGE -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="mm-event-featured">
            <?php the_post_thumbnail('full', ['loading' => 'lazy']); ?>
            </div>
        <?php endif; ?>

        <!-- CONTENT -->
        <div class="mm-event-content">
            <?php the_content(); ?>
        </div>

        </article>

        <!-- SIDEBAR -->
        <aside class="mm-event-sidebar">

        <h3 class="mm-event-sidebar-title">Related Offers</h3>

        <?php
        $related = new WP_Query([
            'post_type'      => 'offer',
            'posts_per_page' => 3,
            'post__not_in'   => [get_the_ID()],
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
        ]);

        if ($related->have_posts()) :
            while ($related->have_posts()) : $related->the_post();
          
        ?>

            <a class="mm-related-event" href="<?php the_permalink(); ?>">

            <?php if (has_post_thumbnail()) : ?>
                <div class="mm-related-thumb">
                <?php the_post_thumbnail('medium'); ?>
                </div>
            <?php endif; ?>

            <div class="mm-related-info">
                <?php if ($formatted_date) : ?>
                <span class="mm-related-date"><?php echo esc_html($formatted_date); ?></span>
                <?php endif; ?>
                <span class="mm-related-title"><?php the_title(); ?></span>
            </div>

            </a>

        <?php endwhile; wp_reset_postdata(); endif; ?>

        </aside>

    </div>
    </div>
</main>
<?php get_footer(); ?>
