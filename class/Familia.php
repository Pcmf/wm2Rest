<?php
require_once './db/DB.php';
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
    public function create($empresa,$param) {
        $this->db->query("INSERT INTO familias(empresa, nome, imagem, descricao) "
                . " VALUES(:empresa, :nome, :imagem, :descricao) ", 
                [':empresa'=>$empresa, ':nome'=>$param->nome, ':imagem'=>$param->imagem, ':descricao'=>$param->descricao]);
        return $this->db->lastInsertId();
    }
    /**
     * 
     * @param int $id
     * @param obj $param
     * @return obj
     */
    public function edit($empresa, $id,$param) {
        return $this->db->query("UPDATE familias SET empresa=:empresa, nome=:nome, imagem=:imagem, descricao=:descricao "
                . " WHERE id=:id AND empresa=:empresa",
                [':nome'=>$param->nome, ':imagem'=>$param->imagem, ':descricao'=>$param->descricao,
                    ':id'=>$id, ':empresa'=>$empresa]);        
    }
    /**
     * 
     * @param int $id
     * @return obj
     */
    public function getOne($empresa, $id) {
        return $this->db->query("SELECT * FROM familias WHERE id=:id AND empresa=:empresa", 
                [':id'=>$id, ':empresa'=>$empresa]);
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
