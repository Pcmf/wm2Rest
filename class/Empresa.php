<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './db/DB.php';
/**
 * Description of Empresa
 *
 * @author pedro
 */
class Empresa {
    private $db;
    private $id;
    private $nome;
    private $area;
    private $rua;
    private $localidade;
    private $cpostal;
    private $longitude;
    private $latitude;
    private $responsavel;
    private $diasDescanso;
    private $horaAbertura;
    private $horaFecho;
    private $tiposPagamento;
    private $aberto;
    private $descricao;
    private $outrasInfo;
    private $contactos;
    private $email;
    private $idiomas;
    private $token;
    private $hashcode;

    public function __construct() {
        $this->db = new DB();
    }
    /**
     * 
     * @param string $nome
     * @param int $area
     * @param string $email
     * @param strin $pass
     * @return int
     */
    public function register($nome, $area, $email, $pass) {
        $this->db->query(sprintf("INSERT INTO empresas(nome, area, email, pass) "
                . " VALUES(:nome, :area, :email, :pass) ", 
                [':nome'=>$nome, ':area'=>$area, ':email'=>$email, ':pass'=>$pass]));
        return $this->db->lastInsertId();
    }
    
    public function edit($id, $param) {
        !isset($param->rua) ? $param->rua='': null;
        !isset($param->localidade) ? $param->localidade='': null;
        !isset($param->cpostal) ? $param->cpostal='': null;
        !isset($param->longitude) ? $param->longitude='': null;
        !isset($param->latitude) ? $param->latitude='': null;
        !isset($param->responsavel) ? $param->responsavel=0: null;
        !isset($param->diasdescanso) ? $param->diasdescanso='': null;
        !isset($param->horario) ? $param->horario='': null;
        !isset($param->tipospagamento) ? $param->tipospagamento='': null;
        !isset($param->aberto) ? $param->aberto=1: null;
        !isset($param->fotos) ? $param->fotos='': null;
        !isset($param->descricao) ? $param->descricao='': null;
        !isset($param->outrasinfo) ? $param->outrasinfo='': null;
        !isset($param->contactos) ? $param->contactos='': null;
        
        $this->db->query(sprintf("UPDATE empresa SET rua=:rua, localidae=:localidade,"
                . " cpostal=:cpostal, latitude=:latitude, longitude=:longitude, responsavel=:responsavel,"
                . " diasdescanso=:diasdescanso, horario=:horario, aberto=:aberto, fotos=:fotos, "
                . "descricao=:descricao, outrasinfo=:outrasinfo, contactos=:contactos"
                . " WHERE id=:id",
                $param->rua, $param->localidade, $param->cpostal, $param->longitude, $param->latitude,
                $param->responsavel, $param->diasdescanso, $param->horario, $param ->tipospagamento,
                $param->abero, $param->fotos, $param->descricao, $param->outrasinfo, $param->contactos,
                $id));
    }
}