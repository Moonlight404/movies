<?php
header('Content-Type: application/json');
require '../classes/conexao.php';   
$sql = "SELECT * FROM movie";
$stmt = $PDO->prepare($sql); 
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($movies);