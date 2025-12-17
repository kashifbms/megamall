<?php
/**
 * Hero Slider – Static Template Part
 * Height controlled via:
 * set_query_var('mm_hero_height', 'full' | 'medium');
 */

$height = get_query_var('mm_hero_height', 'full');
?>

<section id="mm-hero-slider-static"
    class="mm-hero-slider swiper
    <?php echo $height === 'full' ? ' mm-hero-fullheight' : ''; ?>
    <?php echo $height === 'medium' ? ' mm-hero-mediumheight' : ''; ?>">

    <div class="swiper-wrapper">

        <!-- SLIDE 1 -->
        <div class="swiper-slide">
            <div class="mm-hero-bg"
                 style="background-image:url('<?php echo site_url(); ?>/wp-content/themes/megamall/assets/images/hero-1.jpg');">
            </div>

            <div class="mm-hero-info-box">
                <div class="mm-hero-info-item">
                    <div class="mm-hero-info-label">
                        <span class="mm-hero-info-icon">
                            <img src="<?php echo site_url(); ?>/wp-content/themes/megamall/assets/images/tabler_clock.svg">
                        </span>
                        <span class="mm-hero-info-title">Mall Timing</span>
                    </div>

                    <div class="mm-hero-info-text">
                        Mon - Thu: 10AM to 10PM
                        Fri - Sun: 10:00AM to 12:00AM
                    </div>
                </div>

                <div class="mm-hero-info-item">
                    <div class="mm-hero-info-label">
                        <span class="mm-hero-info-icon">
                            <img src="<?php echo site_url(); ?>/wp-content/themes/megamall/assets/images/akar-icons_location.svg">
                        </span>
                        <span class="mm-hero-info-title">Ground Floor</span>
                    </div>

                    <div class="mm-hero-info-link-wrapper">
                        <a class="mm-hero-info-link" target="_blank" href="https://maps.app.goo.gl/shbmcSbXUfK1gCLz5">
                            View Map
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- SLIDE 2 -->
        

    </div>

    <!-- DOTS -->
    <div class="swiper-pagination"></div>

    <!-- ARROWS -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper === 'undefined') return;

    new Swiper('#mm-hero-slider-static', {
        loop: true,
        autoplay: { delay: 4000 },
        pagination: {
            el: '#mm-hero-slider-static .swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '#mm-hero-slider-static .swiper-button-next',
            prevEl: '#mm-hero-slider-static .swiper-button-prev'
        },
        effect: 'slide'
    });
});
</script>
