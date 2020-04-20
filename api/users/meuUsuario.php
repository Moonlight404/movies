<?php
header('Content-Type: application/json');
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(isset($data['token'])){
require '../classes/conexao.php';
$sql = "SELECT * FROM user WHERE token = :token";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':token', $data['token']); 
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// pega o primeiro usuário
$user = $users[0];
echo json_encode($user);
}