<?php

/**
 * Contact Page Template
 *
 * @package Fatties_Corporation
 * @since 1.0.0
 */
get_header();
?>

<!-- Contact Section -->
<div id="section-contact" class="section-container">
  <div class="p25">
    <!-- Contact Form Section -->
    <div class="contact-form-section" style="margin-top: 0px;">
      <div class="mg-center w750">
        <div class="main-title" data-aos="fade-up">Gửi tin nhắn cho chúng tôi</div>
        <div class="secondary-text a-center mg-b50" data-aos="fade-up">
          Điền thông tin bên dưới và chúng tôi sẽ liên hệ lại với bạn sớm nhất có thể.
        </div>

        <?php
        // Get WPForms form ID from theme options
        // Set this in WordPress Customizer > Contact Page > WPForms Form ID
        $wpforms_form_id = get_theme_mod('contact_form_id', '');
        ?>

        <?php if (function_exists('wpforms') && !empty($wpforms_form_id)): ?>
          <div class="wpforms-container" data-aos="fade-up" data-aos-delay="100">
            <?php echo do_shortcode('[wpforms id="' . intval($wpforms_form_id) . '"]'); ?>
          </div>
        <?php elseif (function_exists('wpforms')): ?>
          <div class="wpforms-notice" data-aos="fade-up">
            <p class="secondary-text a-center" style="margin-bottom: 10px;">
              <strong>Hướng dẫn sử dụng WPForms:</strong>
            </p>
            <ol class="secondary-text" style="text-align: left; max-width: 600px; margin: 0 auto; padding-left: 20px;">
              <li>Tạo form liên hệ trong <strong>WPForms > Add New</strong></li>
              <li>Vào <strong>Appearance > Customize > Contact Page</strong></li>
              <li>Nhập <strong>WPForms Form ID</strong> (bạn có thể tìm ID này trong danh sách forms)</li>
              <li>Lưu và xem lại trang liên hệ</li>
            </ol>
            <p class="secondary-text a-center" style="margin-top: 15px;">
              Hoặc bạn có thể sử dụng shortcode trực tiếp: <code>[wpforms id="FORM_ID"]</code>
            </p>
          </div>
        <?php else: ?>
          <div class="wpforms-notice" data-aos="fade-up">
            <p class="secondary-text a-center">
              Plugin WPForms chưa được kích hoạt. Vui lòng cài đặt và kích hoạt <strong>WPForms Lite</strong>.
            </p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="main-title mg-top80" data-aos="fade-up">Hãy cùng kết nối</div>
    <div class="secondary-text w750 a-center mg-center mg-b50" data-aos="fade-up">
      Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn. Hãy liên hệ với chúng tôi qua các thông tin dưới đây.
    </div>

    <div class="mg-center w1100 d-row f-wrap j-center mg-top60 contact-cards-container">
      <!-- Address Card -->
      <div class="contact-card" data-aos="fade-up" data-aos-delay="0">
        <div class="contact-icon">
          <ion-icon name="location-outline"></ion-icon>
        </div>
        <div class="contact-title">Địa chỉ</div>
        <div class="contact-content secondary-text">
          TDP Thụy Sơn 1, Phường Nguyễn Úy, Tỉnh Ninh Bình
        </div>
      </div>

      <!-- Email Card -->
      <div class="contact-card" data-aos="fade-up" data-aos-delay="100">
        <div class="contact-icon">
          <ion-icon name="mail-outline"></ion-icon>
        </div>
        <div class="contact-title">Email</div>
        <div class="contact-content secondary-text">
          <a href="mailto:hello@fatties.vn" class="contact-link">hello@fatties.vn</a>
        </div>
      </div>

      <!-- Phone Card -->
      <div class="contact-card" data-aos="fade-up" data-aos-delay="200">
        <div class="contact-icon">
          <ion-icon name="call-outline"></ion-icon>
        </div>
        <div class="contact-title">Số điện thoại</div>
        <div class="contact-content secondary-text">
          <a href="tel:0365520031" class="contact-link">0365 520 031</a>
        </div>
      </div>

      <!-- Working Hours Card -->
      <div class="contact-card" data-aos="fade-up" data-aos-delay="300">
        <div class="contact-icon">
          <ion-icon name="time-outline"></ion-icon>
        </div>
        <div class="contact-title">Giờ làm việc</div>
        <div class="contact-content secondary-text">
          Thứ 2 - Thứ 6<br>
          9:00AM - 5:00PM
        </div>
      </div>
    </div>


  </div>
</div>

