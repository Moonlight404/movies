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
if(count($users) <= 0){
if(strlen($data['email']) > 5 && strlen($data['password']) > 0){
    $token = $user->getToken(90);
    try {
    $stmt = $PDO->prepare('INSERT INTO user (email,password,token, admin) VALUES(:email,:password,:token, :admin)');
    $stmt->execute(array(
        ':email' => $email,
        ':password' => $encryptadoSenha,
        ':token' => $token,
        ':admin' => 0
    ));
    setcookie('token', $token);
    echo json_encode($token);
    } catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
}
} else{
    echo json_encode('email_found');
}
}