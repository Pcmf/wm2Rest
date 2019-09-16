<?php
require_once './db/DB.php';
/**
 * Description of Artigo
 *
 * @author pedro
 */
class Artigo {
    private $db;
    
    public function __construct(){ 
        $this->db = new DB();
    }
    /**
     * 
     * @param type $id
     * @return type
     */
    public function getOne($id) {
        return $this->db->query("SELECT * FROM artigos WHERE id=:id", [':id'=>$id]);
    }
    /**
     * 
     * @param type $empresa
     * @return type
     */
    public function getAll($empresa) {
        return $this->db->query("SELECT * FROM artigos WHERE empresa=:empresa ", [':empresa'=>$empresa]);
    }
    /**
     * 
     * @param type $empresa
     * @param type $familia
     * @return type
     */
    public function getByFamilia($empresa, $familia) {
        return $this->db->query("SELECT * FROM artigos WHERE empresa=:empresa AND familia=:familia"
                , [':empresa'=>$empresa, ':familia'=>$familia]);
    }
    /**
     * 
     * @param type $param
     * @return type
     */
    public function create($param) {
        $this->db->query("INSERT INTO artigos(empresa, nome, familia, descricao, imagem, ativo) "
                . " VALUES(:empresa, :nome, :familia, :descricao, :imagem, 1) ",
                [':empresa'=>$param->empresa, ':nome'=>$param->nome, ':familia'=>$param->familia,
                ':descricao'=>$param->descricao, ':imagem'=>$param->imagem]);
        return $this->db->lastInsertId();
    }
    /**
     * 
     * @param type $id
     * @param type $param
     * @return string
     */
    public function edit($id, $param) {
        if($nome){
        return $this->db->query("UPDATE artigos SET nome=:nome, familia=:familia, descricao=:descricao, imagem=:imagem, ativo=:ativo "
                . " WHERE id=:id", [':nome'=>$param->nome, ':familia'=>$param->familia, ':descricao'=>$param->descricao,
                    ':imagem'=>$param->imagem, ':ativo'=>$param->ativo, ':id'=>$id]);
        } else {
            return "erro";
        }
    }
}
