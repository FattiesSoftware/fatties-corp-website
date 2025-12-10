<?php
/**
 * Single Project Template
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */

get_header(); ?>

<div class="single-project-container section-container">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="p25 mg-center" style="max-width: 1100px;">
                <header class="entry-header">
                    <h1 class="main-title" data-aos="fade-up"><?php the_title(); ?></h1>
                    
                    <?php 
                    $project_type = get_post_meta(get_the_ID(), '_project_type', true);
                    if ($project_type) : ?>
                        <div class="project-category a-center" style="font-size: 18px; margin-bottom: 30px;" data-aos="fade-up">
                            <?php echo esc_html($project_type); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="project-featured-image mg-v60" data-aos="fade-up">
                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: 10px;')); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content secondary-text" style="font-size: 16px; line-height: 1.8;" data-aos="fade-up">
                    <?php the_content(); ?>
                </div>

                <?php 
                $project_url = get_post_meta(get_the_ID(), '_project_url', true);
                if ($project_url) : ?>
                    <div class="project-link mg-v60 a-center" data-aos="fade-up">
                        <a href="<?php echo esc_url($project_url); ?>" target="_blank" class="button" style="display: inline-block; padding: 15px 30px; font-size: 16px;">
                            Xem dự án <ion-icon name="arrow-forward-outline" style="vertical-align: middle;"></ion-icon>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="back-to-projects a-center mg-v60" data-aos="fade-up">
                    <a href="<?php echo home_url('/#section-projects'); ?>" class="link">
                        <ion-icon name="arrow-back-outline" style="vertical-align: middle;"></ion-icon> Quay lại trang chủ
                    </a>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
