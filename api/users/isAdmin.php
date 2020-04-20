<?php
header('Content-Type: application/json');
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(isset($data['token'])){
require '../classes/conexao.php';
$sql = "SELECT * FROM user WHERE token = :token AND admin = 1";
$stmt = $PDO->prepare($sql); 
$stmt->bindParam(':token', $data['token']);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(count($users) > 0){
    echo "true";
} else{
    echo "false";
}
} else{
    echo "false";
}