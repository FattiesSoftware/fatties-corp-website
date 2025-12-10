<?php
define( 'WP_CACHE', true ); // Added by WP Rocket

// Buộc WordPress sử dụng HTTPS
define('WP_HOME', 'https://fatties.vn');
define('WP_SITEURL', 'https://fatties.vn');
$_SERVER['HTTPS'] = 'on'; // Dòng này cực kỳ quan trọng nếu bạn dùng Cloudflare hoặc Load Balancer SSL
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fatties');

/** Database username */
define('DB_USER', 'fatties');

/** Database password */
define('DB_PASSWORD', 'tunganh2003');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'XrKy6lL1]GtAHz_~SNqD)Bxp0$#Rb9eBe5Adst^((#m_t.}xf&%1A,Vo/@vPmU[4');
define('SECURE_AUTH_KEY', '9DTIxTyu%WQWoM:[B RynM#dYgO-iPHuQggbPGDhV,W-}>^T87m>2o`$6j_amz=q');
define('LOGGED_IN_KEY', '0R=LdkjCP4(=jfx!#{-7-nw{O1gZZUox|kQ&}r}/.AoI:,|Z9{N2tlH=2 mlXV|u');
define('NONCE_KEY', '.8zk.8_4j3,3`M`7oUTm|3ZUCn+l!$>uU]_^y=[=`|NeixVno,IcuNqUoAD)hKx<');
define('AUTH_SALT', 't]}wde>~9/kCcS0><1`x5^4#2Sdz=YL}ZmS|? nd#W~@+ w?#@^t}A87t><8yNz+');
define('SECURE_AUTH_SALT', 'HpEd2btR;GwDa_n?J>=yxDVNT,ts&8v:&[<(3oL}[dBe)_,@4Dx0s`nyu%XJ4#&{');
define('LOGGED_IN_SALT', '>M4^eCX)Ka`bVBr]i2>*)7BiVo_x4#IQF#6pa9eq_BDVZuSPwsgSe1C.?y]lY,@Q');
define('NONCE_SALT', 'i5$ttzk>~bstS|d-@ Vs.*AW^Lqzd%y8_&U#]vTpo*y+A^<@8S;0`K~rpt^XW2]1');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
/* Add any custom values between this line and the "stop editing" line. */

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false); // ẩn lỗi trên màn hình nếu muốn

// Configure error logging to write to debug.log
ini_set('error_log', __DIR__ . '/wp-content/debug.log');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
