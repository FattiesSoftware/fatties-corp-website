<?php

/**
 * Fatties Corporation Theme Functions
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */

// Theme Setup
function fatties_corp_setup()
{
  // Add theme support
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));
  add_theme_support('custom-logo');

  // Register navigation menus
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'fatties-corp'),
  ));
}

add_action('after_setup_theme', 'fatties_corp_setup');

// Enqueue styles and scripts
function fatties_corp_scripts()
{
  // Google Fonts
  wp_enqueue_style('fatties-corp-fonts', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap', array(), null);

  // AOS (Animate On Scroll) CSS
  wp_enqueue_style('aos-css', get_template_directory_uri() . '/assets/css/aos.css', array(), null);

  // Theme stylesheet
  wp_enqueue_style(
    'fatties-corp-style',
    get_stylesheet_uri(),
    array(),
    '1.0.5'  // Version bump to force reload
  );

  // jQuery - Use local version
  wp_enqueue_script('jquery-local', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), true);

  // CountUp.js - Use local version
  wp_enqueue_script('countup-js', get_template_directory_uri() . '/assets/js/countUp.umd.js', array(), true);

  // Waves.js - Ripple effect library
  wp_enqueue_script('waves-js', get_template_directory_uri() . '/assets/js/waves.min.js', array('jquery-local'), true);
  // Waves.js CSS
  wp_enqueue_style('waves-css', get_template_directory_uri() . '/assets/css/waves.min.css', array(), null);

  // AOS (Animate On Scroll) JS
  wp_enqueue_script('aos-js', get_template_directory_uri() . '/assets/js/aos.js', array('jquery-local'), null, true);

  // Theme scripts - depends on jQuery, CountUp, Waves, and AOS
  wp_enqueue_script('fatties-corp-scripts', get_template_directory_uri() . '/assets/js/main.js', array('jquery-local', 'countup-js', 'waves-js', 'aos-js'), '1.0.4', true);

  // Ionicons - Load as module type
  wp_enqueue_script('ionicons-esm', 'https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js', array(), '5.5.2', true);
  add_filter('script_loader_tag', 'fatties_corp_add_type_attribute', 10, 3);
}

add_action('wp_enqueue_scripts', 'fatties_corp_scripts');

// Add type="module" to ionicons script
function fatties_corp_add_type_attribute($tag, $handle, $src)
{
  if ('ionicons-esm' === $handle) {
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
  }
  return $tag;
}

// Custom template tags
function fatties_corp_get_years_since_founding()
{
  return date('Y') - 2020;
}

function fatties_corp_get_current_year()
{
  return date('Y');
}

