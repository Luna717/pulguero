<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Categoria extends CI_Model {

    Public $table = 'category';
    Public $table_id = 'id_category';

    Public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->database();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    public function findAll(){
        $this->db->select();
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

}
