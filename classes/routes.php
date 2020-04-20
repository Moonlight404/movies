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

    public  function estouLogado(){
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
        $urlCompleta = "https://".$_SERVER['HTTP_HOST']."/api/users/verificaSessao";
        $response = $client->request('POST', $urlCompleta, [
    'form_params' => [
        'token' => $_COOKIE['token'],
    ]
]);
        $logado = $response->getBody();
        return $logado;
    }

    public function souAdmin(){
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
        $urlCompleta = "https://".$_SERVER['HTTP_HOST']."/api/users/isAdmin";
        $response = $client->request('POST', $urlCompleta, [
        'form_params' => [
            'token' => $_COOKIE['token'],
        ]
    ]);
        $admin = $response->getBody();
        return $admin;
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