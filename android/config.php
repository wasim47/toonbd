<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*define('DB_USERNAME', 'bdicu_user');
define('DB_PASSWORD', '@}*zz^PHqcPm');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'bdicu_db');
*/

define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'bdicu');

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


$db->set_charset("utf8");
?>