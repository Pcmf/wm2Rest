<?php
require_once './db/DB.php';

/**
 * Description of Area
 *
 * @author pedro
 */
class UpImage {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }
    
    public function uploadImage($obj) {
        return $this->base64_to_jpeg($obj->base64, './imgs/'.$obj->filename); 
    }
    
    private function base64_to_jpeg($base64_string, $output_file) {
        $data = explode( ',', $base64_string );
        $decoded=base64_decode($data[1]);
        file_put_contents($output_file,$decoded);

        echo '{"img":"'.$output_file.'"}'; 
    }
}
