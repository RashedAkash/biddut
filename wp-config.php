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
define( 'DB_NAME', 'biddut' );

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
define( 'AUTH_KEY',         'Q/]_*%W)tn*&sM?!G/8{RXE`z%WwA|`D}t`<?V_6;LYo[OCtEinh[eZoJjga_so5' );
define( 'SECURE_AUTH_KEY',  't/u}/MQ1KD}YNP&:kyi`coh8jIHc>]a{z=(@1Bd6zC~tQk/}~Nqi!c9VIVZ&QoYy' );
define( 'LOGGED_IN_KEY',    'A!-*a6Ivx>LdU@F>O/R:#IMPg).RjZrus}P&2rq/n7)6f.Mr<aMHgA.j:[b bZf|' );
define( 'NONCE_KEY',        'lwox}$}PFyDG39N|)/ZNKun2;8|Jbc8J*5XkUHZewY9~eJG),Ad}}v]&|+=r+QYl' );
define( 'AUTH_SALT',        'Dh<um9;547N#=q,]BDTa|/8^nFM0)xb|,r(+V+@HugpxP9YWd_oG+<}1hzB(7[Pe' );
define( 'SECURE_AUTH_SALT', '>?A{NfE)d5&fgu]Q[^^[v++QWI4 S!+*g+&0VP6;%23W-@FZNeM{JDT,JCz@)4#X' );
define( 'LOGGED_IN_SALT',   ')r2[`5MM0=-Ux(9$OZJ`/gZue?qc:,{3Ig5I>5Hc*q{Dv<h1*J4S @k[]0THEXrz' );
define( 'NONCE_SALT',       'LAl5A7^)$x5*,/.v>;N/M1jHA;lXaB^a`tTQ0VN<X&]Q&pfj2rR9]#gCAwC)4%=u' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
