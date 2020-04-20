<?php
namespace Classes;

require 'conexao.php';
use Classes\Conexao;

class Movies {
    public $movieName;
    public $tempoFilme;
    public $trailer;
    public $notasFilmes;
    public $atoresFilme;
    public $sinopse;
    public $categorias;
    public $capa;
    public $cover;

    public function editarFilme($id, $movieName, $tempoFilme, $trailer, $notasFilmes, $atoresFilme, $sinopse, $categorias, $capa, $cover){
        $sql = "update movie set movieName = ?, 
        tempoFilme = ?, trailer = ?, notasFilmes = ?,
         atores = ?, sinopse = ?, categorias = ?, capa = ?, 
         cover = ? where id = ?;";       
        $q = $this->conexao->prepare($sql);
        $q->bindParam(1, $movieName);
        $q->bindParam(2, $tempoFilme);
        $q->bindParam(3, $trailer);
        $q->bindParam(4, $notasFilmes);
        $q->bindParam(5, $atoresFilme);
        $q->bindParam(6, $sinopse);
        $q->bindParam(7, $categorias);
        $q->bindParam(8, $capa);
        $q->bindParam(9, $cover);
        $q->bindParam(10, $id);
        $q->execute();
    }

    public function novoFilme($movieName, $tempoFilme, $trailer, $notasFilmes, $atoresFilme, $sinopse, $categorias, $capa, $cover){
        $sql = "insert into movie (movieName, tempoFilme, trailer, notasFilmes, atores, sinopse, categorias, capa, cover) values (?, ?, ?, ?);";
        $q = $this->conexao->prepare($sql);
        $q->bindParam(1, $movieName);
        $q->bindParam(2, $tempoFilme);
        $q->bindParam(3, $trailer);
        $q->bindParam(4, $notasFilmes);
        $q->bindParam(5, $atoresFilme);
        $q->bindParam(6, $sinopse);
        $q->bindParam(7, $categorias);
        $q->bindParam(8, $capa);
        $q->bindParam(9, $cover);
        $q->execute();
    }

    public function delete($id){
        $sql = "delete from movie where id = ?;";       
        $q = $this->conexao->prepare($sql);
        $q->bindParam(1, $id);
        $q->execute();
    }

    public function listar() {
        $sql = "select * from movie;";       
        $q = $this->conexao->prepare($sql);
        $q->execute();
        $movies = array();
        foreach($q as $result){
            $movies[] = $result;
        };
        return $movies;
    }

}