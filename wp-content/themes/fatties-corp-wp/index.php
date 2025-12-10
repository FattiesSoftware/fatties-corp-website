<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */
get_header();
?>

<div class="site-content" style="padding: 100px 25px; min-height: 100vh;">
  <div class="container" style="max-width: 1200px; margin: 0 auto;">
    
    <?php if (have_posts()): ?>
      
      <div class="posts-wrapper">
        <?php while (have_posts()):
          the_post(); ?>
          
          <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> style="margin-bottom: 60px;">
            
            <?php if (has_post_thumbnail()): ?>
              <div class="post-thumbnail" style="margin-bottom: 20px;">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: 10px;')); ?>
                </a>
              </div>
            <?php endif; ?>
            
            <header class="entry-header">
              <h2 class="entry-title" style="font-size: 32px; margin: 20px 0;">
                <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: #212121; transition: color 200ms;">
                  <?php the_title(); ?>
                </a>
              </h2>
              
              <div class="entry-meta" style="color: #999; font-size: 14px; margin-bottom: 20px;">
                <span class="posted-on">
                  <ion-icon name="calendar-outline" style="vertical-align: middle;"></ion-icon>
                  <?php echo get_the_date(); ?>
                </span>
                <span style="margin: 0 10px;">•</span>
                <span class="author">
                  <ion-icon name="person-outline" style="vertical-align: middle;"></ion-icon>
                  <?php the_author(); ?>
                </span>
                <?php if (has_category()): ?>
                  <span style="margin: 0 10px;">•</span>
                  <span class="categories">
                    <ion-icon name="folder-outline" style="vertical-align: middle;"></ion-icon>
                    <?php the_category(', '); ?>
                  </span>
                <?php endif; ?>
              </div>
            </header>
            
            <div class="entry-content" style="line-height: 1.8; color: #666;">
              <?php the_excerpt(); ?>
            </div>
            
            <footer class="entry-footer" style="margin-top: 20px;">
              <a href="<?php the_permalink(); ?>" class="read-more" style="display: inline-block; padding: 10px 25px; background-color: #f10992; color: white; text-decoration: none; border-radius: 5px; transition: all 200ms;">
                Đọc thêm <ion-icon name="arrow-forward-outline" style="vertical-align: middle;"></ion-icon>
              </a>
            </footer>
            
          </article>
          
        <?php endwhile; ?>
      </div>
      
      <div class="pagination" style="margin-top: 40px; text-align: center;">
        <?php
        the_posts_pagination(array(
          'mid_size' => 2,
          'prev_text' => '<ion-icon name="chevron-back-outline"></ion-icon> Trước',
          'next_text' => 'Sau <ion-icon name="chevron-forward-outline"></ion-icon>',
        ));
        ?>
      </div>
      
    <?php else: ?>
      
      <div class="no-posts" style="text-align: center; padding: 60px 20px;">
        <h2 style="font-size: 28px; margin-bottom: 20px;">Không tìm thấy nội dung</h2>
        <p style="color: #666; font-size: 16px;">Xin lỗi, không có nội dung nào được tìm thấy.</p>
      </div>
      
    <?php endif; ?>
    
  </div>
</div>

<style>
  .entry-title a:hover {
    color: #f10992 !important;
  }
  
  .read-more:hover {
    background-color: #d10880 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(241, 9, 146, 0.3);
  }
  
  .pagination .page-numbers {
    display: inline-block;
    padding: 8px 15px;
    margin: 0 5px;
    background-color: #f5f5f5;
    color: #212121;
    text-decoration: none;
    border-radius: 5px;
    transition: all 200ms;
  }
  
  .pagination .page-numbers:hover,
  .pagination .page-numbers.current {
    background-color: #f10992;
    color: white;
  }
  
  .pagination ion-icon {
    vertical-align: middle;
  }
</style>

<?php get_footer(); ?>
