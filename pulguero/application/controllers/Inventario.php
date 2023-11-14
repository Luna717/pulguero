<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {

	Public function __construct(){
        parent::__construct();
        $this->load->helper('form');
		$this->load->helper('url');
        $this->load->database();
		$this->load->model('Usuario');
        $this->load->library('session');
        $this->load->model('Cuenta');
    }

	public function inventario()
    {
        if ($this->session->userdata('id_usuario')) {
            if($this->session->userdata('rol') == 'Admin'){
                $this->load->view('Dashboard/inventario');

            }else{
                redirect(site_url('Dashboard/dashboard'));
            }
           
        } else {
            redirect(site_url('Dashboard/login'));
        }
    }


}
