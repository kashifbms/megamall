<?php
/**
 * Tenants Listing Section
 */

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Filters
$search   = $_GET['s'] ?? '';
$category = $_GET['category'] ?? '';
$order    = $_GET['order'] ?? 'ASC';

// Query args
$args = [
    'post_type'      => 'tenant',
    'posts_per_page' => 12,
    'paged'          => $paged,
    's'              => $search,
    'orderby'        => 'title',
    'order'          => $order,
];

// Category filter
if (!empty($category)) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'tenant_category',
            'field'    => 'slug',
            'terms'    => $category,
        ],
    ];
}

$query = new WP_Query($args);
$categories = get_terms([
    'taxonomy' => 'tenant_category',
    'hide_empty' => true,
]);
?>

<section class="mm-tenants-section">
    <div class="container">

        <!-- TITLE -->
        <h1 class="mm-section-title">Mega shopping experience for everyone</h1>
        <p class="mm-section-desc">
            At Mega Mall Sharjah, shopping is all about choice and style. With a curated mix of popular fashion, beauty, and lifestyle brands, it’s the perfect destination for trend seekers and families alike, blending international names with local favorites to create a truly unique retail experience.
        </p>

        <!-- FILTERS -->
        <div class="mm-tenant-filters">

    <input type="text"
           name="tenant-search"
           placeholder="Search">

    <select name="tenant-category">
        <option value="">Filter by Category</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?php echo esc_attr($cat->slug); ?>">
                <?php echo esc_html($cat->name); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="tenant-order">
        <option value="ASC">A – Z</option>
        <option value="DESC">Z – A</option>
    </select>

</div>


        <!-- GRID -->
        <?php if ($query->have_posts()): ?>
            <div class="mm-tenants-grid">

                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <article class="mm-tenant-card">
                        <a href="<?php the_permalink(); ?>">

                            <div class="mm-tenant-image">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php endif; ?>
                            </div>

                            <h3 class="mm-tenant-title">
                                <?php the_title(); ?>
                            </h3>

                        </a>
                    </article>
                <?php endwhile; ?>

            </div>

            <!-- PAGINATION -->
            <div class="mm-pagination">
                <?php
                echo paginate_links([
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                ]);
                ?>
            </div>

        <?php else: ?>
            <p>No tenants found.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </div>
</section>
