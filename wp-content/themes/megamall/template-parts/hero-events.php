<?php
/**
 * Hero Slider – Static Template Part
 * Height controlled via:
 * set_query_var('mm_hero_height', 'full' | 'medium');
 */

$height = get_query_var('mm_hero_height', 'medium');
?>

<section id="mm-hero-slider-static"
    class="mm-hero-slider swiper mm-hero-mediumheight">

    <div class="swiper-wrapper">

        <!-- SLIDE 1 -->
        <div class="swiper-slide">
            <div class="mm-hero-bg"
                 style="background-image:url('<?php echo site_url(); ?>/wp-content/themes/megamall/assets/images/event_img.jpg');">
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
