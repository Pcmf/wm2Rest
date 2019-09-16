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


    public function __construct() {
        $this->db = new DB();
    }

    public function get($id) {
        return $this->db->query("SELECT * FROM empresas WHERE id=:id" , [':id'=>$id]);
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
        $this->db->query("INSERT INTO empresas(nome, area, email, pass) "
                        . " VALUES(:nome, :area, :email, :pass) ",
                        [':nome' => $nome, ':area' => $area, ':email' => $email, ':pass' => $pass]);
        return $this->db->lastInsertId();
    }

    /**
     * Atualizar empresas
     * @param type $id
     * @param type $param
     * @return string
     */
    public function edit($id, $param) {
        if($param->nome != '') {
            !isset($param->localidade) ? $param->localidade = '' : null;
            !isset($param->rua) ? $param->rua = '' : null;
            !isset($param->localidade) ? $param->localidade = '' : null;
            !isset($param->cpostal) ? $param->cpostal = '' : null;
            !isset($param->longitude) ? $param->longitude = '' : null;
            !isset($param->latitude) ? $param->latitude = '' : null;
            !isset($param->responsavel) ? $param->responsavel = 0 : null;
            !isset($param->diasfuncionamento) ? $param->diasfuncionamento = '' : null;
            !isset($param->horario) ? $param->horario = '' : null;
            !isset($param->tipospagamento) ? $param->tipospagamento = '' : null;
            !isset($param->aberto) ? $param->aberto = 1 : null;
            !isset($param->fotos) ? $param->fotos = '' : null;
            !isset($param->descricao) ? $param->descricao = '' : null;
            !isset($param->outrasinfo) ? $param->outrasinfo = '' : null;
            !isset($param->contactos) ? $param->contactos = '' : null;

            $this->db->query("UPDATE empresas SET nome=:nome, area=:area, rua=:rua, localidade=:localidade,"
                            . " cpostal=:cpostal, latitude=:latitude, longitude=:longitude, responsavel=:responsavel,"
                            . " diasfuncionamento=:diasfuncionamento, horario=:horario, tipospagamento=:tipospagamento, aberto=:aberto, fotos=:fotos, "
                            . "descricao=:descricao, outrasinfo=:outrasinfo, contactos=:contactos"
                            . " WHERE id=:id", [':nome'=>$param->nome, ':area'=>$param->area,
                            ':rua'=>$param->rua, ':localidade'=>$param->localidade, ':cpostal'=>$param->cpostal,
                            ':longitude'=>$param->longitude, ':latitude'=>$param->latitude, ':responsavel'=>$param->responsavel,
                            ':diasfuncionamento'=>$param->diasfuncionamento, ':horario'=>$param->horario, ':tipospagamento'=>$param->tipospagamento,
                            ':aberto'=>$param->aberto, ':fotos'=>$param->fotos, ':descricao'=>$param->descricao,
                            ':outrasinfo'=>$param->outrasinfo, ':contactos'=>$param->contactos, ':id'=>$id]);
             $erro = '{
                "erro":false, 
                "msg":"Registo alterado"
            }';
        } else {
            $erro = '{
                "erro":true, 
                "msg":"O nome da empresa não pode estar em branco"
            }';

        }
        return $erro;
    }
    /**
     * Remover registo
     * @param type $id
     * @return string
     */
    public function delete($id) {
        return "not working yet";
    }
}   