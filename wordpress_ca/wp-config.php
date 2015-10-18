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
define('DB_NAME', 'wordpress_ca');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Services2014');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '1`~_lD#k-Iz?8eL9qB/e%>M!q!skR-gmo -nXlQ+RU,uGIT[PvgPw1.TJu#R:G^a');
define('SECURE_AUTH_KEY',  '5nQSuS>Lv=c89(Mk]#`y@-3-jP2yH@mRDJWTB#p|]*0.Fb?2~NZOorCJ2@7S&[U+');
define('LOGGED_IN_KEY',    'CtU-A-eGiKj2m.g[r|F^L%Q8c(?fiWVk,+Wh]5QsTE@$eXwYRdp@QnUmugFk|>sN');
define('NONCE_KEY',        '3Y:Jc{Qy9})z-a45@kp>NwRk;&yk#--+x3R?tIBAf![:60xWPSj)wIQSuxrL^Of!');
define('AUTH_SALT',        'fX[q%%@/GgVEI6|=>9<Z*cIAY!DKG_/<n2;rJ6r!+.{<$.-+OW&/6.WBhxe#|s;!');
define('SECURE_AUTH_SALT', ' b)}:;..C3T2Zf.kP[<VT*``!F7Hixe-eHX=P5E;K-:kf4{2}pY89+}{)/-~HmEd');
define('LOGGED_IN_SALT',   'i||C=cI|M?8MNN496t|Oy*FEQu/m<s#-V]h-8CI<.T}$yy+9T(^~o<:V{{Ky}`&;');
define('NONCE_SALT',       'vO/_H`}/@eV[mOhB3;gH6i_+G{%S) DOxELh`j@V/fx~,|~ *wQURHj+0i{*BY0`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

