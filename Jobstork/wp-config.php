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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jobstork');

/** MySQL database username */
define('DB_USER', 'xternalrobo');

/** MySQL database password */
define('DB_PASSWORD', 'jobstork123');

/** MySQL hostname */
define('DB_HOST', 'mysql.berkeleysep.com');

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
define('AUTH_KEY',         '^`$`*D*%Hs]]B0jfJ0=@^QRw(-C0{ulE[j.z@Ju.7NZiYVJAmtBYv_DA<X8$ZRz$');
define('SECURE_AUTH_KEY',  ']rw=&+(25aXGamabo1CiR*ju[I>D|0UZ-0UM`fV=otPtA[,TFzWP|Yuk}[u)!bMv');
define('LOGGED_IN_KEY',    'o3$0:ew:8y>l3bZ)fXo|:1bt*9V&deg[@ m y1Ds:!#3dWwS*?B~xqMYiG<O~{Si');
define('NONCE_KEY',        'Hg@Qm`~gAwd@O,!nIRGi:#<71|tFh5lS!;}2u93FSErs;pCerSK7YH8mg?<U)VXV');
define('AUTH_SALT',        'm?,6|%%R9!b(FYoTe`6cn<&Bjq&vcqC#+fI.Ar?8Pt1.0U G|-C--YPrY&[GBe{*');
define('SECURE_AUTH_SALT', 'r1X-Ki`=PgjbwQB?M!-5?m5bTcZ/y}vb%w&BS/W-AnYny&n~kcjNQ*cA;qK;Cg4=');
define('LOGGED_IN_SALT',   'B^$f-aw#j=i5UY+*6?e]bbc jiGtGUBE;W,UZ`sg!)9j|D#_5G5[ QiVV/IW+X&u');
define('NONCE_SALT',       'Q$4^^hW!(#x%b-q] 5_Q]p@m6(++IHh81wB/F+C*9,@t54pSo75fNnhO]|as1M*+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
