<?php

/**
 * Template Name: About, Projects, Team
 *
 * @package Fatties_Corporation
 */
get_header();
?>

<div class="page-header-container">
    <div class="page-header-content">
        <h1 class="page-title">Về Chúng Tôi</h1>
    </div>
</div>

<!-- About Section -->
<div id="section-about" class="section-container" style="padding-top: 50px;">
  <div class="p25">
    <div class="main-title" data-aos="fade-up">Chúng tôi là ai?</div>
    <div class="secondary-text w750 a-center mg-center" data-aos="fade-up">
      Cách đây <span id="years-before-init"><?php echo fatties_corp_get_years_since_founding(); ?></span> năm về trước,
      bắt đầu
      với 2 thành viên xuất thân là học sinh cấp ba đang theo học trường
      THPT Chuyên Biên Hòa, chúng tôi đã sáng lập ra công ty phần mềm
      Fatties tại ngay chính trong khu ký túc xá của trường và sau này được
      mở rộng ra thành Tập đoàn Fatties. Với đối tượng hướng đến chủ yếu là
      học sinh, sinh viên, chúng tôi đã và đang cung cấp các giải pháp phần
      mềm toàn diện và trò chơi với hàng nghìn người sử dụng cho các trường
      học trên toàn quốc.
    </div>
  </div>
  <div class="school-bg">
    <div class="bg-explain a-right">
      Ảnh minh họa trường THPT Chuyên Biên Hòa - Hà Nam
    </div>
  </div>
</div>

<!-- Mission & Vision Section -->
<div id="section-mission-vision" class="section-container">
  <div class="mg-center w1100 d-row f-wrap p25">
    <div style="min-width: 50%" id="text-group2" class="w500" data-aos="fade-right">
      <div class="title a-left">Sứ mệnh của chúng tôi</div>
      <div class="secondary-text a-left">
        Tập đoàn Fatties được thành lập với mục tiêu duy nhất là thiết kế
        các phần mềm và trò chơi chất lượng cao phục vụ cho đối tượng học
        sinh, sinh viên và giáo viên.
      </div>
    </div>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mission.jpg" alt="Our mission"
      class="mission-img section" data-aos="fade-left">
  </div>

  <div class="mg-center w1100 d-row f-wrap p25 mg-top80">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vision.jpg" alt="Our vision"
      class="vision-img section" data-aos="fade-right">
    <div style="min-width: 50%" id="text-group22" class="w500" data-aos="fade-left">
      <div class="title a-left">Tầm nhìn</div>
      <div class="secondary-text a-left">
        Chúng tôi mong muốn tất cả các trường cấp ba trên toàn quốc đều được
        tiếp cận đến giải pháp phần mềm của chúng tôi. Và trở thành startup
        công nghệ kì lân của Việt Nam trong 5-10 năm tới.
      </div>
    </div>
  </div>
</div>

