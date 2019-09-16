<?php
require_once '../db/DB.php';

/**
 * Description of Promocao
 *
 * @author pedro
 */
class Promocao {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }
    
    public function create($empresa, $param) {
        $this->db->query("INSERT INTO promocoes(empresa, nome, descricao, imagem, diaspromo, horariopromo) "
                . " VALUES(:empresa, :nome, :descricao, :imagem, :diaspromo, :horariopromo)", 
                [':empresa'=>$empresa, ':nome'=>$param->nome, ':descricao'=>$param->descricao,
                    ':imagem'=>$param->imagem, ':diaspromo'=>$param->diaspromo, ':horariopromo'=>$param->horariopromo]);
        
        return $this->db->lastInsertId();
    }
    
    public function edit($id, $empresa, $param) {
        return $this->db->query("UPDATE promocoes SET nome=:nome, descricao=:descricao, imagem=:imagem,"
                . " diaspromo=:diaspromo, horariopromo=:horariopromo WHERE id=:id AND empresa=:empresa", 
                [':id'=>$id, ':empresa'=>$empresa, ':nome'=>$param->nome, ':descricao'=>$param->descricao,
                    ':imagem'=>$param->imagem, ':diaspromo'=>$param->diaspromo, ':horariopromo'=>$param->horariopromo]);
    }
    
    public function getOne($id) {
        return $this->db->query("SELECT * FROM promocoes WHERE id=:id", [':id'=>$id]);
    }
    
    public function getAll($empresa) {
        return $this->db->query("SELECT * FROM promocoes WHERE empresa=:empresa", [':empresa'=>$empresa]);
    }
}
