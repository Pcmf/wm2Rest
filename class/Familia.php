<?php
require_once '../db/DB.php';
/**
 * Description of Familia
 *
 * @author pedro
 */
class Familia {
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
        $this->db->query("INSERT INTO familias(empresa, nome, imagem, obs) "
                . " VALUES(:empresa, nome, imagem, obs) ", 
                [':empresa'=>$param->empresa, ':nome'=>$param->nome, ':imagem'=>$param->imagem, ':obs'=>$param->obs]);
        return $this->db->lastInsertId();
    }
    /**
     * 
     * @param int $id
     * @param obj $param
     * @return obj
     */
    public function edit($id,$param) {
        return $this->db->query("UPDATE familias SET empresa=:empresa, nome=:nome, imagem=:imagem, obs=:obs "
                . " WHERE id=:id ",
                [':empresa'=>$param->empresa, ':nome'=>$param->nome, ':imagem'=>$param->imagem, ':obs'=>$param->obs,
                    ':id'=>$id]);        
    }
    /**
     * 
     * @param int $id
     * @return obj
     */
    public function getOne($id) {
        return $this->db->query("SELECT * FROM familias WHERE id=:id ", [':id'=>$id]);
    }
    /**
     * 
     * @param int $empresa
     * @return obj
     */
    public function getAll($empresa) {
        return $this->db->query("SELECT * FROM familias WHERE empresa=:empresa ", [':empresa'=>$empresa]);
    }
}
