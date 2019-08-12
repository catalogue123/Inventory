<?php 
define('BASE_URL','http://101.53.142.21/inventory/admin');
// DB credentials.
define('DB_HOST','mysql:dbname=management;host=localhost');
define('DB_USER','root');
define('DB_PASS','root@1234');
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
