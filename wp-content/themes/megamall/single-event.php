<?php
get_header('single');

$today_ts = strtotime( current_time('Y-m-d') );

function mm_event_date_to_ts($value) {
    if (!$value) return 0;

    // Format: Ymd (20260331)
    if (preg_match('/^\d{8}$/', $value)) {
        $d = DateTime::createFromFormat('Ymd', $value);
        return $d ? $d->getTimestamp() : 0;
    }

    // Format: d/m/Y
    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
        $d = DateTime::createFromFormat('d/m/Y', $value);
        return $d ? $d->getTimestamp() : 0;
    }

    // Fallback (Y-m-d, M d Y, etc.)
    $ts = strtotime($value);
    return $ts ? $ts : 0;
}

/* -------------------------------------------------
 * FIELD VALUES
 * ------------------------------------------------- */
$start_date_raw = get_field('event_start_date');
$end_date_raw   = get_field('event_end_date');

$start_time = get_field('event_start_time');
$end_time   = get_field('event_end_time');

$location   = get_field('event_location');

/* -------------------------------------------------
 * TIMESTAMPS
 * ------------------------------------------------- */
$start_ts = mm_event_date_to_ts($start_date_raw);
$end_ts   = mm_event_date_to_ts($end_date_raw);

/* -------------------------------------------------
 * STATUS LOGIC (FIXED)
 * -------------------------------------------------
 * - Past ONLY if end date exists AND is before today
 * - Otherwise => Ongoing
 */
$is_past = ($end_ts && $end_ts < $today_ts);

/* -------------------------------------------------
 * LABELS
 * ------------------------------------------------- */
$date_label = '';
if ($start_ts && $end_ts) {
    $date_label = date_i18n('d M Y', $start_ts) . ' - ' . date_i18n('d M Y', $end_ts);
}

$time_label = '';
if ($start_time && $end_time) {
    $time_label = esc_html($start_time . ' to ' . $end_time);
}
?>


<main class="mm-single-event-wrapper">
    <div class="content_wrapper mm-single-event">
        <section class="mm-breadcrumbs">
		<div class="breadcrumb-links">
			<a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
			<span>&#62;</span>
			<a href="<?php echo site_url('events'); ?>">Events</a>
			<span>&#62;</span>
			<span><?php the_title(); ?></span>
		</div>
	</section>

    <div class="mm-event-layout">

        <!-- MAIN -->
        <article class="mm-event-main">

        <div class="mm-event-header">
            <h1 class="mm-event-title"><?php the_title(); ?></h1>

            <span class="mm-event-status <?php echo $is_past ? 'is-past' : 'is-ongoing'; ?>">
            <?php echo $is_past ? 'Past Event' : 'Ongoing Event'; ?>
            </span>
        </div>

        <!-- META -->
        <div class="mm-event-meta">

            <?php if ($location) : ?>
            <div class="mm-event-meta-item">
            <span class="mm-event-meta-label">EVENT LOCATION</span>
            <span class="mm-event-meta-value"><?php echo esc_html($location); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($date_label) : ?>
            <div class="mm-event-meta-item">
            <span class="mm-event-meta-label">EVENT DATE</span>
            <span class="mm-event-meta-value"><?php echo esc_html($date_label); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($time_label) : ?>
            <div class="mm-event-meta-item">
            <span class="mm-event-meta-label">EVENT TIME</span>
            <span class="mm-event-meta-value"><?php echo $time_label; ?></span>
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

        <h3 class="mm-event-sidebar-title">More Events</h3>

        <?php
        $related = new WP_Query([
            'post_type'      => 'event',
            'posts_per_page' => 3,
            'post__not_in'   => [get_the_ID()],
            'meta_key'       => 'event_start_date',
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
        ]);

        if ($related->have_posts()) :
            while ($related->have_posts()) : $related->the_post();

            $r_start = get_field('event_start_date');
            $r_end   = get_field('event_end_date');

            $r_date = '';
            if ($r_start && $r_end) {
                $r_date = date_i18n('d M Y', strtotime($r_start)) . ' - ' . date_i18n('d M Y', strtotime($r_end));
            }
        ?>

            <a class="mm-related-event" href="<?php the_permalink(); ?>">

            <?php if (has_post_thumbnail()) : ?>
                <div class="mm-related-thumb">
                <?php the_post_thumbnail('medium'); ?>
                </div>
            <?php endif; ?>

            <div class="mm-related-info">
                <?php if ($r_date) : ?>
                <span class="mm-related-date"><?php echo esc_html($r_date); ?></span>
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
