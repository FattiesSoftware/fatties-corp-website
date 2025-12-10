<!-- Contact CTA -->
  <section class="contact-cta" id="contact-cta" data-aos="fade-up">
    <div class="blog-container contact-cta-inner">
      <div class="cta-copy" data-aos="fade-right" data-aos-delay="100">
        <p class="eyebrow">Luôn cập nhật xu hướng</p>
        <h2>Muốn cập nhật các <span class="highlight">xu hướng ngành</span> cho dự án của bạn?</h2>
        <p>Chúng tôi luôn sẵn sàng hỗ trợ. Hãy liên hệ ngay.</p>
        <?php if (!empty($cta_feedback['message'])): ?>
          <div class="cta-alert <?php echo $cta_feedback['status'] === 'success' ? 'success' : 'error'; ?>">
            <?php echo esc_html($cta_feedback['message']); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="cta-form-wrapper" data-aos="fade-left" data-aos-delay="200">
        <?php
        $wpforms_form_id = get_theme_mod('contact_form_id', '');
        if (function_exists('wpforms') && !empty($wpforms_form_id)):
          ?>
          <div class="cta-wpforms">
            <?php echo do_shortcode('[wpforms id="' . intval($wpforms_form_id) . '"]'); ?>
          </div>
        <?php elseif (function_exists('wpforms')): ?>
          <div class="wpforms-notice">
            <p class="secondary-text a-center" style="margin-bottom: 10px;">
              Hãy nhập WPForms Form ID trong Appearance > Customize > Contact Page.
            </p>
          </div>
        <?php else: ?>
          <div class="wpforms-notice">
            <p class="secondary-text a-center">
              Vui lòng cài và kích hoạt WPForms (hoặc WPForms Lite) để hiển thị form.
            </p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php wp_footer(); ?>
<?php elementor_theme_do_location('footer'); ?>
</body>

</html>