<?php

/**
 * 404 Error Page Template
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */
get_header();
?>

<div class="error-404-container section-container" style="margin-top: 100px">
    <div class="p25 mg-center a-center" style="max-width: 800px; min-height: 60vh; display: flex; flex-direction: column; justify-content: center;">
        <div data-aos="fade-up">
            <ion-icon name="sad-outline" style="font-size: 120px; color: #f10992;"></ion-icon>
        </div>
        
        <h1 class="main-title purple" data-aos="fade-up" style="font-size: 80px; margin: 20px 0;">404</h1>
        
        <h2 class="title" data-aos="fade-up">Trang không tồn tại</h2>
        
        <div class="secondary-text mg-v20" data-aos="fade-up" style="font-size: 18px;">
            Xin lỗi, trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.
        </div>
        
        <div class="mg-v60" data-aos="fade-up">
            <a href="<?php echo home_url('/'); ?>" class="button" style="display: inline-block; padding: 15px 40px; font-size: 16px; text-decoration: none;">
                <ion-icon name="home-outline" style="vertical-align: middle;"></ion-icon> Quay về trang chủ
            </a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
