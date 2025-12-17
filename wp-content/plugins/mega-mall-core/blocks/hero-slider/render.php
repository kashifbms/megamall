<?php
/**
 * Frontend render for Hero Slider block
 *
 * @var array $attributes
 */

$slides     = $attributes['slides'] ?? [];
$autoplay   = $attributes['autoplay'] ?? true;
$speed      = $attributes['speed'] ?? 4000;
$showArrows = $attributes['showArrows'] ?? true;
$showDots   = $attributes['showDots'] ?? true;
$fullHeight = $attributes['fullHeight'] ?? true;
$mediumHeight = $attributes['mediumHeight'] ?? false;


if (empty($slides)) {
    return '';
}

$slider_id = 'mm-hero-slider-' . uniqid();
?>

<section id="<?php echo esc_attr($slider_id); ?>"
  class="mm-hero-slider swiper
  <?php echo $fullHeight ? ' mm-hero-fullheight' : ''; ?>
  <?php echo $mediumHeight ? ' mm-hero-mediumheight' : ''; ?>">


    <div class="swiper-wrapper">
        <?php error_log('MM HERO SLIDES RAW: ' . print_r($slides, true)); ?>
        <?php foreach ($slides as $slide): ?>
            <?php
            $image_url = !empty($slide['imageUrl']) ? $slide['imageUrl'] : '';
            if (!$image_url) {
                continue;
            }

            $show_info = !isset($slide['showInfoBox']) || $slide['showInfoBox'];
            ?>
            <div class="swiper-slide">
                <div class="mm-hero-bg" style="background-image:url('<?php echo esc_url($image_url); ?>');"></div>

                <?php if ($show_info && (!empty($slide['infoTimingText']) || !empty($slide['infoLocationTitle']) )): ?>
                    <div class="mm-hero-info-box">
                        <div class="mm-hero-info-item">
                            <div class="mm-hero-info-label">
                                <!-- Clock icon placeholder; replace with SVG later -->
                                <span class="mm-hero-info-icon"><img src="http://localhost/megamall/wp-content/uploads/2025/12/tabler_clock.svg"></span>
                                <span class="mm-hero-info-title">
                                    <?php echo esc_html($slide['infoTimingTitle'] ?: 'Mall Timing'); ?>
                                </span>
                            </div>
                            <?php if (!empty($slide['infoTimingText'])): ?>
                                <div class="mm-hero-info-text">
                                    <?php echo nl2br(esc_html($slide['infoTimingText'])); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($slide['infoLocationTitle'])): ?>
                            <div class="mm-hero-info-item">
                                <div class="mm-hero-info-label">
                                    <!-- Location icon placeholder -->
                                    <span class="mm-hero-info-icon"><img src="http://localhost/megamall/wp-content/uploads/2025/12/akar-icons_location.svg"></span>
                                    <span class="mm-hero-info-title">
                                        <?php echo esc_html($slide['infoLocationTitle']); ?>
                                    </span>
                                </div>

                                <?php if (!empty($slide['infoLocationCtaUrl'])):
                                ?>
                                <div class="mm-hero-info-link-wrapper">
                                    <a class="mm-hero-info-link" href="<?php echo esc_url($slide['infoLocationCtaUrl']); ?>">
                                        <?php echo esc_html($slide['infoLocationCtaLabel']); ?>
                                    </a>
                                </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($showDots): ?>
        <div class="swiper-pagination"></div>
    <?php endif; ?>

    <?php if ($showArrows): ?>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    <?php endif; ?>

</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper === 'undefined') {
        return;
    }
    new Swiper('#<?php echo esc_js($slider_id); ?>', {
        loop: true,
        autoplay: <?php echo $autoplay ? '{ delay: ' . intval($speed) . ' }' : 'false'; ?>,
        pagination: <?php echo $showDots ? "{ el: '#{$slider_id} .swiper-pagination', clickable: true }" : 'false'; ?>,
        navigation: <?php echo $showArrows ? "{ nextEl: '#{$slider_id} .swiper-button-next', prevEl: '#{$slider_id} .swiper-button-prev' }" : 'false'; ?>,
        effect: 'slide'
    });
});
</script>