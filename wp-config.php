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
define('DB_NAME', 'ffpac');

/** MySQL database username */
define('DB_USER', 'ffpac');

/** MySQL database password */
define('DB_PASSWORD', '2sJrDmQnhahzSCjM');

/** MySQL hostname */
define('DB_HOST', 'barnescode.db');

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
define('AUTH_KEY',         'BHGJ?Z?3=?ZP mSu+zc]z/!vI-MPoP+q?()hayC9glc|ER6v,1N+GT@EQ/+|xIoH');
define('SECURE_AUTH_KEY',  '|hOT`@v[mt3d9lp:d!e= lKB0g9k4O*Ei3}Ht +xzeqIM<v**G,ec4t#+-&p|k!%');
define('LOGGED_IN_KEY',    '7uJ]5-~jxPgR*BhUWg1ndeiN^-(t6]t|++,*|SS]a)<+* 0?U&-A,DTLB4)tHRS1');
define('NONCE_KEY',        'Oq3!KOD{l+@/%>7,hc!,s-[-nq#6)Lf%mBj3B-?:y6Fi54bKg0silxG#B}=[4W0S');
define('AUTH_SALT',        'e+en|;{Ih-;wdt<WTXwrT~]|gNCtiM>Se-{e~~tk^@`]A-?U-Sy5)Ug!aafP#t^Z');
define('SECURE_AUTH_SALT', 'd.mx`z9SC{4&x+kT-Cq0S)x7w 84Un`kt^GO?IOx0[JRr%lJp]@IO~Kz|_?x^j~q');
define('LOGGED_IN_SALT',   '_?{U/IBXn^N;4cwqngzZ0qr!:_HU-J1e6|gc,~!{3]+g!+~yTlI2MkkW+~[&c?t]');
define('NONCE_SALT',       ']VNv5u$zuyVcUAMnc(JD:)=kW2#@C<nNVzlO@8aCC(Y_utR|Q?f,C8SlE9<b|5DV');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
