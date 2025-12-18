<footer class="mm-footer">
    <div class="mm-footer-main">

        <!-- Brand -->
        <div class="mm-footer-col mm-footer-brand">
            <div class="mm-footer-logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    bloginfo('name');
                }
                ?>
            </div>

            <p class="mm-footer-description">
                Mega Mall opened on February 17, 2002 and marking the Emirate of Sharjah’s retail sector, and becoming one of the leading retail and leisure destinations in the UAE.
            </p>
        </div>

        <!-- Visitor Information -->
        <div class="mm-footer-col">
            <h4 class="mm-footer-heading">Visitor Information</h4>

            <?php
            wp_nav_menu([
                'theme_location' => 'footer_visitor',
                'container'      => false,
                'menu_class'     => 'mm-footer-links',
                'fallback_cb'    => false,
            ]);
            ?>
        </div>

        <!-- Customer Service -->
        <div class="mm-footer-col">
            <h4 class="mm-footer-heading">Customer Service</h4>

            <?php
            wp_nav_menu([
                'theme_location' => 'footer_customer',
                'container'      => false,
                'menu_class'     => 'mm-footer-links',
                'fallback_cb'    => false,
            ]);
            ?>
        </div>

        <!-- Contact -->
        <div class="mm-footer-col mm-footer-contact">
            <h4 class="mm-footer-heading">Contact Us</h4>

            <p>
                Al Istiqlal Street, Al Bu Daniq, Near Immigration Office – Sharjah
            </p>

            <p>
                <a href="tel:+97165742574">+971 6 574 2574</a>
            </p>

            <p>
                <a href="mailto:info@megamall.ae">info@megamall.ae</a>
            </p>
        </div>

    </div>

    <!-- Bottom -->
    <div class="mm-footer-bottom">
        <p class="mm-footer-copy">
            © <?php echo date('Y'); ?> MegaMall. All rights reserved.
        </p>

        <div class="mm-footer-social">
            <a href="#" aria-label="Instagram"><img src="<?php echo site_url(); ?>/wp-content/themes/megamall/assets/images/instagram.svg" alt="Instagram"></a>
            <a href="#" aria-label="Facebook"><img src="<?php echo site_url(); ?>/wp-content/themes/megamall/assets/images/facebook.svg" alt="Facebook"></a>
        </div>
    </div>

    <?php wp_footer(); ?>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.mm-menu-toggle');
    const nav = document.getElementById('mmHeaderNav');

    toggle.addEventListener('click', function () {
        nav.classList.toggle('active');
        toggle.setAttribute(
            'aria-expanded',
            nav.classList.contains('active')
        );
    });
});

document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.mm-shop-swiper', {
        slidesPerView: 4,
        spaceBetween: 20,
        observer: true,
        observeParents: true,
        autoplay: {
            delay: 4000,
        },
        navigation: {
            nextEl: '.mm-shop-next',
            prevEl: '.mm-shop-prev'
        },
        breakpoints: {
            0: { slidesPerView: 1.2 },
            768: { slidesPerView: 2.2 },
            1024: { slidesPerView: 4 }
        }
    });
});

</script>

</body>
</html>



