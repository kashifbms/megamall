<?php

$header_image = get_field('tenant_header_image');
$carousel = get_field('tenant_carousel_images');
$phone = get_field('tenant_phone');
$email = get_field('tenant_email');
$floor = get_field('tenant_floor');
$shop = get_field('tenant_shop_number');

?>
<div class="tenant-details">

    <?php if ($carousel): ?>
        <div class="tenant-carousel">
            <?php foreach ($carousel as $img): ?>
                <img src="<?php echo esc_url($img['url']); ?>" alt="">
            <?php endforeach; ?>
        </div>
    <?php elseif ($header_image): ?>
        <img class="tenant-header-image" src="<?php echo esc_url(wp_get_attachment_url($header_image)); ?>" alt="">
    <?php endif; ?>

    <div class="tenant-info">
        <?php if ($floor): ?>
            <p><strong>Floor:</strong> <?php echo esc_html($floor); ?></p>
        <?php endif; ?>

        <?php if ($shop): ?>
            <p><strong>Shop #:</strong> <?php echo esc_html($shop); ?></p>
        <?php endif; ?>

        <?php if ($phone): ?>
            <p><strong>Phone:</strong> <?php echo esc_html($phone); ?></p>
        <?php endif; ?>

        <?php if ($email): ?>
            <p><strong>Email:</strong> <?php echo esc_html($email); ?></p>
        <?php endif; ?>
    </div>

</div>