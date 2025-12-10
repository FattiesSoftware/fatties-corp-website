<?php

/**
 * The template for displaying all single service posts
 *
 * @package Fatties_Corporation
 */
get_header();
?>

<div class="site-content" style="background-color: #f5f5f5; padding-bottom: 80px;">
  
  <!-- Service Hero -->
  <div class="service-hero" style="background: linear-gradient(135deg, #f10992 0%, #212121 100%); color: white; padding: 80px 0 100px; text-align: center; position: relative; overflow: hidden;">
    <!-- Abstract background shapes or overlay could go here -->
    <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 0 25px; position: relative; z-index: 2;">
       <?php
$icon = get_post_meta(get_the_ID(), '_service_icon', true);
if (!$icon)
  $icon = 'layers-outline';
?>
       <div class="service-icon" data-aos="zoom-in" style="font-size: 60px; margin-bottom: 20px;">
          <ion-icon name="<?php echo esc_attr($icon); ?>"></ion-icon>
       </div>
       <h1 class="service-title main-title" data-aos="fade-up" style="color: white; margin-bottom: 20px; font-weight: 700;"><?php the_title(); ?></h1>
       <div class="service-excerpt" data-aos="fade-up" data-aos-delay="100" style="font-size: 18px; font-weight: 300; max-width: 700px; margin: 0 auto; line-height: 1.6;">
          <?php echo get_the_excerpt(); ?>
       </div>
    </div>
  </div>

  <div class="container" style="max-width: 1200px; margin: -60px auto 0; padding: 0 25px; display: flex; flex-wrap: wrap; gap: 40px; position: relative; z-index: 10;">
    
    <!-- Main Content -->
    <main class="service-main" style="flex: 2; min-width: 300px; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);" data-aos="fade-up" data-aos-delay="200">
       <?php if (have_posts()):
  while (have_posts()):
    the_post(); ?>
          <?php if (has_post_thumbnail()): ?>
             <div class="service-thumbnail" style="margin-bottom: 30px; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <?php the_post_thumbnail('full', array('style' => 'width: 100%; height: auto; display: block;')); ?>
             </div>
          <?php endif; ?>
          
          <div class="entry-content" style="line-height: 1.8; color: #444; font-size: 16px;">
             <?php the_content(); ?>
          </div>
       <?php endwhile;
endif; ?>
    </main>

    <!-- Sidebar -->
    <aside class="service-sidebar" style="flex: 1; min-width: 300px;" data-aos="fade-left" data-aos-delay="300">
       <div style="position: sticky; top: 100px;">
          
          <div class="sidebar-widget" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 30px;">
             <h3 class="widget-title" style="margin-top: 0; margin-bottom: 20px; border-left: 4px solid #f10992; padding-left: 15px; font-size: 18px;">Dịch vụ khác</h3>
             <ul style="list-style: none; padding: 0; margin: 0;">
                <?php
                $other_services = new WP_Query(array(
                  'post_type' => 'service',
                  'posts_per_page' => 5,
                  'post__not_in' => array(get_the_ID())
                ));
                if ($other_services->have_posts()):
                  while ($other_services->have_posts()):
                    $other_services->the_post();
                    ?>
                   <li style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                      <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: #333; font-weight: 500; display: flex; align-items: center; justify-content: space-between; transition: color 0.2s;">
                         <span><?php the_title(); ?></span>
                         <ion-icon name="arrow-forward-outline" style="color: #f10992; font-size: 18px;"></ion-icon>
                      </a>
                   </li>
                <?php endwhile;
                  wp_reset_postdata();
                endif; ?>
             </ul>
          </div>

          <div class="sidebar-widget cta-widget" style="background: #f10992; padding: 30px; border-radius: 10px; box-shadow: 0 10px 30px rgba(241, 9, 146, 0.3); color: white; text-align: center;">
             <ion-icon name="chatbubbles-outline" style="font-size: 40px; margin-bottom: 15px;"></ion-icon>
             <h3 style="color: white; margin: 0 0 15px; font-size: 22px;">Cần tư vấn?</h3>
             <p style="margin-bottom: 25px; opacity: 0.9; font-size: 15px;">Liên hệ ngay với chúng tôi để được tư vấn miễn phí về dịch vụ này.</p>
             <a href="<?php echo home_url('/contact'); ?>" style="display: inline-block; background: white; color: #f10992; padding: 12px 30px; border-radius: 30px; text-decoration: none; font-weight: bold; transition: all 0.2s; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Liên hệ ngay</a>
          </div>

       </div>
    </aside>

  </div>
</div>

<style>
 .entry-content h2 { font-size: 24px; margin-top: 30px; margin-bottom: 15px; color: #212121; font-weight: 700; }
 .entry-content h3 { font-size: 20px; margin-top: 25px; margin-bottom: 15px; color: #333; font-weight: 600; }
 .entry-content ul { padding-left: 20px; margin-bottom: 20px; }
 .entry-content li { margin-bottom: 10px; }
 .entry-content p { margin-bottom: 20px; }
 .sidebar-widget a:hover { color: #f10992 !important; }
 .cta-widget a:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important; }
 
 @media (max-width: 768px) {
    .service-hero { padding: 60px 0 80px; }
    .container { padding: 0 15px; margin-top: -40px; }
    .service-main { padding: 25px; }
    .service-sidebar { order: 2; }
 }
</style>

<?php get_footer(); ?>
