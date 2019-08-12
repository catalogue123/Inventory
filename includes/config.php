<?php 
define('BASE_URL','http://localhost/inventory');
// DB credentials.
define('DB_HOST','mysql:dbname=management;host=localhost');
define('DB_USER','suraj');
define('DB_PASS','root1234');
define('DB_NAME','management');
// Establish database connection.
try
{
$dbh = new PDO(DB_HOST, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>