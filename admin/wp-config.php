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
define( 'DB_NAME', 'wolfheze' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ' Fs-1>kByf8%2CCq3ymY9-;36%15EYvLg ,9#}f1W?fV|pctst34_GZs8uQdE:Zo' );
define( 'SECURE_AUTH_KEY',  '#ABjv^M*p%T~x_9g /:cjF3l=zbHAwWmKArLvlx!+E`l4NZ^+Bv A!cqWB@]Q?53' );
define( 'LOGGED_IN_KEY',    '#@Z}3K6%ZO>Nh)x8.dKtvEamIS,}7b/GZ;F|&-,ZU*$D>TC4^est}73b3lwd%nSU' );
define( 'NONCE_KEY',        '|oZPTlHYu6gLOt4(<5m[Zz sJB9PAt|CMWl=3h09pk|*38Mki`@~+0+UTl]W@ dy' );
define( 'AUTH_SALT',        'r-{nXX8^X)@kd-1##|oh{RzQv;.2cXix^A XRhtOqZe(gV^rv)}6`$`MJU%1oC7i' );
define( 'SECURE_AUTH_SALT', 'cx/@`$}L5QKE:K5bt[Hh+4k!75bG!D(M67W<`r:t|CI:f7p|uEM}~1ZSY33me_a0' );
define( 'LOGGED_IN_SALT',   'f26)W?X8Foe.lOCbPRT!3xi_u@]!QE%OK8}MylW,EQw%Q|z:^265k1AItm#(%1HB' );
define( 'NONCE_SALT',       'sK/+.e-;bngYgx!d( d*/U57=zFGJAk[Ru<~,u9ATt}w@K_x`W[|m56J:o]XS+,X' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
