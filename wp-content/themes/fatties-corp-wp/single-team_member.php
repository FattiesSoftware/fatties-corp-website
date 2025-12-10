<?php
/**
 * Single Team Member Template
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */

get_header(); ?>

<div class="single-team-member-container section-container">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="p25 mg-center" style="max-width: 900px;">
                <header class="entry-header a-center">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="team-member-photo mg-v60" data-aos="fade-up">
                            <?php the_post_thumbnail('medium', array('class' => 'employee-photo', 'style' => 'margin: 0 auto;')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1 class="main-title purple" data-aos="fade-up"><?php the_title(); ?></h1>
                    
                    <?php 
                    $position = get_post_meta(get_the_ID(), '_team_member_position', true);
                    if ($position) : ?>
                        <div class="secondary-text" style="font-size: 18px; margin-bottom: 30px;" data-aos="fade-up">
                            <?php echo esc_html($position); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="social-links dp-flex j-center mg-b50" data-aos="fade-up">
                        <?php 
                        $facebook = get_post_meta(get_the_ID(), '_team_member_facebook', true);
                        $twitter = get_post_meta(get_the_ID(), '_team_member_twitter', true);
                        $instagram = get_post_meta(get_the_ID(), '_team_member_instagram', true);
                        $email = get_post_meta(get_the_ID(), '_team_member_email', true);
                        
                        if ($facebook) : ?>
                            <a href="<?php echo esc_url($facebook); ?>" target="_blank" class="link">
                                <div class="social-button center-both white mg-h5">
                                    <ion-icon name="logo-facebook"></ion-icon>
                                </div>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($twitter) : ?>
                            <a href="<?php echo esc_url($twitter); ?>" target="_blank" class="link">
                                <div class="social-button center-both white mg-h5">
                                    <ion-icon name="logo-twitter"></ion-icon>
                                </div>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($instagram) : ?>
                            <a href="<?php echo esc_url($instagram); ?>" target="_blank" class="link">
                                <div class="social-button center-both white mg-h5">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </div>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($email) : ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="link">
                                <div class="social-button center-both white mg-h5">
                                    <ion-icon name="mail"></ion-icon>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </header>

                <div class="entry-content secondary-text" style="font-size: 16px; line-height: 1.8;" data-aos="fade-up">
                    <?php the_content(); ?>
                </div>

                <div class="back-to-team a-center mg-v60" data-aos="fade-up">
                    <a href="<?php echo home_url('/#section-team'); ?>" class="link">
                        <ion-icon name="arrow-back-outline" style="vertical-align: middle;"></ion-icon> Quay lại trang chủ
                    </a>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
