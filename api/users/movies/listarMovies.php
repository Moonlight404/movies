<?php
header('Content-Type: application/json');;
require '../classes/conexao.php';
$sql = 'SELECT * FROM movies';
$stmt = $dbh->prepare( $sql );
$stmt->execute();
$result = $stmt->fetchAll( PDO::FETCH_ASSOC );
$json = json_encode( $result );
echo $json;