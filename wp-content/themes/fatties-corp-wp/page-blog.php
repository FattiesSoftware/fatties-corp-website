<?php

/**
 * Blog Landing Page
 *
 * Template for the dedicated Blog page with featured posts,
 * category filters, and a contact CTA.
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 * Template Name: Blog
 */
get_header();

$selected_cat = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
$per_page = 9;

// Featured post
$featured_query = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => 1,
  'ignore_sticky_posts' => true,
  'category_name' => $selected_cat ?: '',
));

$featured_post_id = $featured_query->have_posts() ? $featured_query->posts[0]->ID : 0;

// Secondary highlights (next 3 posts)
$secondary_query = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => 3,
  'ignore_sticky_posts' => true,
  'post__not_in' => $featured_post_id ? array($featured_post_id) : array(),
  'category_name' => $selected_cat ?: '',
));

$secondary_ids = array();
if ($secondary_query->have_posts()) {
  $secondary_ids = wp_list_pluck($secondary_query->posts, 'ID');
}

$exclude_ids = array_filter(array_merge(array($featured_post_id), $secondary_ids));

// Main grid
$grid_query = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => $per_page,
  'paged' => $paged,
  'ignore_sticky_posts' => true,
  // 'post__not_in' => $exclude_ids, // Removed to show all posts in grid
  'category_name' => $selected_cat ?: '',
));

$categories = get_categories(array(
  'hide_empty' => true,
  'orderby' => 'name',
  'order' => 'ASC',
));

$blog_page_id = get_queried_object_id();
$contact_page = get_page_by_path('contact');
$contact_url = $contact_page ? get_permalink($contact_page->ID) : home_url('/#contact');
$cta_feedback = function_exists('fatties_corp_get_cta_feedback') ? fatties_corp_get_cta_feedback() : null;
?>

