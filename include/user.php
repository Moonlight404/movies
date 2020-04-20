<?php
function estouLogado(){
    require '../classes/conexao.php';
        if(isset($_COOKIE['token'])){
            $sql = "select * from user where token  = ?;";       
            $result = $PDO->query( $sql );
            $rows = $result->fetchAll();
            $result->bindParam(1, $_COOKIE['token']);
            if($rows){
                return true;
            } else{
                return false;
            }
        } else{
            return false;
        }
}