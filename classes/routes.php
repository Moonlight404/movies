<?php

require '../vendor/autoload.php';
use GuzzleHttp\Client;
require 'movie.php';

class route {

    public function template($route){
        $route = ltrim($route, '/');
        if(@include_once("../template/$route.php")) {
        } else{
            require("../template/404.php");
        }
    }

    public function searchMovie($movie){
        $urlCompleta = "https://api.themoviedb.org/3/movie/". $movie  ."?api_key=ccc818e2030b429ec7c400dd6cc5551e&language=pt-BR";
        $response = $client->request('GET', $urlCompleta, [
        'form_params' => [
            'token' => $_COOKIE['token'],
        ]
    ]);
        $movie = $response->getBody();
        $objMovie = json_decode($movie);
        return $objMovie;
    }

    public  function estouLogado(){
        if(isset($_COOKIE['token'])){
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);
            $urlCompleta = "http://".$_SERVER['HTTP_HOST']."/api/users/verificaSessao";
            $response = $client->request('POST', $urlCompleta, [
            "timeout" => 3000,
            'form_params' => [
                'token' => $_COOKIE['token'],
            ]
            ]);
            $logado = $response->getBody();
            return $logado;
        } else{
            return "false";
        }
    }

    public function souAdmin(){
        if(isset($_COOKIE['token'])){
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);
            $urlCompleta = "http://".$_SERVER['HTTP_HOST']."/api/users/isAdmin";
            $response = $client->request('POST', $urlCompleta, [
            "timeout" => 3000,
            'form_params' => [
                'token' => $_COOKIE['token'],
            ]
            ]);
            $admin = $response->getBody();
            return $admin;  
        } else{
            return "false";
        }
    }

    public function getRoute($url){
        if(preg_match("/api/", $url)) {
            $this->getApiRoute(trim($url, '/api/'));
        } else{
        if($url == '/'){
            if($this->estouLogado() == "true"){
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
         } else{
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