// Widget Areas
function fatties_corp_widgets_init()
{
  register_sidebar(array(
    'name' => __('Footer Widget Area', 'fatties-corp'),
    'id' => 'footer-1',
    'description' => __('Add widgets here to appear in your footer.', 'fatties-corp'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}

add_action('widgets_init', 'fatties_corp_widgets_init');

// Custom Post Types
function fatties_corp_register_post_types()
{
  // Projects Post Type
  register_post_type('project', array(
    'labels' => array(
      'name' => __('Projects', 'fatties-corp'),
      'singular_name' => __('Project', 'fatties-corp'),
      'add_new' => __('Add New Project', 'fatties-corp'),
      'add_new_item' => __('Add New Project', 'fatties-corp'),
      'edit_item' => __('Edit Project', 'fatties-corp'),
      'new_item' => __('New Project', 'fatties-corp'),
      'view_item' => __('View Project', 'fatties-corp'),
      'search_items' => __('Search Projects', 'fatties-corp'),
      'not_found' => __('No projects found', 'fatties-corp'),
      'not_found_in_trash' => __('No projects found in trash', 'fatties-corp'),
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-portfolio',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array('slug' => 'project'),
  ));

  // Team Members Post Type
  register_post_type('team_member', array(
    'labels' => array(
      'name' => __('Team Members', 'fatties-corp'),
      'singular_name' => __('Team Member', 'fatties-corp'),
      'add_new' => __('Add New Team Member', 'fatties-corp'),
      'add_new_item' => __('Add New Team Member', 'fatties-corp'),
      'edit_item' => __('Edit Team Member', 'fatties-corp'),
      'new_item' => __('New Team Member', 'fatties-corp'),
      'view_item' => __('View Team Member', 'fatties-corp'),
      'search_items' => __('Search Team Members', 'fatties-corp'),
      'not_found' => __('No team members found', 'fatties-corp'),
      'not_found_in_trash' => __('No team members found in trash', 'fatties-corp'),
    ),
    'public' => true,
    'has_archive' => false,
    'menu_icon' => 'dashicons-groups',
    'supports' => array('title', 'editor', 'thumbnail'),
    'rewrite' => array('slug' => 'employees'),
  ));

  // Testimonials Post Type
  register_post_type('testimonial', array(
    'labels' => array(
      'name' => __('Testimonials', 'fatties-corp'),
      'singular_name' => __('Testimonial', 'fatties-corp'),
      'add_new' => __('Add New Testimonial', 'fatties-corp'),
      'add_new_item' => __('Add New Testimonial', 'fatties-corp'),
      'edit_item' => __('Edit Testimonial', 'fatties-corp'),
      'new_item' => __('New Testimonial', 'fatties-corp'),
      'view_item' => __('View Testimonial', 'fatties-corp'),
      'search_items' => __('Search Testimonials', 'fatties-corp'),
      'not_found' => __('No testimonials found', 'fatties-corp'),
      'not_found_in_trash' => __('No testimonials found in trash', 'fatties-corp'),
    ),
    'public' => true,
    'has_archive' => false,
    'menu_icon' => 'dashicons-format-quote',
    'supports' => array('title', 'editor', 'thumbnail'),
    'rewrite' => array('slug' => 'testimonials'),
  ));
}

add_action('init', 'fatties_corp_register_post_types');

// Custom Taxonomies
function fatties_corp_register_taxonomies()
{
  // Project Category
  register_taxonomy('project_category', 'project', array(
    'labels' => array(
      'name' => __('Project Categories', 'fatties-corp'),
      'singular_name' => __('Project Category', 'fatties-corp'),
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'project-category'),
  ));

  // Service Category
  register_taxonomy('service_category', 'service', array(
    'labels' => array(
      'name' => __('Danh mục dịch vụ', 'fatties-corp'),
      'singular_name' => __('Danh mục dịch vụ', 'fatties-corp'),
      'add_new_item' => __('Thêm danh mục mới', 'fatties-corp'),
      'new_item_name' => __('Tên danh mục mới', 'fatties-corp'),
      'edit_item' => __('Sửa danh mục', 'fatties-corp'),
      'update_item' => __('Cập nhật danh mục', 'fatties-corp'),
      'all_items' => __('Tất cả danh mục', 'fatties-corp'),
      'search_items' => __('Tìm kiếm danh mục', 'fatties-corp'),
      'parent_item' => __('Danh mục cha', 'fatties-corp'),
      'parent_item_colon' => __('Danh mục cha:', 'fatties-corp'),
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'service-category'),
  ));
}

add_action('init', 'fatties_corp_register_taxonomies');

// Register Service Custom Post Type
function fatties_corp_register_service_cpt()
{
  register_post_type('service', array(
    'labels' => array(
      'name' => __('Dịch vụ', 'fatties-corp'),
      'singular_name' => __('Dịch vụ', 'fatties-corp'),
      'add_new' => __('Thêm dịch vụ mới', 'fatties-corp'),
      'add_new_item' => __('Thêm dịch vụ mới', 'fatties-corp'),
      'edit_item' => __('Sửa dịch vụ', 'fatties-corp'),
      'new_item' => __('Dịch vụ mới', 'fatties-corp'),
      'view_item' => __('Xem dịch vụ', 'fatties-corp'),
      'search_items' => __('Tìm kiếm dịch vụ', 'fatties-corp'),
      'not_found' => __('Không tìm thấy dịch vụ', 'fatties-corp'),
      'not_found_in_trash' => __('Không tìm thấy dịch vụ trong thùng rác', 'fatties-corp'),
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-hammer',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array('slug' => 'service'),
  ));

  // Temporary: Flush rewrite rules to ensure new taxonomy URLs work.
  // TODO: Remove this line after the page loads successfully once.
  flush_rewrite_rules();
}

add_action('init', 'fatties_corp_register_service_cpt');

// Custom Meta Boxes
function fatties_corp_add_meta_boxes()
{
  // Team Member Meta Box
  add_meta_box(
    'team_member_details',
    __('Team Member Details', 'fatties-corp'),
    'fatties_corp_team_member_meta_box_callback',
    'team_member',
    'normal',
    'high'
  );

  // Project Meta Box
  add_meta_box(
    'project_details',
    __('Project Details', 'fatties-corp'),
    'fatties_corp_project_meta_box_callback',
    'project',
    'normal',
    'high'
  );

  // Testimonial Meta Box
  add_meta_box(
    'testimonial_details',
    __('Testimonial Details', 'fatties-corp'),
    'fatties_corp_testimonial_meta_box_callback',
    'testimonial',
    'normal',
    'high'
  );

  // Service Meta Box
  add_meta_box(
    'service_details',
    __('Service Details', 'fatties-corp'),
    'fatties_corp_service_meta_box_callback',
    'service',
    'normal',
    'high'
  );
}

add_action('add_meta_boxes', 'fatties_corp_add_meta_boxes');

function fatties_corp_team_member_meta_box_callback($post)
{
  wp_nonce_field('fatties_corp_team_member_meta_box', 'fatties_corp_team_member_meta_box_nonce');

  $position = get_post_meta($post->ID, '_team_member_position', true);
  $facebook = get_post_meta($post->ID, '_team_member_facebook', true);
  $twitter = get_post_meta($post->ID, '_team_member_twitter', true);
  $instagram = get_post_meta($post->ID, '_team_member_instagram', true);
  $email = get_post_meta($post->ID, '_team_member_email', true);
  ?>
  <p>
    <label for="team_member_position"><?php _e('Position:', 'fatties-corp'); ?></label><br>
    <input type="text" id="team_member_position" name="team_member_position" value="<?php echo esc_attr($position); ?>"
      style="width: 100%;">
  </p>
  <p>
    <label for="team_member_facebook"><?php _e('Facebook URL:', 'fatties-corp'); ?></label><br>
    <input type="url" id="team_member_facebook" name="team_member_facebook" value="<?php echo esc_attr($facebook); ?>"
      style="width: 100%;">
  </p>
  <p>
    <label for="team_member_twitter"><?php _e('Twitter URL:', 'fatties-corp'); ?></label><br>
    <input type="url" id="team_member_twitter" name="team_member_twitter" value="<?php echo esc_attr($twitter); ?>"
      style="width: 100%;">
  </p>
  <p>
    <label for="team_member_instagram"><?php _e('Instagram URL:', 'fatties-corp'); ?></label><br>
    <input type="url" id="team_member_instagram" name="team_member_instagram" value="<?php echo esc_attr($instagram); ?>"
      style="width: 100%;">
  </p>
  <p>
    <label for="team_member_email"><?php _e('Email:', 'fatties-corp'); ?></label><br>
    <input type="email" id="team_member_email" name="team_member_email" value="<?php echo esc_attr($email); ?>"
      style="width: 100%;">
  </p>
  <?php
}

function fatties_corp_project_meta_box_callback($post)
{
  wp_nonce_field('fatties_corp_project_meta_box', 'fatties_corp_project_meta_box_nonce');

  $project_url = get_post_meta($post->ID, '_project_url', true);
  $project_type = get_post_meta($post->ID, '_project_type', true);
  $project_logo = get_post_meta($post->ID, '_project_logo', true);
  $project_title_fallback = get_post_meta($post->ID, '_project_title_fallback', true);
  ?>
  <p>
    <label for="project_url"><?php _e('Project URL:', 'fatties-corp'); ?></label><br>
    <input type="url" id="project_url" name="project_url" value="<?php echo esc_attr($project_url); ?>"
      style="width: 100%;">
  </p>
  <p>
    <label for="project_type"><?php _e('Project Type:', 'fatties-corp'); ?></label><br>
    <input type="text" id="project_type" name="project_type" value="<?php echo esc_attr($project_type); ?>"
      style="width: 100%;" placeholder="e.g., Website mạng xã hội">
  </p>
  <p>
    <label for="project_logo"><?php _e('Project Logo:', 'fatties-corp'); ?></label><br>
    <input type="text" id="project_logo" name="project_logo" value="<?php echo esc_attr($project_logo); ?>"
      style="width: 70%;" placeholder="URL của logo">
    <input type="button" class="button button-secondary" value="<?php _e('Upload Logo', 'fatties-corp'); ?>"
      id="project_logo_button" style="width: 28%; margin-left: 2%;">
    <?php if ($project_logo): ?>
      <br><br>
      <img src="<?php echo esc_url($project_logo); ?>"
        style="max-width: 200px; height: auto; display: block; margin-top: 10px;" id="project_logo_preview">
    <?php endif; ?>
  </p>
  <p>
    <label for="project_title_fallback"><?php _e('Project Title Fallback:', 'fatties-corp'); ?></label><br>
    <input type="text" id="project_title_fallback" name="project_title_fallback"
      value="<?php echo esc_attr($project_title_fallback); ?>" style="width: 100%;"
      placeholder="Text hiển thị khi không có logo">
    <small
      style="color: #666;"><?php _e('Text này sẽ hiển thị thay cho logo nếu không có logo được upload.', 'fatties-corp'); ?></small>
  </p>
  <script>
    jQuery(document).ready(function ($) {
      var mediaUploader;
      $('#project_logo_button').click(function (e) {
        e.preventDefault();
        if (mediaUploader) {
          mediaUploader.open();
          return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
          title: '<?php _e('Choose Project Logo', 'fatties-corp'); ?>',
          button: {
            text: '<?php _e('Choose Logo', 'fatties-corp'); ?>'
          },
          multiple: false
        });
        mediaUploader.on('select', function () {
          var attachment = mediaUploader.state().get('selection').first().toJSON();
          $('#project_logo').val(attachment.url);
          if ($('#project_logo_preview').length) {
            $('#project_logo_preview').attr('src', attachment.url);
          } else {
            $('#project_logo').after('<br><br><img src="' + attachment.url + '" style="max-width: 200px; height: auto; display: block; margin-top: 10px;" id="project_logo_preview">');
          }
        });
        mediaUploader.open();
      });
    });
  </script>
  <?php
}

function fatties_corp_testimonial_meta_box_callback($post)
{
  wp_nonce_field('fatties_corp_testimonial_meta_box', 'fatties_corp_testimonial_meta_box_nonce');

  $testimonial_name = get_post_meta($post->ID, '_testimonial_name', true);
  $testimonial_position = get_post_meta($post->ID, '_testimonial_position', true);
  $testimonial_company = get_post_meta($post->ID, '_testimonial_company', true);
  $testimonial_rating = get_post_meta($post->ID, '_testimonial_rating', true);
  ?>
  <p>
    <label for="testimonial_name"><?php _e('Tên khách hàng:', 'fatties-corp'); ?></label><br>
    <input type="text" id="testimonial_name" name="testimonial_name" value="<?php echo esc_attr($testimonial_name); ?>"
      style="width: 100%;">
  </p>
  <p>
    <label for="testimonial_position"><?php _e('Chức vụ:', 'fatties-corp'); ?></label><br>
    <input type="text" id="testimonial_position" name="testimonial_position"
      value="<?php echo esc_attr($testimonial_position); ?>" style="width: 100%;"
      placeholder="e.g., Giám đốc, Trưởng phòng">
  </p>
  <p>
    <label for="testimonial_company"><?php _e('Công ty/Tổ chức:', 'fatties-corp'); ?></label><br>
    <input type="text" id="testimonial_company" name="testimonial_company"
      value="<?php echo esc_attr($testimonial_company); ?>" style="width: 100%;">
  </p>
  <p>
    <label for="testimonial_rating"><?php _e('Đánh giá (1-5 sao):', 'fatties-corp'); ?></label><br>
    <input type="number" id="testimonial_rating" name="testimonial_rating"
      value="<?php echo esc_attr($testimonial_rating ? $testimonial_rating : '5'); ?>" min="1" max="5"
      style="width: 100%;">
    <small style="color: #666;"><?php _e('Nhập số sao từ 1 đến 5', 'fatties-corp'); ?></small>
  </p>
  <p>
    <label><?php _e('Nội dung đánh giá:', 'fatties-corp'); ?></label><br>
    <small
      style="color: #666;"><?php _e('Sử dụng phần "Nội dung" bên dưới để nhập nội dung đánh giá của khách hàng', 'fatties-corp'); ?></small>
  </p>
  <?php
}

function fatties_corp_service_meta_box_callback($post)
{
  wp_nonce_field('fatties_corp_service_meta_box', 'fatties_corp_service_meta_box_nonce');

  $service_icon = get_post_meta($post->ID, '_service_icon', true);
  ?>
  <p>
    <label for="service_icon"><?php _e('Service Icon (Ionicons name):', 'fatties-corp'); ?></label><br>
    <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($service_icon); ?>"
      style="width: 100%;" placeholder="e.g., desktop-outline">
    <small style="color: #666;">
      <?php _e('See available icons at', 'fatties-corp'); ?> <a href="https://ionic.io/ionicons" target="_blank">Ionicons</a>.
    </small>
  </p>
  <?php
}

// Save Meta Box Data
function fatties_corp_save_meta_boxes($post_id)
{
  // Team Member Meta
  if (
    isset($_POST['fatties_corp_team_member_meta_box_nonce']) &&
    wp_verify_nonce($_POST['fatties_corp_team_member_meta_box_nonce'], 'fatties_corp_team_member_meta_box')
  ) {
    if (isset($_POST['team_member_position'])) {
      update_post_meta($post_id, '_team_member_position', sanitize_text_field($_POST['team_member_position']));
    }
    if (isset($_POST['team_member_facebook'])) {
      update_post_meta($post_id, '_team_member_facebook', esc_url_raw($_POST['team_member_facebook']));
    }
    if (isset($_POST['team_member_twitter'])) {
      update_post_meta($post_id, '_team_member_twitter', esc_url_raw($_POST['team_member_twitter']));
    }
    if (isset($_POST['team_member_instagram'])) {
      update_post_meta($post_id, '_team_member_instagram', esc_url_raw($_POST['team_member_instagram']));
    }
    if (isset($_POST['team_member_email'])) {
      update_post_meta($post_id, '_team_member_email', sanitize_email($_POST['team_member_email']));
    }
  }

  // Project Meta
  if (
    isset($_POST['fatties_corp_project_meta_box_nonce']) &&
    wp_verify_nonce($_POST['fatties_corp_project_meta_box_nonce'], 'fatties_corp_project_meta_box')
  ) {
    if (isset($_POST['project_url'])) {
      update_post_meta($post_id, '_project_url', esc_url_raw($_POST['project_url']));
    }
    if (isset($_POST['project_type'])) {
      update_post_meta($post_id, '_project_type', sanitize_text_field($_POST['project_type']));
    }
    if (isset($_POST['project_logo'])) {
      update_post_meta($post_id, '_project_logo', esc_url_raw($_POST['project_logo']));
    }
    if (isset($_POST['project_title_fallback'])) {
      update_post_meta($post_id, '_project_title_fallback', sanitize_text_field($_POST['project_title_fallback']));
    }
  }

  // Testimonial Meta
  if (
    isset($_POST['fatties_corp_testimonial_meta_box_nonce']) &&
    wp_verify_nonce($_POST['fatties_corp_testimonial_meta_box_nonce'], 'fatties_corp_testimonial_meta_box')
  ) {
    if (isset($_POST['testimonial_name'])) {
      update_post_meta($post_id, '_testimonial_name', sanitize_text_field($_POST['testimonial_name']));
    }
    if (isset($_POST['testimonial_position'])) {
      update_post_meta($post_id, '_testimonial_position', sanitize_text_field($_POST['testimonial_position']));
    }
    if (isset($_POST['testimonial_company'])) {
      update_post_meta($post_id, '_testimonial_company', sanitize_text_field($_POST['testimonial_company']));
    }
    if (isset($_POST['testimonial_rating'])) {
      $rating = intval($_POST['testimonial_rating']);
      $rating = max(1, min(5, $rating));  // Ensure rating is between 1 and 5
      update_post_meta($post_id, '_testimonial_rating', $rating);
    }
  }

  // Service Meta
  if (
    isset($_POST['fatties_corp_service_meta_box_nonce']) &&
    wp_verify_nonce($_POST['fatties_corp_service_meta_box_nonce'], 'fatties_corp_service_meta_box')
  ) {
    if (isset($_POST['service_icon'])) {
      update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
  }
}

add_action('save_post', 'fatties_corp_save_meta_boxes');

// Customizer Settings
function fatties_corp_customize_register($wp_customize)
{
  // Hero Section
  $wp_customize->add_section('fatties_corp_hero', array(
    'title' => __('Hero Section', 'fatties-corp'),
    'priority' => 30,
  ));

  $wp_customize->add_setting('hero_background', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background', array(
    'label' => __('Hero Background Image', 'fatties-corp'),
    'section' => 'fatties_corp_hero',
    'settings' => 'hero_background',
  )));

  // Stats Section
  $wp_customize->add_section('fatties_corp_stats', array(
    'title' => __('Statistics Section', 'fatties-corp'),
    'priority' => 40,
  ));

  $wp_customize->add_setting('stats_projects', array(
    'default' => '30',
    'sanitize_callback' => 'absint',
  ));

  $wp_customize->add_control('stats_projects', array(
    'label' => __('Projects Completed', 'fatties-corp'),
    'section' => 'fatties_corp_stats',
    'type' => 'number',
  ));

  $wp_customize->add_setting('stats_customers', array(
    'default' => '100',
    'sanitize_callback' => 'absint',
  ));

  $wp_customize->add_control('stats_customers', array(
    'label' => __('Happy Customers', 'fatties-corp'),
    'section' => 'fatties_corp_stats',
    'type' => 'number',
  ));

  $wp_customize->add_setting('stats_companies', array(
    'default' => '2',
    'sanitize_callback' => 'absint',
  ));

  $wp_customize->add_control('stats_companies', array(
    'label' => __('Child Companies', 'fatties-corp'),
    'section' => 'fatties_corp_stats',
    'type' => 'number',
  ));

  $wp_customize->add_setting('stats_visitors', array(
    'default' => '50000',
    'sanitize_callback' => 'absint',
  ));

  $wp_customize->add_control('stats_visitors', array(
    'label' => __('Monthly Visitors', 'fatties-corp'),
    'section' => 'fatties_corp_stats',
    'type' => 'number',
  ));

  // Contact Form Section
  $wp_customize->add_section('fatties_corp_contact', array(
    'title' => __('Contact Page', 'fatties-corp'),
    'priority' => 50,
  ));

  $wp_customize->add_setting('contact_form_id', array(
    'default' => '',
    'sanitize_callback' => 'absint',
  ));

  $wp_customize->add_control('contact_form_id', array(
    'label' => __('WPForms Form ID', 'fatties-corp'),
    'description' => __('Nhập ID của form WPForms bạn muốn hiển thị trên trang liên hệ. Bạn có thể tìm ID này trong WPForms > All Forms.', 'fatties-corp'),
    'section' => 'fatties_corp_contact',
    'type' => 'number',
  ));
}

add_action('customize_register', 'fatties_corp_customize_register');

function theme_prefix_register_elementor_locations($elementor_theme_manager)
{
  $elementor_theme_manager->register_location('header');
  $elementor_theme_manager->register_location('footer');
}

add_action('elementor/theme/register_locations', 'theme_prefix_register_elementor_locations');

// Handle Contact Form Submission
function fatties_corp_handle_contact_form()
{
  // Check if form was submitted
  if (!isset($_POST['fatties_contact_submit'])) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
      error_log('Contact Form: Submit button not found in POST data');
    }
    return null;
  }

  if (!isset($_POST['fatties_contact_nonce']) || !wp_verify_nonce($_POST['fatties_contact_nonce'], 'fatties_contact_form')) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
      error_log('Contact Form: Nonce verification failed');
    }
    return array('success' => false, 'message' => 'Lỗi bảo mật. Vui lòng tải lại trang và thử lại.');
  }

  // Sanitize and validate input
  $name = isset($_POST['contact_name']) ? sanitize_text_field($_POST['contact_name']) : '';
  $email = isset($_POST['contact_email']) ? sanitize_email($_POST['contact_email']) : '';
  $phone = isset($_POST['contact_phone']) ? sanitize_text_field($_POST['contact_phone']) : '';
  $message = isset($_POST['contact_message']) ? sanitize_textarea_field($_POST['contact_message']) : '';

  if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Contact Form: Received data - Name: ' . $name . ', Email: ' . $email . ', Phone: ' . $phone);
  }

  // Validation
  $errors = array();
  if (empty($name)) {
    $errors[] = 'Vui lòng nhập tên của bạn.';
  }
  if (empty($email) || !is_email($email)) {
    $errors[] = 'Vui lòng nhập email hợp lệ.';
  }
  if (empty($message)) {
    $errors[] = 'Vui lòng nhập tin nhắn.';
  }

  // If no errors, send email
  if (empty($errors)) {
    $to = 'hello@fatties.vn';
    $subject = 'Liên hệ mới từ ' . get_bloginfo('name') . ' - ' . $name;
    $body = "Bạn có một tin nhắn liên hệ mới:\n\n";
    $body .= 'Tên: ' . $name . "\n";
    $body .= 'Email: ' . $email . "\n";
    $body .= 'Số điện thoại: ' . $phone . "\n\n";
    $body .= "Tin nhắn:\n" . $message . "\n";

    $headers = array(
      'Content-Type: text/html; charset=UTF-8',
      'From: ' . $name . ' <' . $email . '>',
      'Reply-To: ' . $email
    );

    if (defined('WP_DEBUG') && WP_DEBUG) {
      error_log('Contact Form: Attempting to send email to ' . $to);
      error_log('Contact Form: Subject: ' . $subject);
    }

    // Add filter to log mail errors
    add_filter('wp_mail_failed', function ($wp_error) {
      if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Contact Form: wp_mail failed - ' . $wp_error->get_error_message());
        if ($wp_error->get_error_data()) {
          error_log('Contact Form: wp_mail error data: ' . print_r($wp_error->get_error_data(), true));
        }
      }
    });

    $sent = wp_mail($to, $subject, nl2br($body), $headers);

    if ($sent) {
      if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Contact Form: Email sent successfully');
      }
      return array('success' => true, 'message' => 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
    } else {
      global $phpmailer;
      $error_message = 'Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại sau.';

      if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Contact Form: wp_mail returned false');
        if (isset($phpmailer) && is_object($phpmailer) && isset($phpmailer->ErrorInfo)) {
          error_log('Contact Form: PHPMailer Error: ' . $phpmailer->ErrorInfo);
          $error_message .= ' (Debug: ' . $phpmailer->ErrorInfo . ')';
        }
      }

      return array('success' => false, 'message' => $error_message);
    }
  } else {
    if (defined('WP_DEBUG') && WP_DEBUG) {
      error_log('Contact Form: Validation errors: ' . implode(', ', $errors));
    }
    return array('success' => false, 'message' => implode('<br>', $errors));
  }
}

