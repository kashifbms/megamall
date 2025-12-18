<?php
get_header('single');

/**
 * ACF fields assumed (adjust keys if yours differ):
 * - event_start_date
 * - event_end_date
 *
 * Expected to be stored as Ymd (recommended in ACF Date Picker return format).
 */

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

?>
<main class="mm-events-archive offers_archive">
<?php
    get_template_part('template-parts/hero-events', null, ['height' => 'medium']);
    ?>
  <!-- Header -->
  <section class="mm-events-hero">
    <div class="mm-events-hero__inner">
      <h1 class="mm-section-title">MEGA OFFERS</h1>
    </div>
  </section>

  <!-- Grid -->
  <section class="mm-events-grid-wrap">
    <div class="mm-events-grid">

      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        
        <?php
            // Get expiry date for THIS post
            $offer_expiry = get_field('offer_expiry_date');
            $formatted_date = '';

            
            $formatted_date = DateTime::createFromFormat('Y-m-d', $offer_expiry)
                              ->format('j M, Y');
            

            // Get brand data for THIS post
            $offer_brand_id = get_field('offer_tenant');
            $offer_brand_name = '';
            $brand_logo_url = '';

            if ($offer_brand_id) {
                $offer_brand_name = get_the_title($offer_brand_id);

                $brand_logo = get_field('brand_logo', $offer_brand_id);
                if (is_array($brand_logo) && isset($brand_logo['url'])) {
                    $brand_logo_url = $brand_logo['url'];
                } elseif (is_string($brand_logo)) {
                    $brand_logo_url = $brand_logo;
                }
            }
        ?>
          

          <article class="mm-event-card">
            <a class="mm-event-card__link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">

              <div class="mm-event-card__media">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail('large', ['class' => 'mm-event-card__img', 'loading' => 'lazy']); ?>
                <?php else : ?>
                  <div class="mm-event-card__img mm-event-card__img--placeholder"></div>
                <?php endif; ?>
              </div>
               
              <div class="mm-event-card__meta">
                <?php if ($formatted_date) : ?>
                  <p class="offer_expiry_date">
                      Last Date: <span><?php echo esc_html($formatted_date); ?></span>
                  </p>
                <?php endif; ?>
                <?php if ($brand_logo_url) : ?>
                  <img class="offer_brand_logo"
                     src="<?php echo esc_url($brand_logo_url); ?>"
                     alt="<?php echo esc_attr($offer_brand_name); ?>">
                <?php endif; ?>
                

              </div>
              <h2 class="mm-event-card__title"><?php the_title(); ?></h2>         
              <div class="offer_text"><?php echo the_content(); ?></div>
              

            </a>
          </article>

        <?php endwhile; ?>

      <?php else : ?>
        <div class="mm-events-empty">
          <p class="mm-events-empty__text">No offers found.</p>
        </div>
      <?php endif; ?>

    </div>

    <!-- Pagination (optional, will still look nice) -->
    <div class="mm-events-pagination">
      <?php the_posts_pagination([
        'mid_size'  => 1,
        'prev_text' => 'Prev',
        'next_text' => 'Next',
      ]); ?>
    </div>

  </section>
</main>

<?php get_footer(); ?>
