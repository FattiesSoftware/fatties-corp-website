<?php

/**
 * Front Page Template
 * This is the same as index.php but specifically for the front page
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */
get_header();
?>

<!-- Hero Section -->
<section id="section-hero">
  <iframe src="<?php echo get_template_directory_uri(); ?>/landing.html" frameborder="0"
    style="height: 100vh;width: 100vw;margin: 0;pointer-events: none;"></iframe>
  <section id="section05" class="demo">
    <a href="#section-about"><span></span>Cuộn xuống</a>
  </section>
</section>

<!-- About Section -->
<div id="section-about" class="section-container">
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

<!-- Services Section -->
<div id="section-services" class="section-container">
  <div class="p25">
    <div class="main-title" data-aos="fade-up">Chúng tôi làm những gì?</div>
    <div class="secondary-text w750 a-center mg-center" data-aos="fade-up">
      Tập đoàn Fatties gồm 2 công ty con và các công ty này đều kinh doanh
      một số mảng khác nhau. Và dưới đây là các ngành nghề chúng tôi hoạt
      động.
    </div>
  </div>

  <div class="d-row f-wrap cards">
    <div class="card" data-aos="zoom-in-up">
      <center>
        <ion-icon name="desktop-outline" class="mg-center"></ion-icon>
      </center>
      <div class="card-title a-center">Desktop Web App</div>
      <div class="secondary-text a-center">
        Xây dựng ứng dụng cho máy tính để bàn bằng các ngôn ngữ quen thuộc
        như HTML, CSS, JS,...
      </div>
    </div>

    <div class="card" data-aos="zoom-in-up">
      <center>
        <ion-icon name="phone-portrait-outline" class="mg-center"></ion-icon>
      </center>
      <div class="card-title a-center">Native Mobile App</div>
      <div class="secondary-text a-center">
        Viết code một lần, dùng được cho cả 2 nền tảng hệ điều hành nổi
        tiếng là Android và iOS
      </div>
    </div>

    <div class="card" data-aos="zoom-in-up">
      <center>
        <ion-icon name="browsers-outline" class="mg-center"></ion-icon>
      </center>
      <div class="card-title a-center">Website Design</div>
      <div class="secondary-text a-center">
        Là dịch vụ kinh doanh chủ lực, chúng tôi nhận thiết kế website giá
        rẻ chuyên nghiệp cho tất cả mọi người
      </div>
    </div>

    <div class="card" data-aos="zoom-in-up">
      <center>
        <ion-icon name="color-palette-outline" class="mg-center"></ion-icon>
      </center>
      <div class="card-title a-center">Graphic Design</div>
      <div class="secondary-text a-center">
        Chúng tôi nhận làm các dịch vụ như thiết kế logo, tờ rơi, quảng cáo,
        poster, chỉnh sửa video, ảnh...
      </div>
    </div>

    <div class="card" data-aos="zoom-in-up">
      <center>
        <ion-icon name="game-controller-outline" class="mg-center"></ion-icon>
      </center>
      <div class="card-title a-center">Desktop Game</div>
      <div class="secondary-text a-center">
        Là ngành nghề mới mở, chúng tôi đã và đang nghiên cứu, sáng tạo để
        cho ra đời các tựa game trên máy tính
      </div>
    </div>

    <div class="card" data-aos="zoom-in-up">
      <center>
        <ion-icon name="game-controller-outline" class="mg-center"></ion-icon>
      </center>
      <div class="card-title a-center">Mobile Game</div>
      <div class="secondary-text a-center">
        Là thị trường có người dùng tiềm năng nhiều nhất, chúng tôi đang tập
        trung khai thác mảng kinh doanh này
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

