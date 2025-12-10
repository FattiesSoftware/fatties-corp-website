<?php
use Elementor\Controls_Manager;

// Check if the class already exists to avoid conflicts
if (!class_exists('AI_Controllers')) {
    class AI_Controllers {
        private static $ai_controller_instance = null;

        // Singleton pattern to ensure only one instance
        public static function ai_controller_instance() {
            if (self::$ai_controller_instance === null) {
                self::$ai_controller_instance = new self();
            }
            return self::$ai_controller_instance;
        }

        // Constructor to hook actions
        public function __construct() {
            add_action('elementor/element/text-editor/section_editor/after_section_start', [$this, 'register_ai_controller'], 10, 2);
            add_action('elementor/preview/enqueue_scripts', [$this, 'preview_editor_scripts']);
            add_action('elementor/preview/enqueue_styles', [$this, 'preview_editor_styles']);
        }

        // Enqueue scripts for the Elementor editor
        public function preview_editor_scripts() {
            if (defined('AACGFE_URL') && defined('AACGFE_VERSION')) {
                wp_enqueue_script('ai-editor-scripts', AACGFE_URL . 'assets/js/aacgfe-content-generator.js', ['jquery', 'wp-i18n'], AACGFE_VERSION, true);
                wp_enqueue_script('ai-sweetalert-editor-script', AACGFE_URL . 'assets/js/sweetalert2/sweetalert2.all.min.js', [], AACGFE_VERSION, false);
            }
        }

        // Enqueue styles for the Elementor editor
        public function preview_editor_styles() {
            if (defined('AACGFE_URL') && defined('AACGFE_VERSION')) {
                wp_enqueue_style('ai-popup-editor-css', AACGFE_URL . 'assets/css/aacgfe-modal.css', [], AACGFE_VERSION, 'all');
                wp_enqueue_style('ai-sweetalert-editor-css', AACGFE_URL . 'assets/js/sweetalert2/sweetalert2.min.css', [], AACGFE_VERSION, 'all');
            }
        }

        // Register AI control button for Elementor
        public static function register_ai_controller($element) {
            
            $element->add_control(
                'generate',
                [
                    'type' => Controls_Manager::BUTTON,
                    'label' => '',
                    'separator' => 'before',
                    'show_label' => false,
                    'text' => sprintf(
                        '%s <i class="eicon-ai chrome-ai-custom-icon" aria-hidden="true"></i>',
                        esc_html__('Generate With AI', 'aacgfe')
                    ),
                    'button_type' => 'default',
                    'event' => 'ai:content:generate'
                ]
            ); 
        }
    }
}

// Initialize the AI_Controllers class
AI_Controllers::ai_controller_instance();
