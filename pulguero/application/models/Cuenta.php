<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Model {

    Public $table = 'account';
    Public $table_id = 'id_account';

    Public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->database();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    public function verificar_contrasena($user_id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id_user", $user_id);
        $query = $this->db->get();
        return $query->row();
    }
}
