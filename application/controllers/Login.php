<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    public function index(){
        $this->load->view('estrutura/header');
		$this->load->view('login',array("login" => true));
		$this->load->view('estrutura/footer');
    }

	public function fazerLogin()
	{        
        $this->load->model('login_model');
        
        if($this->input->post('usuario') != "" &&
           $this->input->post('senha') != ""){

            $usuario = $this->input->post('usuario');
            $senha = $this->input->post('senha');
            
            $dados = array(
                'usu_email' => $usuario,
                'usu_senha' => $senha
            );

            if($this->login_model->validaUsuario($dados)){
                echo true;
            }else{
                echo false;
           } 
        }else{
            header('Location:'. base_url('login'));
        }
    }
    
    public function sair(){
        echo json_encode($this->session->usuario??'');
        if(isset($this->session->usuario)){
            $this->session->unset_userdata('usuario');;
        }
    }

    public function criarUsuario(){        
        $this->load->view('estrutura/header');
		$this->load->view('novo_usuario');
		$this->load->view('estrutura/footer');
    }

    public function novoUsuario(){
        $this->load->model('login_model');

        if($this->login_model->criarUsuario($_POST)){
            echo true;
        }else{
            echo false;
        }
    }
}
