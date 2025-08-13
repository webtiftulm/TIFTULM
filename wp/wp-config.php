<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tiftulm_wp77' );

/** Database username */
define( 'DB_USER', 'tiftulm_wp77' );

/** Database password */
define( 'DB_PASSWORD', '-p12JS.4N7' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'h6j7nxdm426vmq9mppwexwpikyjmo6ixfza4iab1rbwo8hbouqsynh4dxl52mndl' );
define( 'SECURE_AUTH_KEY',  'czzabct13m4e21n4kefzulf3u7i3sfrhkbwe35h4nstxehtkjwdwlheqxwn21rar' );
define( 'LOGGED_IN_KEY',    'ufaf9pd3saqhqx3uslvvuyc2kbf6m0jdsuevjwtlintikprez5pshgqrnqmcqmsf' );
define( 'NONCE_KEY',        'ayjilv8gjhwcqwaxz6el43v3hqmsdiegb1huj0fefpyyl2hhjwmv54yz3doh8oru' );
define( 'AUTH_SALT',        '4g8c2xotuv0tvnkxnc3bgvbqzyizcabtfc7cd0eesfo5wcvrgevpnsntvhano4w0' );
define( 'SECURE_AUTH_SALT', 'kv8wz3ikolkhwcg7dhglyklrtfp93gnhoquhrikyvny9efhrge3xmuoyowqvy5ez' );
define( 'LOGGED_IN_SALT',   'blx5hez3gatv3tih7fm9geltprnpyizpa7a5z6ogbvcjagfcqj52yfb4uhtzsi63' );
define( 'NONCE_SALT',       'bf2btdftwy6fj3szeuxckqrr9tdjgnkqhwfi9qiw55r0bdiddefhso2gt1elpmow' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpte_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
