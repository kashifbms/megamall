<?php
get_header('single');

/**
 * ACF fields assumed (adjust keys if yours differ):
 * - event_start_date
 * - event_end_date
 *
 * Expected to be stored as Ymd (recommended in ACF Date Picker return format).
 */

$filter = isset($_GET['event_filter']) ? sanitize_text_field($_GET['event_filter']) : 'all';
$todayYmd = current_time('Ymd');

?>
<main class="mm-events-archive">
<?php
    get_template_part('template-parts/hero-events', null, ['height' => 'medium']);
    ?>
  <!-- Header -->
  <section class="mm-events-hero">
    <div class="mm-events-hero__inner">
      <h1 class="mm-section-title">MEGA EVENTS</h1>

      <form class="mm-events-filter" method="get" action="">
        <label class="mm-events-filter__label" for="mmEventsFilter">Filter events</label>
        <select class="mm-events-filter__select" id="mmEventsFilter" name="event_filter" onchange="this.form.submit()">
          <option value="all"     <?php selected($filter, 'all'); ?>>All Events</option>
          <option value="ongoing" <?php selected($filter, 'ongoing'); ?>>Ongoing Events</option>
          <option value="past"    <?php selected($filter, 'past'); ?>>Past Events</option>
        </select>
      </form>
    </div>
  </section>

  <!-- Grid -->
  <section class="mm-events-grid-wrap">
    <div class="mm-events-grid">

      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

          <?php
            // --- ACF dates (adjust keys if needed) ---
            $startYmd = get_field('event_start_date');
            $endYmd   = get_field('event_end_date');

            // If your ACF returns "d/m/Y" etc, convert here accordingly.
            // Best is ACF return = Ymd.

            $isPast = false;
            if (!empty($endYmd) && preg_match('/^\d{8}$/', $endYmd)) {
              $isPast = ($endYmd < $todayYmd);
            }

            $status = $isPast ? 'past' : 'ongoing';

            // Apply filter (front-end)
            if ($filter === 'ongoing' && $status !== 'ongoing') continue;
            if ($filter === 'past' && $status !== 'past') continue;

            // Format date range for UI (fallback safe)
            $startLabel = !empty($startYmd) ? date_i18n('d M Y', strtotime($startYmd)) : '';
            $endLabel   = !empty($endYmd)   ? date_i18n('d M Y', strtotime($endYmd))   : '';

            $dateRange  = trim($startLabel . ($startLabel && $endLabel ? ' - ' : '') . $endLabel);
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
             <h2 class="mm-event-card__title"><?php the_title(); ?></h2>           
              <div class="mm-event-card__meta">
                <span class="mm-event-badge mm-event-badge--<?php echo esc_attr($status); ?>">
                  <?php echo $isPast ? 'Past Event' : 'Ongoing Event'; ?>
                </span>

                <?php if (!empty($dateRange)) : ?>
                  <span class="mm-event-card__dates"><?php echo esc_html($dateRange); ?></span>
                <?php endif; ?>
              </div>

              

            </a>
          </article>

        <?php endwhile; ?>

      <?php else : ?>
        <div class="mm-events-empty">
          <p class="mm-events-empty__text">No events found.</p>
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
