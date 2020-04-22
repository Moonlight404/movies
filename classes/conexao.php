<?php
define( 'MYSQL_HOST', 'mysql873.umbler.com:41890' );
define( 'MYSQL_USER', 'hardelcorp' );
define( 'MYSQL_PASSWORD', '-7l27g?(UD' );
define( 'MYSQL_DB_NAME', 'hardelcorp' );
try
{
    $PDO = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}