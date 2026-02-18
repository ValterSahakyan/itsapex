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
define( 'DB_NAME', 'Dits_apex_wpB' );

/** Database username */
define( 'DB_USER', 'Dits_apex_wpB_User' );

/** Database password */
define( 'DB_PASSWORD', '3Q4iMlo1aG3LQUX!' );

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
define( 'AUTH_KEY',         'k[bJ@U(mzA8D1FkNK<(|d&I7<B(T!WF)W3Olei4udOxR/%3d?-fonSg2CkK9L3((' );
define( 'SECURE_AUTH_KEY',  '?x3,ji*i:zOwj)dO+IZ{_XEx SO`kD!pD`Mc#o}n@ROMc5](8wu5PD[U-L*rbAPk' );
define( 'LOGGED_IN_KEY',    '>xT_5Hs8Xa[E<~u.v:^1tN.oD-drI~c79G^NP1_*`>rHLzOeR6b-z)UDi(?4EJ 6' );
define( 'NONCE_KEY',        '5_h7_.82]Qu>q{eg*|urzHctJ]9,?p5v$3jz537$6qmqx[6XF%gQ,Ha]H$Mk](bl' );
define( 'AUTH_SALT',        'RA6sMra/q#Q*8(TLd+%-!Q8D`F,nW6vgTRon#0rc+>;P=7oq1eb&3a:`L,H(=^l]' );
define( 'SECURE_AUTH_SALT', ';W6VdT:|Exo&otj*AUwM@$BSK`%FyT@Fr#)IP}Gk=ZyA-IhN9r]zTU)dmqZRmHQ8' );
define( 'LOGGED_IN_SALT',   'gojIxi#gqSF< y!vJrJpgpV%ei|YR5B$/[T#W;%&%ln;/U6Qb`JCbCk^ld)Iy$th' );
define( 'NONCE_SALT',       '5#IaAgq9[)ik=0g[/;`kA&9R_ue{a&)Dd}>Oz=gwBgE(gC-432OQMc!pS:1 pu+N' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
