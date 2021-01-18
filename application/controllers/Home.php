<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function index(){
		$this->load->view('estrutura/header');
		$this->load->view('index');
		$this->load->view('estrutura/footer');
	}
	public function app()
	{		
		if(isset($this->session->usuario['logado']) && $this->session->usuario['logado']){
			if($this->session->usuario['usu_tipo'] == 1){
				$this->load->view('estrutura/header');
				$this->load->view('empresa/home');
				$this->load->view('estrutura/footer');
			}else{
				$this->load->view('estrutura/header');
				$this->load->model('trail_model');
				$usu_info = (array) json_decode($this->session->usuario['usu_info']);
				if($usu_info['B'] == 0 && $usu_info['T'] == 0 && $usu_info['C'] == 0 && $usu_info['RH'] == 0){
					$trail = $this->trail_model->getAvaibleTrails($this->session->usuario['usu_cod']);
					$this->load->view('usuario/home', array('trail' => $trail));
				}else{
					$this->load->model('app_model');					
					$trail = $this->trail_model->sugestTrail($this->session->usuario['usu_cod']);
					$modulos = $this->app_model->getModulos($trail);
					$this->load->view('usuario/app', array('trail' => $modulos));
				}
				$this->load->view('estrutura/footer');
			}
		}else{
			$this->load->view('estrutura/header');
				$this->load->view('login',array("login" => true));
			$this->load->view('estrutura/footer');
		}
	}

	public function support(){
		$this->load->view('estrutura/header');
		$this->load->view('suport');
		$this->load->view('estrutura/footer');
	}
}
