<?php
class TRAIL_Controller extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();

        if(!(isset($this->session->usuario['logado']) && $this->session->usuario['logado'])){
			$this->load->view('estrutura/header');
			$this->load->view('login',array("login" => true));
			$this->load->view('estrutura/footer');
		}
	}

}