<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Usuario');
        $this->load->model('Cuenta');
    }


    public function dashboard() {
        if ($this->session->userdata('id_usuario')) {
            $data["nombre_usuario"] = $this->session->userdata('nombres');
            $data["rol_usuario"] = $this->session->userdata('rol');
            $this->load->view('Dashboard/dashboard', $data);
           
        } else {
            redirect(site_url('Dashboard/login'));
        }
        
    }

    public function login() {
        $data["mensaje"] = "";
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $correo = $this->input->post("correo");
            $password = $this->input->post("password");
            // Obtén información del usuario por correo

            $info_usuario = $this->Usuario->verificar_correo($correo);
            if(isset( $info_usuario)){
                $data["mensaje"] = "Correo electronico incorrecto";
            }
            $info_cuenta = $this->Cuenta->verificar_contrasena($info_usuario->id_user);
            
            if (password_verify($password, $info_cuenta->password)) {
                // Contraseña válida, configura la sesión
                $sesion_data = array(
                    'id_usuario' => $info_usuario->id_user,
                    'documento' => $info_usuario->document_number,
                    'nombres' => $info_usuario->user_name,
                    'apellidos' => $info_usuario->user_last_name,
                    'correo' => $info_usuario->email,
                    'rol' => $info_usuario->rol,
                    'estado' => $info_usuario->status_user,
                    'telefono' => $info_usuario->cellphone
                );

                $this->session->set_userdata($sesion_data);

                // Redirige al dashboard
                redirect(site_url('Dashboard/dashboard'));
            }else{
                $data["mensaje"] = "Contraseña incorrecta";
            }
        }
        $this->load->view('usuario/login_pulguero', $data);
    }
     

    public function plantilla($usuario_id = null) {
        if ($this->session->userdata('id_usuario')) {
            if($this->session->userdata('rol') == 'Admin'){
                
        
            }else{
                redirect(site_url('Dashboard/data'));
            }
           
        } else {
            redirect(site_url('Dashboard/login'));
        }
       
    }

    public function ver($usuario_id = null) {
        if($this->session->userdata('rol') == 'Admin'){
            $usuario = $this->Usuario->find($usuario_id);
            if ($usuario) {
                $vdata["id_usuario"] = $usuario->id_usuario;
                $vdata["nombre"] = $usuario->nombre;
                $vdata["password"] = $usuario->password;
                $vdata["correo"] = $usuario->correo;
            } else {
                $vdata["usuario_id"] = $vdata["nombre"] = $vdata["password"] = $vdata["correo"] = "";
            }
            $this->load->view('Dashboard/verUser', $vdata);
        }else{
            redirect('Dashboard/data');
        }
       
    }

    public function data() {
        if ($this->session->userdata('id_usuario')) {
            $vdata["usuarios"] = $this->Usuario->findAll();
            $this->load->view('Dashboard/data', $vdata);
        } else {
            redirect(site_url('Dashboard/plantilla'));
        }
    }


    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url('Dashboard/login'), 'refresh');
    }


}
