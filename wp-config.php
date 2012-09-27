<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
define('WP_HOME','http://localhost/CoHoop-Blog');
define('WP_SITEURL','http://localhost/CoHoop-Blog');

/*define('WP_HOME','http://localhost/CoHoop-Blog');
define('WP_SITEURL','blog.cohoop.com');

define('WP_HOME','blog.cohoop.com');
define('WP_SITEURL','http://localhost/CoHoop-Blog');

define('WP_HOME','blog.cohoop.com');
define('WP_SITEURL','blog.cohoop.com');*/
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tduforest');


/** MySQL database username */
define('DB_USER', 'root');


/** MySQL database password */
define('DB_PASSWORD', 'root');


/** MySQL hostname */
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'SviSr-s~ul9l^+{Mu(hi`;)8P}]oFK{>*t$w5s-a7wtZz_1ePDy2UOf_vM_/R8$h');

define('SECURE_AUTH_KEY',  '-[EqT>k~]B! e(0hFkoDV#sCfD|th(u*/.$WoHcb}NTUt,GkH^4;7`h79]83>D:}');

define('LOGGED_IN_KEY',    'kg$lm4NnME+{|b}vdv&L9!|t++o]t+Um~Vf+1V~V>t18It7eN!*vPT*I4x7N4klY');

define('NONCE_KEY',        '%F[XP=y<P#h(Y8+Zj3i|KT=%,l@4h<CGfRs<XS/h;+rBTD[c+Q,-IOB5PLiF|,0}');

define('AUTH_SALT',        'R03Pi;C&{zJa~(>(IA5k;517<_!!!dnUAbJ}A[:0<<=|-E3C,I).G_,}-fyA=,KS');

define('SECURE_AUTH_SALT', 'yH&c#a@t^eu1Wcy1vdQv7CdvkNAg@9I,wm%9X:{] ^v->H$U&C`]G{v^i-MuHA.>');

define('LOGGED_IN_SALT',   '~6leQbmdRy-KVCa|Dye+5;O{<,1w;]nF|{Yz<X.`NM+~8RS1NlR4+4a|2OBmwDym');

define('NONCE_SALT',       'L0SL@H@5xZBO9O|Qs-gtTyBhkSghGL_{--+F.g#^rGwK7tShZ[ii-RB3OhG$.cy!');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'chb_';


/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