add_filter('wpforms_frontend_strings', function ($strings) {
  $strings['val_required'] = 'Vui lòng không để trống trường này.';
  return $strings;
});

/**
 * Handle compact CTA form submissions (homepage & blog).
 */
function fatties_corp_handle_cta_contact()
{
  $redirect = isset($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : wp_get_referer();
  $redirect = $redirect ? remove_query_arg(array('cta_status', 'cta_msg'), $redirect) : home_url('/');

  if (!isset($_POST['fatties_cta_nonce']) || !wp_verify_nonce($_POST['fatties_cta_nonce'], 'fatties_cta_form')) {
    wp_safe_redirect(add_query_arg(array(
      'cta_status' => 'error',
      'cta_msg' => urlencode('Yêu cầu không hợp lệ. Vui lòng thử lại.'),
    ), $redirect));
    exit;
  }

  $name = isset($_POST['cta_name']) ? sanitize_text_field($_POST['cta_name']) : '';
  $phone = isset($_POST['cta_phone']) ? sanitize_text_field($_POST['cta_phone']) : '';
  $company = isset($_POST['cta_company']) ? sanitize_text_field($_POST['cta_company']) : '';
  $email = isset($_POST['cta_email']) ? sanitize_email($_POST['cta_email']) : '';
  $message = isset($_POST['cta_message']) ? sanitize_textarea_field($_POST['cta_message']) : '';

  $errors = array();

  if (empty($name)) {
    $errors[] = 'Vui lòng nhập họ và tên.';
  }
  if (empty($phone)) {
    $errors[] = 'Vui lòng nhập số điện thoại.';
  }
  if (empty($company)) {
    $errors[] = 'Vui lòng nhập tên công ty.';
  }
  if (empty($email) || !is_email($email)) {
    $errors[] = 'Vui lòng nhập email hợp lệ.';
  }
  if (empty($message)) {
    $errors[] = 'Vui lòng nhập nội dung lời nhắn.';
  }

  $attachments = array();
  if (!empty($_FILES['cta_file']['name'])) {
    if ($_FILES['cta_file']['size'] > 5 * 1024 * 1024) {
      $errors[] = 'Tệp đính kèm tối đa 5MB.';
    } else {
      require_once ABSPATH . 'wp-admin/includes/file.php';
      $upload = wp_handle_upload($_FILES['cta_file'], array(
        'test_form' => false,
        'mimes' => array(
          'pdf' => 'application/pdf',
          'doc' => 'application/msword',
          'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
          'png' => 'image/png',
          'jpg' => 'image/jpeg',
          'jpeg' => 'image/jpeg',
        ),
      ));

      if (isset($upload['error'])) {
        $errors[] = 'Không thể tải tệp lên: ' . sanitize_text_field($upload['error']);
      } elseif (isset($upload['file'])) {
        $attachments[] = $upload['file'];
      }
    }
  }

  if (empty($errors)) {
    $to = get_option('admin_email');
    $subject = 'Liên hệ mới từ CTA - ' . $name;
    $body = "Bạn có một liên hệ mới:\n\n";
    $body .= "Họ tên: {$name}\n";
    $body .= "Điện thoại: {$phone}\n";
    $body .= "Công ty: {$company}\n";
    $body .= "Email: {$email}\n\n";
    $body .= "Lời nhắn:\n{$message}\n";

    $headers = array(
      'Content-Type: text/html; charset=UTF-8',
      'Reply-To: ' . $email,
    );

    $sent = wp_mail($to, $subject, nl2br($body), $headers, $attachments);

    $status = $sent ? 'success' : 'error';
    $msg = $sent ? 'Cảm ơn bạn! Chúng tôi sẽ liên hệ sớm nhất.' : 'Gửi thất bại. Vui lòng thử lại sau.';
  } else {
    $status = 'error';
    $msg = implode(' ', $errors);
  }

  wp_safe_redirect(add_query_arg(array(
    'cta_status' => $status,
    'cta_msg' => urlencode($msg),
  ), $redirect));
  exit;
}

add_action('admin_post_nopriv_fatties_corp_cta_contact', 'fatties_corp_handle_cta_contact');
add_action('admin_post_fatties_corp_cta_contact', 'fatties_corp_handle_cta_contact');

/**
 * Surface CTA feedback on the frontend.
 */
function fatties_corp_get_cta_feedback()
{
  if (!isset($_GET['cta_status'])) {
    return null;
  }

  $status = sanitize_text_field($_GET['cta_status']);
  $message = isset($_GET['cta_msg']) ? sanitize_text_field(rawurldecode($_GET['cta_msg'])) : '';

  return array(
    'status' => $status === 'success' ? 'success' : 'error',
    'message' => $message,
  );
}

/**
 * Calculate reading time
 */
function fatties_corp_reading_time()
{
  $content = get_post_field('post_content', get_the_ID());
  $word_count = str_word_count(strip_tags($content));
  $reading_time = ceil($word_count / 250);
  return $reading_time < 1 ? 1 : $reading_time;
}

// Custom Login Page Style
function fatties_corp_login_style()
{
  wp_enqueue_style('fatties-corp-login', get_template_directory_uri() . '/assets/css/login.css');
  wp_enqueue_style('fatties-corp-fonts', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap', array(), null);
}

add_action('login_enqueue_scripts', 'fatties_corp_login_style');

// Change Login Logo URL
function fatties_corp_login_logo_url()
{
  return home_url();
}

add_filter('login_headerurl', 'fatties_corp_login_logo_url');

// Change Login Logo Title
function fatties_corp_login_logo_url_title()
{
  return get_bloginfo('name');
}

add_filter('login_headertext', 'fatties_corp_login_logo_url_title');

// ==========================================
// RECRUITMENT SYSTEM (TUYỂN DỤNG)
// ==========================================

// 1. Register Job Post Type
function fatties_corp_register_job_cpt()
{
  register_post_type('job', array(
    'labels' => array(
      'name' => __('Tuyển dụng', 'fatties-corp'),
      'singular_name' => __('Công việc', 'fatties-corp'),
      'add_new' => __('Thêm tin tuyển dụng', 'fatties-corp'),
      'add_new_item' => __('Thêm tin tuyển dụng mới', 'fatties-corp'),
      'edit_item' => __('Sửa tin tuyển dụng', 'fatties-corp'),
      'new_item' => __('Tin tuyển dụng mới', 'fatties-corp'),
      'view_item' => __('Xem tin tuyển dụng', 'fatties-corp'),
      'search_items' => __('Tìm kiếm tin tuyển dụng', 'fatties-corp'),
      'not_found' => __('Không tìm thấy tin tuyển dụng', 'fatties-corp'),
      'not_found_in_trash' => __('Không tìm thấy trong thùng rác', 'fatties-corp'),
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-id',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array('slug' => 'careers'),
    'show_in_rest' => true,  // Enable Gutenberg editor
  ));
}

add_action('init', 'fatties_corp_register_job_cpt');

// 2. Register Job Taxonomies
function fatties_corp_register_job_taxonomies()
{
  // Job Type (Full-time, Part-time, etc.)
  register_taxonomy('job_type', 'job', array(
    'labels' => array(
      'name' => __('Loại công việc', 'fatties-corp'),
      'singular_name' => __('Loại công việc', 'fatties-corp'),
      'add_new_item' => __('Thêm loại công việc', 'fatties-corp'),
      'new_item_name' => __('Tên loại công việc mới', 'fatties-corp'),
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'job-type'),
  ));

  // Job Department (Engineering, Design, Marketing, etc.)
  register_taxonomy('job_department', 'job', array(
    'labels' => array(
      'name' => __('Phòng ban', 'fatties-corp'),
      'singular_name' => __('Phòng ban', 'fatties-corp'),
      'add_new_item' => __('Thêm phòng ban', 'fatties-corp'),
      'new_item_name' => __('Tên phòng ban mới', 'fatties-corp'),
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'job-department'),
  ));

  // Job Location
  register_taxonomy('job_location', 'job', array(
    'labels' => array(
      'name' => __('Địa điểm làm việc', 'fatties-corp'),
      'singular_name' => __('Địa điểm', 'fatties-corp'),
      'add_new_item' => __('Thêm địa điểm', 'fatties-corp'),
      'new_item_name' => __('Tên địa điểm mới', 'fatties-corp'),
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'job-location'),
  ));
}

add_action('init', 'fatties_corp_register_job_taxonomies');

// 3. Register Job Meta Boxes
function fatties_corp_add_job_meta_boxes()
{
  add_meta_box(
    'job_details',
    __('Thông tin tuyển dụng', 'fatties-corp'),
    'fatties_corp_job_meta_box_callback',
    'job',
    'normal',
    'high'
  );
}

add_action('add_meta_boxes', 'fatties_corp_add_job_meta_boxes');

function fatties_corp_job_meta_box_callback($post)
{
  wp_nonce_field('fatties_corp_job_meta_box', 'fatties_corp_job_meta_box_nonce');

  $salary = get_post_meta($post->ID, '_job_salary', true);
  $deadline = get_post_meta($post->ID, '_job_deadline', true);
  $experience = get_post_meta($post->ID, '_job_experience', true);
  $apply_email = get_post_meta($post->ID, '_job_apply_email', true);
  ?>
  <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
    <p style="width: 48%;">
      <label for="job_salary"><strong><?php _e('Mức lương:', 'fatties-corp'); ?></strong></label><br>
      <input type="text" id="job_salary" name="job_salary" value="<?php echo esc_attr($salary); ?>" style="width: 100%;" placeholder="VD: 15.000.000 - 20.000.000 VNĐ hoặc Thỏa thuận">
    </p>

    <p style="width: 48%;">
      <label for="job_deadline"><strong><?php _e('Hạn nộp hồ sơ:', 'fatties-corp'); ?></strong></label><br>
      <input type="date" id="job_deadline" name="job_deadline" value="<?php echo esc_attr($deadline); ?>" style="width: 100%;">
    </p>

    <p style="width: 48%;">
      <label for="job_experience"><strong><?php _e('Yêu cầu kinh nghiệm:', 'fatties-corp'); ?></strong></label><br>
      <input type="text" id="job_experience" name="job_experience" value="<?php echo esc_attr($experience); ?>" style="width: 100%;" placeholder="VD: 1 năm, 2 năm...">
    </p>

    <p style="width: 48%;">
      <label for="job_apply_email"><strong><?php _e('Email nhận CV:', 'fatties-corp'); ?></strong></label><br>
      <input type="email" id="job_apply_email" name="job_apply_email" value="<?php echo esc_attr($apply_email); ?>" style="width: 100%;" placeholder="hr@fatties.vn">
    </p>
  </div>
  <?php
}

function fatties_corp_save_job_meta_box($post_id)
{
  if (!isset($_POST['fatties_corp_job_meta_box_nonce']) ||
      !wp_verify_nonce($_POST['fatties_corp_job_meta_box_nonce'], 'fatties_corp_job_meta_box')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (isset($_POST['job_salary'])) {
    update_post_meta($post_id, '_job_salary', sanitize_text_field($_POST['job_salary']));
  }
  if (isset($_POST['job_deadline'])) {
    update_post_meta($post_id, '_job_deadline', sanitize_text_field($_POST['job_deadline']));
  }
  if (isset($_POST['job_experience'])) {
    update_post_meta($post_id, '_job_experience', sanitize_text_field($_POST['job_experience']));
  }
  if (isset($_POST['job_apply_email'])) {
    update_post_meta($post_id, '_job_apply_email', sanitize_email($_POST['job_apply_email']));
  }
}

add_action('save_post', 'fatties_corp_save_job_meta_box');

// Reorder comment fields: Name/Email -> Comment -> Cookies
function fatties_corp_reorder_comment_fields($fields)
{
  $comment_field = isset($fields['comment']) ? $fields['comment'] : null;
  $cookies_field = isset($fields['cookies']) ? $fields['cookies'] : null;

  // Remove them from their current positions
  if ($comment_field)
    unset($fields['comment']);
  if ($cookies_field)
    unset($fields['cookies']);

  // Add them back at the end in the desired order
  if ($comment_field)
    $fields['comment'] = $comment_field;
  if ($cookies_field)
    $fields['cookies'] = $cookies_field;

  return $fields;
}

add_filter('comment_form_fields', 'fatties_corp_reorder_comment_fields');

// Custom Comment List Callback
function fatties_corp_comment_list($comment, $args, $depth)
{
  ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-avatar">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
            </div>
            
            <div class="comment-main">
                <header class="comment-meta">
                    <div class="comment-author">
                        <b class="fn"><?php echo get_comment_author_link(); ?></b>
                    </div>
                    <div class="comment-metadata">
                        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php printf(__('%1$s lúc %2$s', 'fatties-corp'), get_comment_date(), get_comment_time()); ?>
                            </time>
                        </a>
                    </div>
                    <?php if ($comment->comment_approved == '0'): ?>
                        <div class="comment-awaiting-moderation">
                            <em><?php _e('Bình luận của bạn đang chờ kiểm duyệt.', 'fatties-corp'); ?></em>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>

                <div class="comment-reply">
                    <?php comment_reply_link(array_merge($args, array(
                      'add_below' => 'div-comment',
                      'depth' => $depth,
                      'max_depth' => $args['max_depth'],
                      'before' => '',
                      'after' => ''
                    ))); ?>
                </div>
            </div>
        </article>
    <!-- </li> is closed by WP -->
    <?php
}