<!-- Projects Section -->
<div id="section-projects" class="section-container">
  <div class="p25">
    <div class="main-title" data-aos="fade-up">Dự án tiêu biểu</div>
    <div class="secondary-text a-center w750 mg-center mg-b50" data-aos="fade-up" data-aos-delay="100">
      Fatties Corporation sẽ đạt mốc 10 dự án đã làm và đạt mốc 100 khách
      hàng trong năm <span id="current-year"><?php echo fatties_corp_get_current_year(); ?></span>. Kể từ ngày đầu tiên
      hoạt động, dự án chủ yếu của Fatties Corporation đều là do các khách
      hàng tin tưởng giới thiệu.
    </div>

    <div class="dp-flex j-center f-wrap" data-aos="fade-up" data-aos-delay="200">
      <button class="button mg-h10 active" id="cat-all" onclick="categoryChange('all')" data-category="all">
        Tất cả
      </button>
      <?php
      $project_categories = get_terms(array(
        'taxonomy' => 'project_category',
        'hide_empty' => true,
        'orderby' => 'name',
        'order' => 'DESC',
      ));

      if (!empty($project_categories) && !is_wp_error($project_categories)):
        foreach ($project_categories as $category):
          $category_slug = esc_attr($category->slug);
          $category_name = esc_html($category->name);
          ?>
          <button class="button mg-h10" id="cat-<?php echo $category_slug; ?>"
            onclick="categoryChange('<?php echo $category_slug; ?>')" data-category="<?php echo $category_slug; ?>">
            <?php echo $category_name; ?>
          </button>
          <?php
        endforeach;
      endif;
      ?>
    </div>

    <div class="mg-v60 dp-flex j-center f-wrap" id="projects-container">
      <?php
      $projects = new WP_Query(array(
        'post_type' => 'project',
        'posts_per_page' => -1,
        'orderby' => 'post_date',
        'order' => 'ASC'
      ));

      $project_delay = 0;
      if ($projects->have_posts()):
        while ($projects->have_posts()):
          $projects->the_post();
          $project_type = get_post_meta(get_the_ID(), '_project_type', true);
          $project_url = get_post_meta(get_the_ID(), '_project_url', true);
          $project_logo = get_post_meta(get_the_ID(), '_project_logo', true);
          $project_title_fallback = get_post_meta(get_the_ID(), '_project_title_fallback', true);
          $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');

          // Lấy categories của project
          $project_categories = get_the_terms(get_the_ID(), 'project_category');
          $category_slugs = array('all');  // Luôn thêm 'all' để hiển thị khi chọn "Tất cả"
          if (!empty($project_categories) && !is_wp_error($project_categories)):
            foreach ($project_categories as $cat):
              $category_slugs[] = $cat->slug;
            endforeach;
          endif;
          $category_data = implode(' ', $category_slugs);
          ?>
          <div class="project-card mg-h20" data-aos="fade-up" data-aos-delay="<?php echo $project_delay; ?>"
            data-category="<?php echo esc_attr($category_data); ?>">
            <div class="project-screenshot" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
              <div class="bg-overlay"></div>
              <?php if ($project_logo): ?>
                <div class="project-logo">
                  <img src="<?php echo esc_url($project_logo); ?>" alt="<?php the_title(); ?> Logo" class="prj-logo">
                </div>
              <?php elseif ($project_title_fallback): ?>
                <div class="project-logo">
                  <div class="project-title-fallback"><?php echo esc_html($project_title_fallback); ?></div>
                </div>
              <?php endif; ?>
              <div class="view-detail">
                <a href="<?php the_permalink(); ?>">Xem chi tiết</a>
              </div>
            </div>
            <div class="below-screenshot">
              <div class="project-title a-center">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </div>
              <div class="project-category a-center"><?php echo esc_html($project_type); ?></div>
            </div>
          </div>
          <?php
          $project_delay += 100;
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</div>

<!-- Team Section -->
<div id="section-team" class="section-container">
  <div class="p25">
    <div class="main-title" data-aos="fade-up">Đội ngũ của chúng tôi</div>
    <div class="secondary-text a-center" data-aos="fade-up">
      Hãy gặp gỡ những người giỏi và đầy tham vọng nhất của chúng tôi...
    </div>

    <div class="employee-photos d-row j-sa mg-top60 f-wrap">
      <?php
      $team_members = new WP_Query(array(
        'post_type' => 'team_member',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
      ));

      $delay = 0;
      if ($team_members->have_posts()):
        while ($team_members->have_posts()):
          $team_members->the_post();
          $position = get_post_meta(get_the_ID(), '_team_member_position', true);
          $facebook = get_post_meta(get_the_ID(), '_team_member_facebook', true);
          $twitter = get_post_meta(get_the_ID(), '_team_member_twitter', true);
          $instagram = get_post_meta(get_the_ID(), '_team_member_instagram', true);
          $email = get_post_meta(get_the_ID(), '_team_member_email', true);
          ?>
          <div class="mg-b45 ep-child min-w300" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <center>
              <a href="<?php the_permalink(); ?>" class="link ep-link">
                <div class="view-profile">Xem hồ sơ</div>
                <?php if (has_post_thumbnail()): ?>
                  <?php the_post_thumbnail('medium', array('class' => 'employee-photo', 'alt' => get_the_title())); ?>
                <?php endif; ?>
              </a>
            </center>
            <div class="e-name bold a-center purple">
              <a href="<?php the_permalink(); ?>" class="link"><?php the_title(); ?></a>
            </div>
            <div class="secondary-text a-center mg-b15">
              <?php echo esc_html($position); ?>
            </div>
            <div class="dp-flex j-center">
              <?php if ($facebook): ?>
                <a href="<?php echo esc_url($facebook); ?>" target="_blank" class="link">
                  <div class="social-button center-both white mg-h5">
                    <ion-icon name="logo-facebook"></ion-icon>
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($twitter): ?>
                <a href="<?php echo esc_url($twitter); ?>" target="_blank" class="link">
                  <div class="social-button center-both white mg-h5">
                    <ion-icon name="logo-twitter"></ion-icon>
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($instagram): ?>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank" class="link">
                  <div class="social-button center-both white mg-h5">
                    <ion-icon name="logo-instagram"></ion-icon>
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($email): ?>
                <a href="mailto:<?php echo esc_attr($email); ?>" class="link">
                  <div class="social-button center-both white mg-h5">
                    <ion-icon name="mail"></ion-icon>
                  </div>
                </a>
              <?php endif; ?>
            </div>
          </div>
          <?php
          $delay += 300;
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</div>

