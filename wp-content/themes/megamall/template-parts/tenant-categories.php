<?php
/**
 * Tenant Categories Grid
 */

$categories = get_terms([
    'taxonomy'   => 'tenant_category',
    'hide_empty' => false,
]);
?>

<section class="mm-tenant-categories">
    <div class="container">

        <h1 class="mm-section-title">SHOP CATEGORIES</h1>

        <div class="mm-categories-grid">

            <!-- ALL -->
            

            <?php foreach ($categories as $category): 
                $icon = get_field('category_icon', 'tenant_category_' . $category->term_id);
            ?>

                <a href="<?php echo esc_url(get_term_link($category)); ?>"
                   class="mm-category-card">
                    
                    <span class="mm-category-icon">
                        <?php if ($icon): ?>
                            <img src="<?php echo esc_url($icon); ?>" alt="">
                        <?php endif; ?>
                    </span>
                    <div class="flex_div">
                        <span class="mm-category-title">
                            <?php echo esc_html($category->name); ?>
                        </span>

                        <span class="mm-category-arrow">→</span>
                    </div>

                    
                </a>

            <?php endforeach; ?>

        </div>

    </div>
</section>
