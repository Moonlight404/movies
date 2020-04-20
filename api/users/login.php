<?php
header('Content-Type: application/json');
require '../classes/conexao.php';
require '../functions/user.php';
$user = new user;
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if($data){
$email = $data['email'];
$password = $data['password'];
$encryptadoSenha = sha1($password);
$sql = "SELECT * FROM user WHERE email = :email AND password = :password";
$stmt = $PDO->prepare($sql); 
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $encryptadoSenha);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(count($users) > 0){
    $token = $user->getToken(60);
    $sql = "UPDATE user SET token=? WHERE email=? and  password=?";
    $stmt= $PDO->prepare($sql);
    $stmt->execute([$token, $email, $encryptadoSenha]);
    setcookie('token', $token);
    echo json_encode($token);
} else{
    echo json_encode("error");
}
} else{
    echo json_encode("error");
}