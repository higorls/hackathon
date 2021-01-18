<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function index()
	{		
		if(isset($this->session->usuario['logado']) && $this->session->usuario['logado']){
			if($this->session->usuario['usu_tipo'] == 1){
				$this->load->view('estrutura/header');
				$this->load->view('empresa/home');
				$this->load->view('estrutura/footer');
			}else{
				$this->load->view('estrutura/header');
				$this->load->view('usuario/home');
				$this->load->view('estrutura/footer');
			}
		}else{
			$this->load->view('estrutura/header');
				$this->load->view('login',array("login" => true));
			$this->load->view('estrutura/footer');
		}
	}
}
