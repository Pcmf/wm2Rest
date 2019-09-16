<?php
require_once '../db/DB.php';

/**
 * Description of Area
 *
 * @author pedro
 */
class Area {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }
    
    public function get($id) {
        return $this->db->query("SELECT * FROM areas WHERE id=:id", [':id'=>$id]);
    }
    
    public function create($param) {
        $this->db->query("INSERT INTO areas(nome, descricao) VALUES(:nome, :descricao)", 
                [':nome'=>$param->nome, ':descricao'=>$param->descricao]);
        return $this->db->lastInsertId();
    }
}
