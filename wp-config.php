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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u550779704_6DOg37ila_HeHbl0ozWHX3' );

/** Database username */
define( 'DB_USER', 'u550779704_6DOg37ila_cIgED7' );

/** Database password */
define( 'DB_PASSWORD', 'zSq0r9gf7qU3668umhK5MrF4pfP23Y' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '[OQNGEH2VS,P$/Lb3O,+Ky`*B&s9y;3V;;IS,qy4WkX=zkPBo]Yp.WasH.-Q*W] ' );
define( 'SECURE_AUTH_KEY',   'LW1AlL<J_%-i3JCAQJQQvzG[G rLe$K3|lV,Z~FT]m}~!^e1I{.I:.z}JM-XUi!d' );
define( 'LOGGED_IN_KEY',     ']Wh|`@GIs59{QgIU`<fq#zs$Vao{|*Mt@0Mcn]x^ ;amc[<wf(0@-N@=p[,r[3jE' );
define( 'NONCE_KEY',         'K@xZ.!0Xcu+jY`QRp~1Z hSa/]cArF5uV}Q,46g<L^l{}p_ZxiLe+Un_@r,%^C4Y' );
define( 'AUTH_SALT',         'DR4*!u+7~]6L*]ff|e)OwYlBXXT#9MkHSMb_{U*H64uWS/t#E=fOo@2c6Le6OACj' );
define( 'SECURE_AUTH_SALT',  'heu5pPd&xOU]=|}8,2unT{u]ydqvJ.*#o45`ctn)d!QjGz*ix[p]ZGdUU+[rOmwb' );
define( 'LOGGED_IN_SALT',    'D{00P`Eb_Oqn--QyFAohf+$oVKN?@.X[f#,96{=nnlRP0|tcERr1<&3,~_9>3F`u' );
define( 'NONCE_SALT',        '{CvlY*3o[@T.YZ6/;T9jpcHY0=>,E]D(!bnB6cTT6!,!&yozjjMkNg%wJ}vC:Aha' );
define( 'WP_CACHE_KEY_SALT', '@upGWRBnDK,BNq.1[5O,_|_OL9gDJ8aaB2Bvd-4?.fHQSBl)m^>9xStS>J Di_!Y' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_AUTO_UPDATE_CORE', false );
define( 'WP_CACHE', true );
define( 'FS_METHOD', 'direct' );
define( 'LSOC_PREFIX', 'u550779704_6DOg37ila:' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
