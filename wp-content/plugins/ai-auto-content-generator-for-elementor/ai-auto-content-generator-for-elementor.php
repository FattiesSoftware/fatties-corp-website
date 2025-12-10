<?php
/*
 * Plugin Name: AI Content Generator For Elementor   
 * Description: Improve the quality of your Elementor website pages content with Chrome's built-in AI
 * Plugin URI:  https://coolplugins.net
 * Version:     1.2.3
 * Author:      Cool Plugins
 * Author URI:  https://coolplugins.net
 * Text Domain: aacgfe
 * Elementor tested up to:  3.32.2
 * Elementor Pro tested up to: 3.32.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define constants
if ( ! defined( 'AACGFE_VERSION' ) ) {
    define( 'AACGFE_VERSION', '1.2.3' );
    define( 'AACGFE_FILE', __FILE__ );
    define( 'AACGFE_PATH', plugin_dir_path( AACGFE_FILE ) );
    define( 'AACGFE_URL', plugin_dir_url( AACGFE_FILE ) );
}

// Activation and Deactivation Hooks
register_activation_hook( AACGFE_FILE, array( 'AACGFE_Widget_Addon', 'activate' ) );
register_deactivation_hook( AACGFE_FILE, array( 'AACGFE_Widget_Addon', 'deactivate' ) );

// Prevent class redefinition if the plugin is already loaded.
if ( ! class_exists( 'AACGFE_Widget_Addon' ) ) {

    final class AACGFE_Widget_Addon {

        private static $instance = null;

        // Singleton pattern
        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        private function __construct() {
            add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
        }

        // Load the plugin after all plugins have been loaded
        public function plugins_loaded() {
            load_plugin_textdomain( 'aacgfe', false, basename( dirname( __FILE__ ) ) . '/languages/' );


            if (!get_option( 'aacgfe_initial_save_version' ) ) {
                add_option( 'aacgfe_initial_save_version', AACGFE_VERSION );
            }
            if(!get_option( 'aacgfe-install-date' ) ) {
                add_option( 'aacgfe-install-date', gmdate('Y-m-d h:i:s') );
            }

            // Notice if Elementor is not active
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', array( $this, 'fail_to_load' ) );
                return;
            }

            // Admin-related functionalities
            if ( is_admin() ) {
                require_once AACGFE_PATH . 'admin/class-admin-notice.php';
                require_once AACGFE_PATH . 'admin/feedback/admin-feedback-form.php';
                add_action( 'admin_init', array( $this, 'show_upgrade_notice' ) );
            }

            // Include custom controls and functionalities
            require_once AACGFE_PATH . 'controls/ai_controller.php';
        }

        // Display the upgrade notice
        public function show_upgrade_notice() {
            aacgfe_create_admin_notice(
                array(
                    'id'              => 'aacgfe-review-box',
                    'slug'            => 'aacgfe',
                    'review'          => true,
                    'review_url'      => esc_url( 'https://wordpress.org/support/plugin/ai-auto-content-generator-for-elementor/reviews/?filter=5#new-post' ),
                    'plugin_name'     => 'AI Auto Content Generator For Elementor',
                    'review_interval' => 3,
                )
            );
        }

        // Elementor is not loaded
        public function fail_to_load() {
            if ( ! is_plugin_active( 'elementor/elementor.php' ) ) : ?>
                <div class="notice notice-warning is-dismissible">
                    <p><?php echo '<a href="https://wordpress.org/plugins/elementor/" target="_blank">' . esc_html__( 'Elementor Page Builder', 'aacgfe' ) . '</a>' . wp_kses_post( __( ' must be installed and activated to use "<strong>AI Auto Content Generator For Elementor</strong>" ', 'aacgfe' ) ); ?></p>
                </div>
            <?php endif;
        }

        // Plugin activation: Set initial options
        public static function activate() {
            update_option( 'aacgfe-installDate', gmdate( 'Y-m-d h:i:s' ) );
            update_option( 'aacgfe-version', AACGFE_VERSION );
            update_option( 'aacgfe-plugin-type', 'free' );
            update_option( 'aacgfe-ratingDiv', 'no' );
            update_option( 'aacgfe_plugin_redirect', true );
        }

        // Plugin deactivation: Clean up options
        public static function deactivate() {
            delete_option( 'AACGFE_prompt_data' );
        }

        public static function aacgfe_get_user_info() {
        global $wpdb;
        // Server and WP environment details
        $server_info = [
            'server_software'        => isset($_SERVER['SERVER_SOFTWARE']) ? sanitize_text_field($_SERVER['SERVER_SOFTWARE']) : 'N/A',
            'mysql_version'          => $wpdb ? sanitize_text_field($wpdb->get_var("SELECT VERSION()")) : 'N/A',
            'php_version'            => sanitize_text_field(phpversion() ?: 'N/A'),
            'wp_version'             => sanitize_text_field(get_bloginfo('version') ?: 'N/A'),
            'wp_debug'               => (defined('WP_DEBUG') && WP_DEBUG) ? 'Enabled' : 'Disabled',
            'wp_memory_limit'        => sanitize_text_field(ini_get('memory_limit') ?: 'N/A'),
            'wp_max_upload_size'     => sanitize_text_field(ini_get('upload_max_filesize') ?: 'N/A'),
            'wp_permalink_structure' => sanitize_text_field(get_option('permalink_structure') ?: 'Default'),
            'wp_multisite'           => is_multisite() ? 'Enabled' : 'Disabled',
            'wp_language'            => sanitize_text_field(get_option('WPLANG') ?: get_locale()),
            'wp_prefix'              => isset($wpdb->prefix) ? sanitize_key($wpdb->prefix) : 'N/A',
        ];
        // Theme details
        $theme = wp_get_theme();
        $theme_data = [
            'name'      => sanitize_text_field($theme->get('Name')),
            'version'   => sanitize_text_field($theme->get('Version')),
            'theme_uri' => esc_url($theme->get('ThemeURI')),
        ];
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        $plugin_data = [];
        $active_plugins = get_option('active_plugins', []);
        foreach ($active_plugins as $plugin_path) {
            $plugin_file = WP_PLUGIN_DIR . '/' . ltrim($plugin_path, '/');
            if (file_exists($plugin_file)) {
                $plugin_info = get_plugin_data($plugin_file, false, false);
                $plugin_url = !empty($plugin_info['PluginURI']) ? esc_url($plugin_info['PluginURI']) : (!empty($plugin_info['AuthorURI']) ? esc_url($plugin_info['AuthorURI']) : 'N/A');
                $plugin_data[] = [
                    'name'       => sanitize_text_field($plugin_info['Name']),
                    'version'    => sanitize_text_field($plugin_info['Version']),
                    'plugin_uri' => !empty($plugin_url) ? $plugin_url : 'N/A',
                ];
            }
        }
        return [
            'server_info'   => $server_info,
            'extra_details' => [
                'wp_theme'       => $theme_data,
                'active_plugins' => $plugin_data,
            ],
        ];
    }

    }
}

// Get instance of the plugin class
function AACGFE_Widget_Addon() {
    return AACGFE_Widget_Addon::get_instance();
}

// Initialize the plugin
AACGFE_Widget_Addon();

