<?php
require_once './db/DB.php';

/**
 * Description of Responsavel
 *
 * @author pedro
 */
class Responsavel {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }
    /**
     * 
     * @param obj $param
     * @return int
     */
    public function create($param) {
        $this->db->query("INSERT INTO responsaveis(nome, cargo, email, telefone, telemovel, horacontacto) "
                . " VALUES(:nome, :cargo, :email, :telefone, :telemovel, :horacontacto)", 
                [':nome'=>$param->nome, ':cargo'=>$param->cargo, ':email'=>$param->email,
                    ':telefone'=>$param->telefone, ':telemovel'=>$param->telemovel, ':horacontacto'=>$param->horacontacto]);
        return $this->db->lastInsertId();
    }
    /**
     * 
     * @param int $id
     * @param obj $param
     * @return obj
     */
    public function edit($id, $param) {
        return $this->db->query("UPDATE responsaveis SET nome=:nome, cargo=:cargo, email=:email,"
                . " telefone=:telefone, telemovel=:telemovel, horacontacto=:horacontacto "
                . " WHERE id=:id", 
                    [':nome'=>$param->nome, ':cargo'=>$param->cargo, ':email'=>$param->email, ':telefone'=>$param->telefone,
                        ':telemovel'=>$param->telemovel, ':horacontacto'=>$param->horacontacto, ':id'=>$id]);
    }
    /**
     * 
     * @param int $id
     * @return obj
     */
    public function getOne($id) {
        return $this->db->query("SELECT * FROM responsaveis WHERE id=:id", [':id'=>$id]);
    }
}