<style>
  .contact-card {
    background: white;
    border-radius: 10px;
    padding: 40px 30px;
    margin: 0 15px 30px 15px;
    flex: 0 1 calc(25% - 30px);
    min-width: 220px;
    max-width: calc(25% - 30px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    text-align: center;
    box-sizing: border-box;
  }

  .contact-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(241, 9, 146, 0.2);
  }

  .contact-icon {
    font-size: 60px;
    color: #f10992;
    margin-bottom: 20px;
  }

  .contact-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .contact-content {
    font-size: 15px;
    line-height: 1.8;
    color: #666;
  }

  .contact-link {
    color: #f10992;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .contact-link:hover {
    color: #d1087a;
    text-decoration: underline;
  }

  #section-contact {
    padding: 80px 0;
    background-color: #f9f9f9;
    min-height: calc(100vh - 200px);
  }

  .contact-cards-container {
    gap: 0;
    margin: 0 auto;
    justify-content: space-between;
  }

  @media (min-width: 1201px) {
    .contact-card {
      flex: 0 1 calc(25% - 30px);
      max-width: calc(25% - 30px);
    }
  }

  /* Contact Form Styles */
  .contact-form-section {
    margin-top: 80px;
    padding: 60px 25px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    width: 1100px;
    margin: 0 auto;
  }

  .contact-form {
    margin-top: 40px;
  }

  .form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
  }

  .form-group {
    margin-bottom: 25px;
    flex: 1;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
    font-size: 15px;
  }

  .form-group .required {
    color: #f10992;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    font-family: "Quicksand", sans-serif;
    transition: all 0.3s ease;
    box-sizing: border-box;
  }

  .form-group input:focus,
  .form-group textarea:focus {
    outline: none;
    border-color: #f10992;
    box-shadow: 0 0 0 3px rgba(241, 9, 146, 0.1);
  }

  .form-group textarea {
    resize: vertical;
    min-height: 120px;
  }

  .form-submit {
    text-align: center;
    margin-top: 30px;
  }

  .contact-submit-btn {
    background: linear-gradient(135deg, #f10992 0%, #d1087a 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(241, 9, 146, 0.3);
  }

  .contact-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(241, 9, 146, 0.4);
  }

  .contact-submit-btn:active {
    transform: translateY(0);
  }

  .contact-submit-btn ion-icon {
    font-size: 20px;
  }

  .contact-form-message {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    font-size: 15px;
    line-height: 1.6;
  }

  .contact-form-message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .contact-form-message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  /* WPForms Styling - High specificity to override default styles */
  .wpforms-container {
    margin-top: 40px;
  }

  /* Reset and style all input fields */
  .wpforms-container .wpforms-form input[type="text"],
  .wpforms-container .wpforms-form input[type="email"],
  .wpforms-container .wpforms-form input[type="tel"],
  .wpforms-container .wpforms-form input[type="url"],
  .wpforms-container .wpforms-form input[type="number"],
  .wpforms-container .wpforms-form input[type="date"],
  .wpforms-container .wpforms-form textarea,
  .wpforms-container .wpforms-form select {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 2px solid #e0e0e0 !important;
    border-radius: 8px !important;
    font-size: 15px !important;
    font-family: "Quicksand", sans-serif !important;
    transition: all 0.3s ease !important;
    box-sizing: border-box !important;
    background-color: #fff !important;
    color: #333 !important;
    margin-bottom: 0 !important;
  }

  /* Remove default browser validation styles */
  .wpforms-container .wpforms-form input:invalid,
  .wpforms-container .wpforms-form textarea:invalid {
    box-shadow: none !important;
  }

  /* Focus states */
  .wpforms-container .wpforms-form input:focus,
  .wpforms-container .wpforms-form textarea:focus,
  .wpforms-container .wpforms-form select:focus {
    outline: none !important;
    border-color: #f10992 !important;
    box-shadow: 0 0 0 3px rgba(241, 9, 146, 0.1) !important;
  }

  /* Textarea specific */
  .wpforms-container .wpforms-form textarea {
    resize: vertical !important;
    min-height: 120px !important;
  }

  /* Labels */
  .wpforms-container .wpforms-form .wpforms-field-label,
  .wpforms-container .wpforms-form label {
    display: block !important;
    margin-bottom: 8px !important;
    font-weight: 600 !important;
    color: #333 !important;
    font-size: 15px !important;
    font-family: "Quicksand", sans-serif !important;
  }

  .wpforms-container .wpforms-form .wpforms-field-label .wpforms-required-label,
  .wpforms-container .wpforms-form label .wpforms-required-label {
    color: #f10992 !important;
  }

  /* Field rows (for side-by-side fields) */
  .wpforms-container .wpforms-form .wpforms-field-row {
    display: flex !important;
    margin-bottom: 25px !important;
  }

  .wpforms-container .wpforms-form .wpforms-field-row .wpforms-field {
    flex: 1 !important;
    margin-bottom: 0 !important;
  }

  /* Submit button */
  .wpforms-container .wpforms-form .wpforms-submit-container {
    text-align: center !important;
    margin-top: 30px !important;
  }

  .wpforms-container .wpforms-form button[type="submit"],
  .wpforms-container .wpforms-form input[type="submit"],
  .wpforms-container .wpforms-form .wpforms-submit {
    background: linear-gradient(135deg, #f10992 0%, #d1087a 100%) !important;
    color: white !important;
    border: none !important;
    padding: 15px 40px !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    border-radius: 50px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    box-shadow: 0 4px 15px rgba(241, 9, 146, 0.3) !important;
    font-family: "Quicksand", sans-serif !important;
    width: auto !important;
  }

  .wpforms-container .wpforms-form button[type="submit"]:hover,
  .wpforms-container .wpforms-form input[type="submit"]:hover,
  .wpforms-container .wpforms-form .wpforms-submit:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(241, 9, 146, 0.4) !important;
  }

  .wpforms-container .wpforms-form button[type="submit"]:active,
  .wpforms-container .wpforms-form input[type="submit"]:active,
  .wpforms-container .wpforms-form .wpforms-submit:active {
    transform: translateY(0) !important;
  }

  /* Error messages */
  .wpforms-container .wpforms-form .wpforms-error,
  .wpforms-container .wpforms-form .wpforms-field-error {
    color: #721c24 !important;
    font-size: 13px !important;
    margin-top: 5px !important;
    display: block !important;
  }

  .wpforms-container .wpforms-form .wpforms-field-error input,
  .wpforms-container .wpforms-form .wpforms-field-error textarea,
  .wpforms-container .wpforms-form .wpforms-field-error select {
    border-color: #dc3545 !important;
  }

  /* Hide default WPForms error icons if needed */
  .wpforms-container .wpforms-form .wpforms-error-icon {
    display: none !important;
  }

  /* Confirmation messages */
  .wpforms-container .wpforms-form .wpforms-confirmation-container {
    padding: 15px 20px !important;
    border-radius: 8px !important;
    margin-bottom: 25px !important;
    font-size: 15px !important;
    line-height: 1.6 !important;
    background-color: #d4edda !important;
    color: #155724 !important;
    border: 1px solid #c3e6cb !important;
  }

  .wpforms-container .wpforms-form .wpforms-error-container {
    padding: 15px 20px !important;
    border-radius: 8px !important;
    margin-bottom: 25px !important;
    font-size: 15px !important;
    line-height: 1.6 !important;
    background-color: #f8d7da !important;
    color: #721c24 !important;
    border: 1px solid #f5c6cb !important;
  }

  /* Remove default WPForms styling */
  .wpforms-container .wpforms-form {
    max-width: 100% !important;
  }

  /* Nested fields (like First/Last name) */
  .wpforms-container .wpforms-form .wpforms-field-name .wpforms-field-row input,
  .wpforms-container .wpforms-form .wpforms-field-name-first input,
  .wpforms-container .wpforms-form .wpforms-field-name-last input,
  .wpforms-container .wpforms-form .wpforms-field-name-middle input {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 2px solid #e0e0e0 !important;
    border-radius: 8px !important;
    font-size: 15px !important;
    font-family: "Quicksand", sans-serif !important;
    background-color: #fff !important;
    color: #333 !important;
  }

  .wpforms-container .wpforms-form .wpforms-field-name .wpforms-field-row input:focus,
  .wpforms-container .wpforms-form .wpforms-field-name-first input:focus,
  .wpforms-container .wpforms-form .wpforms-field-name-last input:focus {
    border-color: #f10992 !important;
    box-shadow: 0 0 0 3px rgba(241, 9, 146, 0.1) !important;
  }

  /* Remove red borders from validation */
  .wpforms-container .wpforms-form input.wpforms-error,
  .wpforms-container .wpforms-form textarea.wpforms-error {
    border-color: #dc3545 !important;
  }

  /* Error text styling */
  .wpforms-container .wpforms-form .wpforms-field-error-message {
    color: #dc3545 !important;
    font-size: 13px !important;
    margin-top: 5px !important;
    display: block !important;
  }

  /* Remove default browser validation styling */
  .wpforms-container .wpforms-form input:required:invalid:not(:focus):not(:placeholder-shown),
  .wpforms-container .wpforms-form textarea:required:invalid:not(:focus):not(:placeholder-shown) {
    border-color: #e0e0e0 !important;
  }

  /* Field descriptions */
  .wpforms-container .wpforms-form .wpforms-field-description {
    font-size: 13px !important;
    color: #666 !important;
    margin-top: 5px !important;
  }

  .wpforms-notice {
    padding: 20px;
    text-align: center;
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 8px;
    margin-top: 20px;
  }

  .wpforms-notice code {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 14px;
  }

  @media (max-width: 1200px) {
    .contact-card {
      flex: 1 1 calc(50% - 30px);
      min-width: 250px;
    }
  }

  @media (max-width: 768px) {
    .contact-card {
      flex: 1 1 100%;
      min-width: 100%;
      max-width: 100%;
      margin: 15px 0;
    }

    .form-row {
      flex-direction: column;
      gap: 0;
    }

    .contact-form-section {
      padding: 40px 20px;
    }
  }

  .wpforms-container .wpforms-field-row.wpforms-field-medium {
    max-width: 100% !important;
  }
</style>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/aos.js"></script>
<script>
  // Initialize AOS
  if (typeof AOS !== 'undefined') {
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true
    });
  }
</script>

<?php get_footer(); ?>