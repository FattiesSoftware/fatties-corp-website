<?php
/** The template for displaying Single Job pages */
get_header();

while (have_posts()):
  the_post();
  $salary = get_post_meta(get_the_ID(), '_job_salary', true);
  $deadline = get_post_meta(get_the_ID(), '_job_deadline', true);
  $experience = get_post_meta(get_the_ID(), '_job_experience', true);
  $apply_email = get_post_meta(get_the_ID(), '_job_apply_email', true);

  $location_terms = get_the_terms(get_the_ID(), 'job_location');
  $location = '';
  if (!empty($location_terms) && !is_wp_error($location_terms)) {
    $location = implode('; ', wp_list_pluck($location_terms, 'name'));
  }

  $type_terms = get_the_terms(get_the_ID(), 'job_type');
  $type = !empty($type_terms) ? $type_terms[0]->name : '';

  $dept_terms = get_the_terms(get_the_ID(), 'job_department');
  $department = !empty($dept_terms) ? $dept_terms[0]->name : '';
?>

<div class="site-content" style="padding-top: 80px; padding-bottom: 80px; background-color: #f9f9f9;">
  <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    
    <div class="job-header-card" style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 40px;">
        <div class="job-breadcrumb" style="margin-bottom: 20px; font-size: 14px; color: #888;">
            <a href="<?php echo home_url('/careers'); ?>" style="color: #666; text-decoration: none;">Tuyển dụng</a>
            <?php if ($department): ?>
                 <ion-icon name="chevron-forward-outline" style="vertical-align: text-bottom;"></ion-icon> <?php echo esc_html($department); ?>
            <?php endif; ?>
        </div>
        <h1 class="job-title" style="font-size: 2.5rem; color: #222; margin-bottom: 20px;"><?php the_title(); ?></h1>
        
        <div class="job-highlights" style="display: flex; flex-wrap: wrap; gap: 20px; border-top: 1px solid #eee; padding-top: 20px;">
            <?php if ($location): ?>
                <div class="highlight-item">
                    <ion-icon name="location" style="color: #F10992;"></ion-icon>
                    <span><?php echo esc_html($location); ?></span>
                </div>
            <?php endif; ?>
            <?php if ($type): ?>
                <div class="highlight-item">
                    <ion-icon name="time" style="color: #F10992;"></ion-icon>
                    <span><?php echo esc_html($type); ?></span>
                </div>
            <?php endif; ?>
            <?php if ($salary): ?>
                <div class="highlight-item">
                    <ion-icon name="cash" style="color: #F10992;"></ion-icon>
                    <span><?php echo esc_html($salary); ?></span>
                </div>
            <?php endif; ?>
             <?php if ($experience): ?>
                <div class="highlight-item">
                    <ion-icon name="ribbon" style="color: #F10992;"></ion-icon>
                    <span><?php echo esc_html($experience); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="job-body" style="display: flex; gap: 40px; flex-wrap: wrap;">
        <div class="job-main-content" style="flex: 2; min-width: 300px;">
            <div class="content-box" style="background: white; padding: 40px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                <?php the_content(); ?>
            </div>
        </div>
        
        <div class="job-sidebar" style="flex: 1; min-width: 250px;">
            <div class="sidebar-box" style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); position: sticky; top: 100px;">
                <h3 style="margin-top: 0; margin-bottom: 20px;">Ứng tuyển ngay</h3>
                <p style="color: #666; margin-bottom: 20px; font-size: 14px;">Bạn đã sẵn sàng cho thử thách mới? Hãy gửi CV cho chúng tôi.</p>
                
                <?php if ($deadline): ?>
                    <div style="margin-bottom: 20px; font-size: 14px;">
                        <strong>Hạn nộp:</strong> <?php echo date_i18n('d/m/Y', strtotime($deadline)); ?>
                    </div>
                <?php endif; ?>

                <a href="mailto:<?php echo $apply_email ? esc_attr($apply_email) : 'hr@fatties.vn'; ?>?subject=Ứng tuyển: <?php echo rawurlencode(get_the_title()); ?>" class="btn-aply-now" style="display: block; width: 100%; text-align: center; background: #F10992; color: white; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; transition: background 0.3s;">
                    Gửi CV Ngay
                </a>
            </div>
        </div>
    </div>

  </div>
</div>

<style>
    .highlight-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: #444;
    }
    .content-box h2 {
        font-size: 1.5rem;
        margin-top: 30px;
        margin-bottom: 15px;
        color: #222;
    }
    .content-box ul {
        padding-left: 20px;
        margin-bottom: 20px;
    }
    .content-box li {
        margin-bottom: 10px;
        color: #555;
    }
    .content-box p {
        line-height: 1.6;
        color: #555;
        margin-bottom: 20px;
    }
    .btn-aply-now:hover {
        background: #d0087e;
    }
</style>

<?php
endwhile;
get_footer();
?>
