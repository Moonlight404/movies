<?php
header('Content-Type: application/json');
require '../classes/conexao.php';
$sql = "select * from user;";       
$sql = "SELECT * FROM movies";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$movies = array();
 foreach($rows as $result){
        $movies[] = $result;
};
echo json_encode($movies);