<?php

require '../vendor/autoload.php';
use GuzzleHttp\Client;

class route {

    public function template($route){
        $route = ltrim($route, '/');
        if(@include_once("../template/$route.php")) {
        } else{
            require("../template/404.php");
        }
    }

    public function searchMovie($movie){
        $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
        ]);
        $urlCompleta = "https://api.themoviedb.org/3/movie/". $movie  ."?api_key=ccc818e2030b429ec7c400dd6cc5551e&language=pt-BR";
        $response = $client->request('GET', $urlCompleta);
        $movie = $response->getBody();
        return $movie;
    }

    public  function userLogado(){
        if(isset($_COOKIE['token'])){
        require 'conexao.php';
        $sql = "SELECT * FROM user WHERE token = :token";
        $stmt = $PDO->prepare($sql); 
        $stmt->bindParam(':token', $_COOKIE['token']);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($users) > 0){
            return "true";
        } else{
            return "false";
        }
        } else{
           return $_COOKIE['token'];
        }
    }

    public function souAdmin(){
        if(isset($_COOKIE['token'])){
        require 'conexao.php';
        $sql = "SELECT * FROM user WHERE token = :token and admin = 1";
        $stmt = $PDO->prepare($sql); 
        $stmt->bindParam(':token', $_COOKIE['token']);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($users) > 0){
            return "true";
        } else{
            return "false";
        }
        } else{
           return $_COOKIE['token'];
        }
    }    

    public function getRoute($url){
        if(preg_match("/api/", $url)) {
            $this->getApiRoute(trim($url, '/api/'));
        } else{
        if($url == '/'){
            if($this->userLogado() == "true"){
                $this->template('dashboard');
            } else{
                $this->template('home');
            }
         } else if($url == '/admin'){
             if($this->souAdmin() == "true"){
                $this->template('admin');
             } else{
                 require("../template/404.php");
             }
         }else if(preg_match("/themovieDB/", $url)) {
             if($this->souAdmin() == "true"){
             $id = trim($url, '/themovieDB/');
             if(!$id == ""){
                echo $this->searchMovie($id);
             }
            } else{
                require("../template/404.php");
            }
         }else{
            $this->template($url);
         }
        }
    }

    public function getApiRoute($route){
        if(@include_once("../api/$route.php")) {
        } else{
            require("../template/404.php");
        }
    }

}