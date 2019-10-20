<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './db/DB.php';
require_once 'passwordHash.php';

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

    /**
     * 
     * @param type $username
     * @param type $password
     * @return boolean
     */
    public function checkuser($email, $password) {
        //Verificar se utilizador existe
        if ($resp = $this->db->query("SELECT * FROM empresas WHERE email=:email "
                , array(':email' => $email))) {
            //verificar se a password e utilizador correspondem
            $this->valido = false;

            foreach ($resp AS $r) {
     //           if (passwordHash::check_password($r['pass'], $password)) {
               if ( $r['pass'] == $password ) {
                    $this->token = $this->generateToken($r);
                    $this->db->query("UPDATE empresas SET token=:token WHERE id=:id ", array(':token' => $this->token, ':id' => $r['id']));
                    $this->valido = true;
                    break;
                }
            }
            if ($this->valido) {
                return $this->token;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * 
     * @param int $empresa
     * @return obj
     */
    public function getOne($empresa) {
        return $this->db->query("SELECT E.*, A.nome AS areanome, A.descricao AS areadesc"
                        . " FROM empresas E"
                        . " INNER JOIN areas A ON A.id=E.area "
                        . " WHERE E.id=:id", [':id' => $empresa]);
    }

    /**
     * 
     * @return obj
     */
    public function getAll() {
        return $this->db->query("SELECT E.*, A.nome AS areanome, A.descricao AS areadesc"
                        . " FROM empresas E"
                        . " INNER JOIN areas A ON A.id=E.area");
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
        if ($param->nome != '') {
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
                    . " WHERE id=:id", [':nome' => $param->nome, ':area' => $param->area,
                ':rua' => $param->rua, ':localidade' => $param->localidade, ':cpostal' => $param->cpostal,
                ':longitude' => $param->longitude, ':latitude' => $param->latitude, ':responsavel' => $param->responsavel,
                ':diasfuncionamento' => $param->diasfuncionamento, ':horario' => $param->horario, ':tipospagamento' => $param->tipospagamento,
                ':aberto' => $param->aberto, ':fotos' => $param->fotos, ':descricao' => $param->descricao,
                ':outrasinfo' => $param->outrasinfo, ':contactos' => $param->contactos, ':id' => $id]);
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

    //TOKEN
    /**
     * Check token and return user ID or false
     */
    private function generateToken($resp) {
        //Chave para a encriptação
        $key = 'klEpFG93';

        //Configuração do JWT
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $header = json_encode($header);
        $header = base64_encode($header);

        //Obter o nome do fornecedor
        //Dados 
        $payload = [
            'iss' => 'WMenu 2',
            'id' => $resp['id'],
            'nome' => $resp['nome'],
            'email' => $resp['email'],
            'negocio' => $resp['negocio']
        ];

        $payload = json_encode($payload);
        $payload = base64_encode($payload);

        //Signature

        $signature = hash_hmac('sha256', "$header.$payload", $key, true);
        $signature = base64_encode($signature);
        // echo $header.$payload.$signature;

        return "$header.$payload.$signature";
    }

}