<!-- Testimonials Section -->
<div id="section-testimonials" class="section-container">
  <div class="p25">
    <div class="main-title" data-aos="fade-up">Đánh giá từ khách hàng</div>
    <div class="secondary-text w750 a-center mg-center" data-aos="fade-up">
      Những phản hồi tích cực từ khách hàng là động lực để chúng tôi không ngừng cải thiện và phát triển
    </div>

    <div class="d-row f-wrap j-center testimonials-container mg-top60">
      <?php
      $testimonials = new WP_Query(array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
      ));

      $delay = 0;
      if ($testimonials->have_posts()):
        while ($testimonials->have_posts()):
          $testimonials->the_post();
          $testimonial_name = get_post_meta(get_the_ID(), '_testimonial_name', true);
          $testimonial_position = get_post_meta(get_the_ID(), '_testimonial_position', true);
          $testimonial_company = get_post_meta(get_the_ID(), '_testimonial_company', true);
          $testimonial_rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
          $testimonial_rating = $testimonial_rating ? intval($testimonial_rating) : 5;
          $avatar_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
          ?>
          <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="testimonial-content">
              <div class="testimonial-rating">
                <?php
                for ($i = 1; $i <= 5; $i++):
                  $star_class = $i <= $testimonial_rating ? 'star-filled' : 'star-empty';
                  ?>
                  <ion-icon name="star" class="<?php echo $star_class; ?>"></ion-icon>
                  <?php
                endfor;
                ?>
              </div>
              <div class="testimonial-text secondary-text">
                <?php the_content(); ?>
              </div>
            </div>
            <div class="testimonial-author">
              <?php if ($avatar_url): ?>
                <div class="testimonial-avatar">
                  <img src="<?php echo esc_url($avatar_url); ?>"
                    alt="<?php echo esc_attr($testimonial_name ? $testimonial_name : get_the_title()); ?>">
                </div>
              <?php else: ?>
                <div class="testimonial-avatar testimonial-avatar-placeholder">
                  <ion-icon name="person"></ion-icon>
                </div>
              <?php endif; ?>
              <div class="testimonial-info">
                <div class="testimonial-name bold">
                  <?php echo $testimonial_name ? esc_html($testimonial_name) : get_the_title(); ?>
                </div>
                <?php if ($testimonial_position || $testimonial_company): ?>
                  <div class="testimonial-meta secondary-text">
                    <?php
                    if ($testimonial_position && $testimonial_company) {
                      echo esc_html($testimonial_position) . ' - ' . esc_html($testimonial_company);
                    } elseif ($testimonial_position) {
                      echo esc_html($testimonial_position);
                    } elseif ($testimonial_company) {
                      echo esc_html($testimonial_company);
                    }
                    ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php
          $delay += 100;
        endwhile;
        wp_reset_postdata();
      else:
        ?>
        <div class="secondary-text a-center w750 mg-center">
          Chưa có đánh giá nào. Hãy quay lại sau nhé!
        </div>
      <?php endif; ?>
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
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/aos.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/waves.min.js"></script>
<script>
  $(document).ready(function () {
    Waves.attach(".button", ["waves-button", "waves-float", "waves-light"]);
    Waves.init();
  });
</script>
<script>
  // Xử lý scroll ngay khi DOM sẵn sàng, không chờ jQuery ready
  document.addEventListener('DOMContentLoaded', function () {
    // Chỉ xử lý các link không phải nav-link (để tránh xung đột với main.js)
    document.querySelectorAll("a[href*='#']:not(.nav-link)").forEach(function (link) {
      link.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href && href.startsWith('#')) {
          e.preventDefault();
          const target = document.querySelector(href);
          if (target) {
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - 80;
            // Scroll ngay lập tức, không delay
            window.scrollTo({
              top: targetPosition,
              behavior: 'smooth'
            });
          }
        }
      });
    });
  });

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
      var height1 = $("#section-stats").outerHeight();
      var y = document.documentElement.scrollTop;
      var z = x.top - y + (30 / 100) * height1;
      if (z < $(window).height()) {
        if (check === 1) {
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

          check++;
        }
      } else {
        check = 1;
      }
    });
  });

</script>

<!-- Blog Section -->
<div id="section-blog" class="section-container">
  <div class="p25">
    <div class="main-title" data-aos="fade-up">Tin tức & Blog</div>
    <div class="secondary-text w750 a-center mg-center" data-aos="fade-up">
      Cập nhật những tin tức mới nhất, kiến thức và kinh nghiệm từ đội ngũ Fatties Corporation
    </div>

    <div class="d-row f-wrap blog-cards mg-top60">
      <?php
      $blog_posts = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC'
      ));

      $delay = 0;
      if ($blog_posts->have_posts()):
        while ($blog_posts->have_posts()):
          $blog_posts->the_post();
          $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
          $categories = get_the_category();
          ?>
          <div class="blog-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <a href="<?php the_permalink(); ?>" class="blog-card-link">
              <div class="blog-thumbnail"
                style="background-image: url('<?php echo esc_url($thumbnail_url ? $thumbnail_url : get_template_directory_uri() . '/assets/images/default-blog.jpg'); ?>');">
                <div class="blog-overlay"></div>
                <?php if (!empty($categories)): ?>
                  <div class="blog-category"><?php echo esc_html($categories[0]->name); ?></div>
                <?php endif; ?>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="blog-date">
                    <ion-icon name="calendar-outline"></ion-icon>
                    <?php echo get_the_date('d/m/Y'); ?>
                  </span>
                  <span class="blog-author">
                    <ion-icon name="person-outline"></ion-icon>
                    <?php echo get_the_author(); ?>
                  </span>
                </div>
                <h3 class="blog-title"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></h3>
                <div class="blog-excerpt secondary-text">
                  <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                </div>
                <div class="blog-read-more">
                  Đọc thêm <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
              </div>
            </a>
          </div>
          <?php
          $delay += 100;
        endwhile;
        wp_reset_postdata();
      else:
        ?>
        <div class="secondary-text a-center w750 mg-center">
          Chưa có bài viết nào. Hãy quay lại sau nhé!
        </div>
      <?php endif; ?>
    </div>

    <?php
    $blog_page = get_page_by_path('blog');
    $blog_page_link = $blog_page ? get_permalink($blog_page->ID) : get_permalink(get_option('page_for_posts'));
    if ($blog_page_link && $blog_posts->found_posts > 6):
      ?>
      <div class="a-center mg-top60" data-aos="fade-up">
        <a href="<?php echo esc_url($blog_page_link); ?>" class="button view-all-blog">
          Xem tất cả bài viết
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>