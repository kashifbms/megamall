<?php
if (!defined('ABSPATH')) exit;

$posts_per_page = $attributes['postsPerPage'] ?? 12;

$paged = max(
  1,
  get_query_var('paged'),
  get_query_var('page')
);

$args = [
  'post_type'      => 'tenant',
  'post_status'    => 'publish',
  'posts_per_page' => (int) $posts_per_page,
  'paged'          => $paged,
  'orderby'        => 'title',
  'order'          => 'ASC',
];

$q = new WP_Query($args);

ob_start();
?>
<?php echo 'hello' ?>
<div class="mm-tenants-grid-wrap">
  <?php if ($q->have_posts()) : ?>
    <div class="mm-tenants-grid">
      <?php while ($q->have_posts()) : $q->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="mm-tenant-card">
          <div class="mm-tenant-image">
            <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
          </div>
          <div class="mm-tenant-name"><?php the_title(); ?></div>
        </a>
      <?php endwhile; ?>
    </div>

    <div class="mm-tenants-pagination">
      <?php
      echo paginate_links([
        'total'   => $q->max_num_pages,
        'current' => $paged,
      ]);
      ?>
    </div>
  <?php else : ?>
    <p>No tenants found.</p>
  <?php endif; ?>
</div>

<?php
wp_reset_postdata();
return ob_get_clean();
