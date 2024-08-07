<?php
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
define( 'DB_NAME', 'plugintest' );

/** Database username */
define( 'DB_USER', 'how' );

/** Database password */
define( 'DB_PASSWORD', 'how' );

/** Database hostname */
define( 'DB_HOST', '192.168.1.115' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         's&?(=km/D@63=!TCW+/3y?=L*!gwu9Y8pJwPd.v}ZnjE:n8O{1IwrH&82upLPXR0' );
define( 'SECURE_AUTH_KEY',  'UiBG$xUtBEb=VeyFtye=%:;mU9+b^m(5EB}<7=UI~r=dk32-ZYNW]m3y|aZuWIb#' );
define( 'LOGGED_IN_KEY',    'cY%(wFd&njT^A%E`8IuyGSNct}j~TAEp4n$y[!Kb!}y{3hL=6iAnx}|Y%7xdQ/@A' );
define( 'NONCE_KEY',        '!J,UjfGgmbFOjNp5GHOGa^NH?o& Sgn-&Ve^*keF}R-?MGd`wLa}Ri,=#|P2mwFA' );
define( 'AUTH_SALT',        '[#1;M;}< s _HF<**iK?:}JRgvfb)kWo-f[T8M>L*q2n1^V.xio~`SFJTTHrvFqk' );
define( 'SECURE_AUTH_SALT', 'ZBSPfUhYqf00RD]4lze$tA&QHI#I||o;vW`o%~026pE]48H{<ZB_y2(rt(_.)d [' );
define( 'LOGGED_IN_SALT',   '-URjz/A){Js1[8+~DE&& `Q}v!O%!&>[IKSU]42~;#0Ql`RL{0,nIB0euFI8Iik1' );
define( 'NONCE_SALT',       'wc5Sk~6C7Q;X;4m6-6A0y[o95d<`tQzOt?qgC<0b$FZCffl.?%1Kp<RoB=K4oyGn' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'plugintest_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
