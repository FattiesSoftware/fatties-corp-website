<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="rgba(241, 9, 146, 1)">

  <!-- Website Thumbnail -->
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/web-thumbnail.png">
  <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/web-thumbnail.png">
  <link rel="image_src" href="<?php echo get_template_directory_uri(); ?>/assets/images/web-thumbnail.png">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <!-- Navigation Bar -->
  <nav id="main-navbar" class="navbar <?php echo !is_front_page() && !is_home() ? 'visible no-transition' : ''; ?>"
    data-is-homepage="<?php echo is_front_page() || is_home() ? 'true' : 'false'; ?>">
    <div class="navbar-container">
      <div class="navbar-logo">
        <a href="<?php echo home_url('/'); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-corp.png"
            alt="<?php bloginfo('name'); ?>" class="logo-img">
        </a>
      </div>
      <div class="navbar-menu">
        <?php
        $is_front_page = is_front_page() || is_home();
        $home_url = home_url('/');

        // Get contact page URL
        $contact_page = get_page_by_path('contact');
        $contact_url = $contact_page ? get_permalink($contact_page->ID) : ($is_front_page ? '#contact-cta' : $home_url . '#contact-cta');
        // Get blog page URL (fallback to homepage blog section)
        $blog_page = get_page_by_path('blog');
        $blog_url = $blog_page ? get_permalink($blog_page->ID) : ($is_front_page ? '#section-blog' : $home_url . '#section-blog');
        ?>
        <a href="<?php echo $is_front_page ? '#section-about' : $home_url . '#section-about'; ?>" class="nav-link">Về
          chúng tôi</a>
        <?php
        // Get Service Categories
        $service_categories = get_terms(array(
          'taxonomy' => 'service_category',
          'hide_empty' => false,
        ));
        ?>
        <div class="nav-item-dropdown">
          <a href="<?php echo $is_front_page ? '#section-services' : $home_url . '#section-services'; ?>"
            class="nav-link">
            Dịch vụ
            <ion-icon name="chevron-down-outline"
              style="font-size: 14px; margin-left: 4px; vertical-align: middle;"></ion-icon>
          </a>
          <div class="dropdown-menu">
            <?php if (!empty($service_categories) && !is_wp_error($service_categories)): ?>
              <?php foreach ($service_categories as $cat): ?>
                <a href="<?php echo get_term_link($cat); ?>" class="dropdown-item">
                  <?php echo esc_html($cat->name); ?>
                </a>
              <?php endforeach; ?>
            <?php else: ?>
              <span class="dropdown-item" style="color: #999; cursor: default;">Chưa có danh mục</span>
            <?php endif; ?>
          </div>
        </div>
        <a href="<?php echo $is_front_page ? '#section-projects' : $home_url . '#section-projects'; ?>"
          class="nav-link">Dự án</a>
        <a href="<?php echo $is_front_page ? '#section-testimonials' : $home_url . '#section-testimonials'; ?>"
          class="nav-link">Đánh giá</a>
        <a href="<?php echo $is_front_page ? '#section-team' : $home_url . '#section-team'; ?>" class="nav-link">Đội
          ngũ</a>
        <a href="<?php echo home_url('/careers'); ?>" class="nav-link">Tuyển dụng</a>
        <a href="<?php echo esc_url($blog_url); ?>" class="nav-link">Blog</a>
        <a href="<?php echo esc_url($contact_url); ?>" class="nav-link nav-cta">Liên hệ</a>
      </div>
      <div class="navbar-toggle" id="navbar-toggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </nav>