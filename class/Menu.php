<?php

require_once './db/DB.php';
require_once 'Familia.php';
/**
 * Description of Menu
 *
 * @author pedro
 */
class Menu {
    private $db;
    private $Familia;


    public function __construct() {
        $this->db = new DB();
        $this->Familia = new Familia();
    }
    
    public function create($empresa, $obj) {
        $id = $this->Familia->create($empresa, $obj);
        $this->db->query("INSERT INTO menus(empresa, familia, artigo) VALUES(:empresa, :familia, 0)",
                [':empresa'=>$empresa, ':familia'=>$id]);
        return $this->getAll($empresa);
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
        $resp = array();   
        $result = $this->db->query("SELECT F.* FROM menus M "
                . " INNER JOIN familias F ON F.id=M.familia "
                . " WHERE M.empresa=:empresa GROUP BY F.id",
                [':empresa'=>$empresa] ); 
        foreach ($result AS $k){
            $result0 = $this->db->query("SELECT * FROM artigos WHERE familia=:familia ", [':familia'=>$k['id']]);
            $k['artigos'] = $result0;
            array_push($resp, $k);
        }
        return $resp;
    }
    
    public function delete($empresa, $familia,$artigo) {
        return $this->db->query("DELETE FROM menus WHERE empresa=:empresa AND familia=:familia AND artigo=:artigo",
                [':empresa'=>$empresa, ':familia'=>$familia,':artigo'=>$artigo] );
    }
}
