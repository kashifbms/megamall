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
define( 'DB_NAME', 'megamall' );

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
define( 'AUTH_KEY',         '9; Ax|P/c]>d^dRx*U/6)!Q{~`B;iN!vCeY4.o$p=Z@%fu#u)wx>pu]^Y0O<>)u,' );
define( 'SECURE_AUTH_KEY',  ';oKToXY#fFZ]5)`tKi|<g8;l=|AIz^^I6j)57bP;rnOTT}MP@x9feGN22]S87Od3' );
define( 'LOGGED_IN_KEY',    'HdgVvg6Xlwr+7DT$F~P0N:k{f`.B(D =47uuKF=aJJdtRWubA0Zy%H1J>X_EK$wE' );
define( 'NONCE_KEY',        'n`7^1po=aEhfD(.-g9I=AC/[p<ZK;~hpzN2EVK;b^D:u+hokd>u*#d -iguP^:{y' );
define( 'AUTH_SALT',        '+FF:$3<QW8|iRb@W2JzC|R~`mSb`mB?[GJDknA`w$J6,<).`S]wu~G<B!%l{kN?6' );
define( 'SECURE_AUTH_SALT', 'I8XC^:HK( $UD5Std e!@6;GPs>Gu|UpCzE[zAL~[&W2hw;ZXc<LO:c((u.`C{|W' );
define( 'LOGGED_IN_SALT',   'x0nGBVbQd;^6iH.u^-wu*v,)@/%#5-;Tm4jX~:)c8( ,$lTybA10I98|T=YpNjkq' );
define( 'NONCE_SALT',       '_2P<KK]?~_|Rx{1Ds,(wp#/-/bB)[o[H&@M}~s;KSo=6$~K|1Rk*eEs;p,Bz<_|s' );

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
//define( 'WP_DEBUG', true );
//define( 'WP_DEBUG_LOG', true );
//define( 'WP_DEBUG_DISPLAY', false );
//@ini_set( 'display_errors', 0 );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
