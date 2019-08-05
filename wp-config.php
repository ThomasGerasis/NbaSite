<?php
/**
 * Οι βασικές ρυθμίσεις για to WordPress
 *
 * Το wp-config.php χρησιμοποιείται από την δέσμη ενεργειών κατά την
 * διαδικασία εγκατάστασης. Δεν χρειάζεται να χρησιμοποιήσετε τον ιστότοπο, μπορείτε
 * να αντιγράψετε αυτό το αρχείο ως "wp-config.php" και να συμπληρώσετε τις παραμέτρους.
 *
 * Αυτό το αρχείο περιέχει τις ακόλουθες ρυθμίσεις:
 *
 * * MySQL ρυθμίσεις
 * * Κλειδιά ασφαλείας
 * * Πρόθεμα πινάκων βάσης δεδομένων
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL ρυθμίσεις - Μπορείτε να λάβετε αυτές τις πληροφορίες από τον φιλοξενητή σας ** //
/** Το όνομα της βάσης δεδομένων του WordPress */
define( 'DB_NAME', 'nbaholics' );

/** Ψευδώνυμο χρήσης MySQL */
define( 'DB_USER', 'root' );

/** Συνθηματικό βάσης δεδομένων MySQL */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Charset της βάσηςη δεδομένων που θα χρησιμοποιηθεί στην δημιουργία των πινάκων. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Τύπος Collate της βάσης δεδομένων. Μην το αλλάζετε αν έχετε αμφιβολίες. */
define('DB_COLLATE', '');

/**#@+
 * Μοναδικά κλειδιά πιστοποίησηςη και Salts.
 *
 * Αλλάξτε τα σε διαφορετικά μοναδικές φράσεις!
 * Μπορείτε να δημιουργήσετε χρησιμοποιώντας {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Μπορείτε να τα αλλάξετε οποτεδήποτε για να ακυρώσετε τα υπάρχοντα cookies. Θα υποχρεώσει όλους χρήστες να επανασυνδεθούν.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'lx_K#R>8RxbP;A#7afUVw@,3zr4SfQ%VbQ0k50|}.&:DO~Ek^J(FhhY&p|0m|/b*' );
define( 'SECURE_AUTH_KEY',  'yEM]GS6|xsi++ER~*]$Tciu]9>D0#/4eE}00+2M~@*VYnDfqu+7OFzRe#ysmgVM`' );
define( 'LOGGED_IN_KEY',    '_H5c|{cj|T;qP41[Q2NVPN;Vaeu0[r]hg?2heRKQ4~#n^=z<qLcun76q$]Nh}@9f' );
define( 'NONCE_KEY',        'Iz&c-W+<C8$V-Ax7E|~_?Om}UR,FQ$B&,=Dd6:tTm<J=IuNd*i Jh=o]HNJp1UO0' );
define( 'AUTH_SALT',        '^!a{M&eXk?*(/-|~tOwU>`%eJDI->Gn<.]S,7GO$+Dzvmasq_%pR^*v(hk)>]V=<' );
define( 'SECURE_AUTH_SALT', 'g/rJA0$bz1(j#gJE$0}K[_`Xmcss.[x$C8>{EKkAUd1NejQJB`T(sz:JnM@sfOia' );
define( 'LOGGED_IN_SALT',   '2&<ESpU#nAr6r8Q6!bg;NU-SDE4_Z4E MG,._l*;bIw0ow,*Vh?2GHsw^r?IIooS' );
define( 'NONCE_SALT',       'T1%TNXz$_t[JW={{Kr Oh`o-lxU>fnxn/[%e>+Yj60 ?F#~`7=roY6,,0=A@);,9' );

/**#@-*/

/**
 * Πρόθεμα Πίνακα Βάσης Δεδομένων του WordPress.
 *
 * Μπορείτε να έχετε πολλαπλές εγκαταστάσεις σε μια βάση δεδομένων αν δώσετε σε κάθε μία
 * ένα μοναδικό πρόθεμα. Μόνο αριθμοί, γράμματα και κάτω παύλα παρακαλούμε!
 */
$table_prefix = 'wp_';

/**
 * Για προγραμματιστές: Κατάσταση Απασφαλμάτωσης WordPress (Debugging Mode).
 *
 * Αλλάξτε το σε true για να ενεργοποιήσετε την εμφάνισης ειδοποιήσεων για την διαδικασία ανάπτυξης.
 * Η χρήση WP_DEBUG προτείνεται για τους δημιουργούς προσθέτων και θεμάτων
 * στο περιβάλλον ανάπτυξης τους.
 *
 * Για πληροφορίες για άλλες σταθερές που μπορούν να χρησιμοποιηθούν για απασφαλμάτωση,
 * επισκευθείτε το Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Αυτό είναι όλο, σταματήστε γράφετε! Χαρούμενο blogging. */

/** Η απόλυτη διαδρομή τον κατάλογο του WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Ορίζει τις μεταβλητές και τα περιλαμβανόμενα αρχεία WordPress. */
require_once(ABSPATH . 'wp-settings.php');
