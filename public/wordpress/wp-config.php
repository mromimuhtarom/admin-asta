<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'asta_db' );

/** MySQL database username */
define( 'DB_USER', 'ipuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'aa123123' );

/** MySQL hostname */
define( 'DB_HOST', '103.52.147.18' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'v[Zh-_XY f@)Ki_v3]?c8GT0{6z>8b#,;qY|;g]&/G*6hc^XlEuWs9B(_X1PI^2^' );
define( 'SECURE_AUTH_KEY',  '~mNGJM;8 #b@h*HZe(MuTJB@I/g@6Q:+%N<;&fM)#P`ImJ|]>}_,&xrVG+i7V$jl' );
define( 'LOGGED_IN_KEY',    '0-qXgh5bE]Tj;BXW$n|=wGN$PD3j-!Ua!<*xea1X_hlAb*C*h|D^Z10c_o}h/g.Y' );
define( 'NONCE_KEY',        '/y;;yJi;rR.pUm5h{K1fc.W 4I(<><PR>2LGKZ=$VnY>>L~2=GC7*}|Gyy,=-:Qu' );
define( 'AUTH_SALT',        'G>-UBHKg*N,Dit09bt956w2 1d|C/S;k$Z#N.@swXot8fycckR]p*3fG7t3}n,FC' );
define( 'SECURE_AUTH_SALT', 'pd,!l,HG5szf,ZF8DX+]I2>miz0VW(c}M!z:.]%~}_aMHMR{Wa|mO1IABET^X$)_' );
define( 'LOGGED_IN_SALT',   's6,4%J&5PI5xsRR4{g@W^sr>-akY.iRmUCUx3*;4DR1k{9z8STH>YXgpxHZj=Y](' );
define( 'NONCE_SALT',       'X}Yt0mnWAVDJy#T)%b*r[}EVO$gtf|RgD{#gsd2nZl<|yFqnZ-{n,v+`>#+>.~Vr' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
