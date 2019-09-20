<?php

require_once './db/DB.php';

/**
 * Description of Menu
 *
 * @author pedro
 */
class Menu {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }
    
    public function create($empresa,$familia) {
        $this->db->query("INSERT INTO menus(empresa, familia, artigo) VALUES(:empresa, :familia, 0)",
                [':empresa'=>$empresa, ':familia'=>$familia]);
        return $this->db->lastInsertId();
    }
    
    public function edit($empresa,$familia,$artigo,$param) {
        return $this->db->query("UPDATE menus SET posicao=:posicao, preco=:preco, promocao=:promocao, "
                . "precopromo=:precopromo, disponivel=:disponivel "
                . " WHERE empresa=:empresa AND familia=:familia AND artigo=:artigo",
                [':empresa'=>$empresa, ':familia'=>$familia,':artigo'=>$artigo, ':posicao'=>$param->posicao,
                    ':preco'=>$param->preco, ':promocao'=>$param->promocao, ':precopromo'=>$param->precopromo,
                    ':disponivel'=>$param->disponivel]);
    }
    
    public function getOne($empresa,$familia,$artigo) {
        return $this->db->query("SELECT * FROM menus WHERE empresa=:empresa AND familia=:familia AND artigo=:artigo",
                [':empresa'=>$empresa, ':familia'=>$familia,':artigo'=>$artigo] );
    }
    
    public function getByFamilia($empresa, $familia) {
        return $this->db->query("SELECT * FROM menus WHERE empresa=:empresa AND familia=:familia",
                [':empresa'=>$empresa, ':familia'=>$familia] );        
    }
    
        public function getAll($empresa) {
        return $this->db->query("SELECT * FROM menus WHERE empresa=:empresa",
                [':empresa'=>$empresa] );        
    }
    
    public function delete($empresa, $familia,$artigo) {
        return $this->db->query("DELETE FROM menus WHERE empresa=:empresa AND familia=:familia AND artigo=:artigo",
                [':empresa'=>$empresa, ':familia'=>$familia,':artigo'=>$artigo] );
    }
}