<div class="blog-page">
  <!-- Hero -->
  <section class="blog-hero">
    <div class="blog-container" data-aos="fade-up">
      <div class="breadcrumb">Trang chủ / Blog</div>
      <h1>Blog</h1>
      <p class="hero-subtitle">
        Các góc nhìn, cập nhật xu hướng và kinh nghiệm thực chiến từ đội ngũ Fatties.
      </p>
    </div>
  </section>

  <!-- Featured + highlights -->
  <section class="blog-featured">
    <div class="blog-container featured-layout">
      <div class="featured-main" data-aos="fade-right">
        <?php
        if ($featured_query->have_posts()):
          while ($featured_query->have_posts()):
            $featured_query->the_post();
            $feat_thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $feat_cats = get_the_category();
            ?>
            <article class="featured-card">
              <a href="<?php the_permalink(); ?>" class="featured-thumb"
                style="background-image: url('<?php echo esc_url($feat_thumb ? $feat_thumb : get_template_directory_uri() . '/assets/images/default-blog.jpg'); ?>');">
                <?php if (!empty($feat_cats)): ?>
                  <span class="badge"><?php echo esc_html($feat_cats[0]->name); ?></span>
                <?php endif; ?>
              </a>
              <div class="featured-body">
                <div class="meta">
                  <span><ion-icon name="person-outline"></ion-icon><?php echo esc_html(get_the_author()); ?></span>
                  <span><ion-icon name="calendar-outline"></ion-icon><?php echo esc_html(get_the_date('M d, Y')); ?></span>
                </div>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30, '...')); ?></p>
                <a class="text-link" href="<?php the_permalink(); ?>">Đọc bài viết</a>
              </div>
            </article>
            <?php
          endwhile;
          wp_reset_postdata();
        else:
          ?>
          <div class="no-posts">Chưa có bài viết.</div>
        <?php endif; ?>
      </div>

      <div class="featured-side">
        <h3 class="side-title" data-aos="fade-left">Bài nổi bật khác</h3>
        <?php
        if ($secondary_query->have_posts()):
          $delay = 100;
          while ($secondary_query->have_posts()):
            $secondary_query->the_post();
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $cats = get_the_category();
            ?>
            <article class="side-card" data-aos="fade-left" data-aos-delay="<?php echo $delay; ?>">
              <a class="side-thumb"
                style="background-image: url('<?php echo esc_url($thumb ? $thumb : get_template_directory_uri() . '/assets/images/default-blog.jpg'); ?>');"
                href="<?php the_permalink(); ?>">
              </a>
              <div class="side-body">
                <?php if (!empty($cats)): ?>
                  <span class="badge badge-outline"><?php echo esc_html($cats[0]->name); ?></span>
                <?php endif; ?>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="meta">
                  <span><ion-icon name="calendar-outline"></ion-icon><?php echo esc_html(get_the_date('M d, Y')); ?></span>
                </div>
              </div>
            </article>
            <?php
            $delay += 100;
          endwhile;
          wp_reset_postdata();
        else:
          ?>
          <div class="no-posts">Chưa có bài viết bổ sung.</div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Filters -->
  <section class="blog-filters" data-aos="fade-up">
    <div class="blog-container filters-row">
      <?php
      $all_url = get_permalink($blog_page_id);
      ?>
      <a class="filter-chip <?php echo empty($selected_cat) ? 'active' : ''; ?>"
        href="<?php echo esc_url($all_url); ?>">
        Tất cả
      </a>
      <?php
      foreach ($categories as $cat):
        $cat_url = add_query_arg('category', $cat->slug, $all_url);
        ?>
        <a class="filter-chip <?php echo $selected_cat === $cat->slug ? 'active' : ''; ?>"
          href="<?php echo esc_url($cat_url); ?>">
          <?php echo esc_html($cat->name); ?>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Grid -->
  <section class="blog-grid-section">
    <div class="blog-container">
      <div class="blog-grid">
        <?php
        if ($grid_query->have_posts()):
          $count = 0;
          while ($grid_query->have_posts()):
            $grid_query->the_post();
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $cats = get_the_category();
            $delay = ($count % 3) * 100;  // Stagger effect for grid
            ?>
            <article class="blog-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
              <a class="card-thumb"
                style="background-image: url('<?php echo esc_url($thumb ? $thumb : get_template_directory_uri() . '/assets/images/default-blog.jpg'); ?>');"
                href="<?php the_permalink(); ?>">
              </a>
              <div class="card-body">
                <?php if (!empty($cats)): ?>
                   <div class="card-category">
                      <span class="badge badge-light-purple"><?php echo esc_html($cats[0]->name); ?></span>
                   </div>
                <?php endif; ?>
                
                <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                
                <p class="card-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20, '...')); ?></p>
                
                <div class="meta">
                  <div class="meta-item author">
                    <ion-icon name="create-outline"></ion-icon>
                    <span><?php echo esc_html(get_the_author()); ?></span>
                  </div>
                  <div class="meta-item date">
                    <ion-icon name="calendar-outline"></ion-icon>
                    <span><?php echo esc_html(get_the_date('M d, Y')); ?></span>
                  </div>
                </div>
              </div>
            </article>
            <?php
            $count++;
          endwhile;
          wp_reset_postdata();
        else:
          ?>
          <div class="no-posts">Không có bài viết trong danh mục này.</div>
        <?php endif; ?>
      </div>

      <?php
      $pagination = paginate_links(array(
        'total' => $grid_query->max_num_pages,
        'current' => $paged,
        'type' => 'list',
        'add_args' => $selected_cat ? array('category' => $selected_cat) : array(),
        'prev_text' => '<ion-icon name="chevron-back-outline"></ion-icon>',
        'next_text' => '<ion-icon name="chevron-forward-outline"></ion-icon>',
      ));
      if ($pagination):
        ?>
        <div class="blog-pagination" data-aos="fade-up">
          <?php echo wp_kses_post($pagination); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  
</div>

<?php get_footer(); ?>