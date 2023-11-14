<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

    Public $table = 'users';
    Public $table_id = 'id_user';

    Public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->database();
    }

    public function findAll(){
        $this->db->select();
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    public function usuariosEmpresa() {
        $this->db->select();
        $this->db->from($this->table);
        
        $this->db->where_in('rol', ['Admin', 'Supervisor']);
    
        $query = $this->db->get();
        return $query->result();
    }

    public function usuariosCliente() {
        $this->db->select();
        $this->db->from($this->table);
        
        $this->db->where_in('rol', ['Cliente', 'Vendedor']);
    
        $query = $this->db->get();
        return $query->result();
    }

    public function find($id){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);

        $query = $this->db->get();
        return $query->row();
    }
    public function comprobarLogin($nombre, $password){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("correo", $nombre);
        $this->db->where("password", $password);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($id, $data){
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where($this->table_id, $id);
        $this->db->delete($this->table);
    }

    public function borrar($id) {
        $usuario = $this->db->get_where($this->table, array($this->table_id => $id))->row();
    
        if ($usuario) {
            $nuevo_estado = ($usuario->status_user == 1) ? 0 : 1;
    
            $this->db->where($this->table_id, $id);
            $this->db->update($this->table, array('status_user' => $nuevo_estado));
        }
    }


    public function obtenerUsuariosActivos() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('status_user', 1);
    
        $query = $this->db->get();
        return $query->result();
    }


    public function obtenerUsuariosInactivos() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where_in('rol', ['Cliente', 'Vendedor']);
        $this->db->where('status_user', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerUsuariosClientesActivos() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where_in('rol', ['Cliente', 'Vendedor']);
        $this->db->where('status_user', 1);
    
        $query = $this->db->get();
        return $query->result();
    }


    public function obtenerUsuariosClientesInactivos() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('status_user', 0);
    
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    public function verificar_correo($email) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("email", $email);
        $query = $this->db->get();
        return $query->row();
    }
}
