<?php

/**
 * Template Name: Recruitment Page
 *
 * The template for displaying Recruitment page with job listings
 */
get_header();
?>

<div class="site-content" style="padding: 100px 25px; min-height: 100vh; background-color: #f5f5f5;">
  <div class="container" style="max-width: 1200px; margin: 0 auto;">

    <header class="page-header" style="text-align: center; margin-bottom: 60px;">
      <h1 class="page-title main-title" data-aos="fade-up"><?php the_title(); ?></h1>
      <div class="secondary-text w750 mg-center" data-aos="fade-up" data-aos-delay="100">
        <?php
        if (has_excerpt()) {
          the_excerpt();
        } else {
          the_content();
        }
        ?>
      </div>
    </header>

    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'post_type' => 'job',
      'posts_per_page' => 10,
      'paged' => $paged,
      'post_status' => 'publish'
    );
    $jobs_query = new WP_Query($args);

    if ($jobs_query->have_posts()):
      ?>
      <div class="jobs-grid">
        <?php
        $delay = 0;
        while ($jobs_query->have_posts()):
          $jobs_query->the_post();
          $salary = get_post_meta(get_the_ID(), '_job_salary', true);
          $location_terms = get_the_terms(get_the_ID(), 'job_location');
          $location = '';
          if (!empty($location_terms) && !is_wp_error($location_terms)) {
            $location = implode('/', wp_list_pluck($location_terms, 'name'));
          }
          $type_terms = get_the_terms(get_the_ID(), 'job_type');
          $type = !empty($type_terms) ? $type_terms[0]->name : '';
          ?>
          
          <div class="job-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="job-content">
              <h2 class="job-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="job-meta">
                <?php if ($location): ?>
                  <span class="meta-item"><ion-icon name="location-outline"></ion-icon> <?php echo esc_html($location); ?></span>
                <?php endif; ?>
                <?php if ($type): ?>
                  <span class="meta-item"><ion-icon name="briefcase-outline"></ion-icon> <?php echo esc_html($type); ?></span>
                <?php endif; ?>
                <?php if ($salary): ?>
                  <span class="meta-item"><ion-icon name="cash-outline"></ion-icon> <?php echo esc_html($salary); ?></span>
                <?php endif; ?>
              </div>
            </div>
            <div class="job-action">
              <a href="<?php the_permalink(); ?>" class="nav-cta">Xem chi tiết</a>
            </div>
          </div>

          <?php
          $delay += 100;
        endwhile;
        wp_reset_postdata();
        ?>
      </div>
      
      <?php if ($jobs_query->max_num_pages > 1): ?>
        <div class="pagination" style="margin-top: 60px; text-align: center;">
          <?php
          echo paginate_links(array(
            'total' => $jobs_query->max_num_pages,
            'prev_text' => '<ion-icon name="chevron-back-outline"></ion-icon>',
            'next_text' => '<ion-icon name="chevron-forward-outline"></ion-icon>',
          ));
          ?>
        </div>
      <?php endif; ?>

    <?php else: ?>
      <div class="no-results" style="text-align: center; padding: 100px 0;">
        <h2 style="font-size: 24px; color: #666;">Hiện tại chưa có vị trí nào đang tuyển dụng.</h2>
      </div>
    <?php endif; ?>

  </div>
</div>

<style>
  .jobs-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  .job-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .job-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }
  .job-title a {
    text-decoration: none;
    color: #333;
    font-size: 1.5rem;
    font-weight: 700;
    transition: color 0.3s;
  }
  .job-title a:hover {
    color: #F10992;
  }
  .job-meta {
    display: flex;
    gap: 25px;
    margin-top: 10px;
    color: #666;
    font-size: 0.95rem;
  }
  .meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
  }
  .btn-apply {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #F10992 0%, #FF6B6B 100%);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    transition: opacity 0.3s;
  }
  .btn-apply:hover {
    opacity: 0.9;
  }
  @media (max-width: 768px) {
    .job-card {
      flex-direction: column;
      align-items: flex-start;
      gap: 20px;
    }
    .job-meta {
      flex-direction: column;
      gap: 10px;
    }
    .job-action {
      width: 100%;
    }
    .btn-apply {
      width: 100%;
      text-align: center;
    }
  }
</style>

<?php get_footer(); ?>
