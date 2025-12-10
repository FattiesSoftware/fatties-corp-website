<?php

/**
 * The template for displaying Service Archive pages
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */
get_header();
?>

<div class="site-content" style="padding: 75px 25px; min-height: 100vh; background-color: #f5f5f5;">
  <div class="container" style="max-width: 1400px; margin: 0 auto;">

    <header class="page-header" style="text-align: center; margin-bottom: 60px;">
      <h1 class="page-title main-title" data-aos="fade-up"><?php single_term_title(); ?></h1>
      <div class="secondary-text w750 mg-center" data-aos="fade-up" data-aos-delay="100">
        <?php
        $description = get_the_archive_description();
        if ($description) {
          echo $description;
        } else {
          echo 'Chúng tôi cung cấp các giải pháp công nghệ toàn diện giúp doanh nghiệp của bạn phát triển mạnh mẽ trong kỷ nguyên số.';
        }
        ?>
      </div>
    </header>

    <?php if (have_posts()): ?>
      <div class="services-grid d-row f-wrap j-center" style="gap: 30px;">
        <?php
        $delay = 0;
        while (have_posts()):
          the_post();
          $icon = get_post_meta(get_the_ID(), '_service_icon', true);
          if (empty($icon)) {
            $icon = 'layers-outline';  // Default icon
          }
          ?>
          
          <div class="service-wrapper" data-aos="zoom-in-up" data-aos-delay="<?php echo $delay; ?>">
            <a href="<?php the_permalink(); ?>" style="text-decoration: none; display: block; height: 100%;">
              <div class="card" style="width: 350px; height: 100%; display: flex; flex-direction: column; justify-content: flex-start; margin: 0;">
                <center>
                  <ion-icon name="<?php echo esc_attr($icon); ?>" class="mg-center"></ion-icon>
                </center>
                <div class="card-title a-center"><?php the_title(); ?></div>
                <div class="secondary-text a-center" style="flex-grow: 1;">
                  <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                </div>
                
                <div class="a-center mg-top25">
                  <span class="service-cta" style="
                      display: inline-block;
                      padding: 10px 25px;
                      border-radius: 30px;
                      font-weight: bold;
                      font-size: 14px;
                      text-transform: uppercase;
                      transition: all 0.3s;
                    ">
                    Xem chi tiết
                  </span>
                </div>
              </div>
            </a>
          </div>

          <?php
          $delay += 100;
        endwhile;
        ?>
      </div>
      
      <?php if ($GLOBALS['wp_query']->max_num_pages > 1): ?>
      <div class="pagination" style="margin-top: 60px; text-align: center;">
        <?php
        the_posts_pagination(array(
          'mid_size' => 2,
          'prev_text' => '<ion-icon name="chevron-back-outline"></ion-icon>',
          'next_text' => '<ion-icon name="chevron-forward-outline"></ion-icon>',
        ));
        ?>
      </div>
      <?php endif; ?>

    <?php else: ?>
      
      <div class="no-results" style="text-align: center; padding: 100px 0;">
        <h2 style="font-size: 24px; color: #666;">Chưa có dịch vụ nào được cập nhật.</h2>
      </div>

    <?php endif; ?>

  </div>
</div>

<style>
  .service-wrapper {
    transition: transform 0.3s;
  }
  .service-wrapper:hover {
    transform: translateY(-10px);
  }
  /* Force card text to be white since cards have gradient background by default in style.css */
  .card .card-title,
  .card .secondary-text {
    transition: color 0.3s;
  }
  
  .card .card-title {
    color: #212121;
  }

  .card:hover .card-title {
    color: white !important;
  }
  /* Override styles from style.css that might conflict */
  .card {
    /* Ensure cards look good even if style.css calls for fixed width */
    max-width: 100%; 
  }
</style>

<?php get_footer(); ?>