<!-- Statistics Section -->
<div id="section-stats" class="section-container">
  <div class="p25">
    <div class="main-title" data-aos="fade-up">
      Thành quả của <span id="years-before-init2"><?php echo fatties_corp_get_years_since_founding(); ?></span> năm
      phụng sự khách hàng
    </div>
    <div class="stats d-row j-sa f-wrap mg-top25">
      <div class="stats-child" data-aos="flip-left">
        <center>
          <ion-icon name="briefcase-outline" class="white fs100 mg0"></ion-icon>
        </center>
        <div class="bold fs60 a-center" id="projects-done"><?php echo get_theme_mod('stats_projects', '30'); ?>+</div>
        <div class="a-center">Dự án hoàn thành</div>
      </div>

      <div class="stats-child" data-aos="flip-left">
        <center>
          <ion-icon name="people-outline" class="white fs100 mg0"></ion-icon>
        </center>
        <div class="bold fs60 a-center" id="happy-customers"><?php echo get_theme_mod('stats_customers', '100'); ?>+
        </div>
        <div class="a-center">Khách hàng hài lòng</div>
      </div>

      <div class="stats-child" data-aos="flip-left">
        <center>
          <ion-icon name="business-outline" class="white fs100 mg0"></ion-icon>
        </center>
        <div class="bold fs60 a-center" id="child-companies"><?php echo get_theme_mod('stats_companies', '2'); ?>+</div>
        <div class="a-center">Công ty thành viên</div>
      </div>

      <div class="stats-child" data-aos="flip-left">
        <center>
          <ion-icon name="bar-chart-outline" class="white fs100 mg0"></ion-icon>
        </center>
        <div class="bold fs60 a-center" id="monthly-visitors">
          <?php echo number_format(get_theme_mod('stats_visitors', '50000')); ?>+
        </div>
        <div class="a-center">Người truy cập hàng tháng</div>
      </div>
    </div>
    <div class="a-center light fs18 mg-v20" data-aos="fade-up">
      Thiết kế website là một niềm đam mê, nhìn thấy khách hàng hài lòng với sản phẩm là hạnh phúc
    </div>
  </div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/aos.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/waves.min.js"></script>
<script>
  $(document).ready(function () {
    Waves.attach(".button", ["waves-button", "waves-float", "waves-light"]);
    Waves.init();
  });
</script>
<script>
  document.getElementById("years-before-init").innerHTML =
    new Date().getFullYear() - 2020;

  document.getElementById("years-before-init2").innerHTML =
    new Date().getFullYear() - 2020;

  document.getElementById("current-year").innerHTML =
    new Date().getFullYear();

  let check = 1;

  $(document).ready(function () {
    $(window).scroll(function () {
      var x = $("#section-stats").offset();
      if (!x) return; // Guard clause in case element is missing
      var height1 = $("#section-stats").outerHeight();
      var y = document.documentElement.scrollTop;
      var z = x.top - y + (30 / 100) * height1;
      if (z < $(window).height()) {
        if (check === 1) {
            // Check if CountUp is defined
            if (typeof countUp !== 'undefined' && typeof countUp.CountUp !== 'undefined') {
                new countUp.CountUp("projects-done", <?php echo get_theme_mod('stats_projects', '30'); ?>, {
                    suffix: "+",
                    duration: 4,
                }).start();

                new countUp.CountUp("happy-customers", <?php echo get_theme_mod('stats_customers', '100'); ?>, {
                    suffix: "+",
                    duration: 4,
                }).start();

                new countUp.CountUp("child-companies", <?php echo get_theme_mod('stats_companies', '2'); ?>, {
                    suffix: "+",
                    duration: 4,
                }).start();

                new countUp.CountUp("monthly-visitors", <?php echo get_theme_mod('stats_visitors', '50000'); ?>, {
                    suffix: "+",
                    duration: 4,
                }).start();

                new countUp.CountUp(
                    "years-before-init2",
                    new Date().getFullYear() - 2020,
                    { duration: 4 }
                ).start();
            }

          check++;
        }
      } else {
        check = 1;
      }
    });
  });

</script>

<?php get_footer(); ?>
