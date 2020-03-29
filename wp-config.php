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
define('DB_NAME', 'kalouwah_wp544');

/** MySQL database username */
define('DB_USER', 'kalouwah_wp544');

/** MySQL database password */
define('DB_PASSWORD', '7)[E2pbc6S');

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
define('AUTH_KEY',         'wsx0gjvipmejdkqpmcgoekm1qgm5htfhvoqpzutqa6knciqaisilbefhf48gehfp');
define('SECURE_AUTH_KEY',  'xkbvkwonvt3ckaj4wddsltxndqgduujksusckxboltlbx9najkmemjacqa8cxjav');
define('LOGGED_IN_KEY',    'hqtiiw5yl2ou5ddguq7qjcnwowrfblqji02wetqfhb08emqjlxy7tvntew5vlvdv');
define('NONCE_KEY',        '2j1mkf7xvdued2yeomriuurrtzgs04ku3k0iqvz5zbrlp2tntrnxia3enmof4r9e');
define('AUTH_SALT',        'fk2zbh4cp3uuat7epjxlsy46vnnkphxot1kdcq9btmt3i7jqtz2zzjk07oaa9zoh');
define('SECURE_AUTH_SALT', 'ly4iywseoqgeka4uofezg9ujht2nugslwn5k1ydvoawnbuzsuqtjn6oefkcidcyh');
define('LOGGED_IN_SALT',   'iqie8jhj5neqnayinaz0wkghtdwhj9ynr3dbxnpu95znbbril6pqbpf2ozen1bcy');
define('NONCE_SALT',       'dzprfzzsnfnopwwiipmz0o5seaurzgwtsupspk5utcamagy77yomisrx0mtbhxvb');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpbe_';

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
