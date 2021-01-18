<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('app_model');
    }

	public function index(){
        if(isset($this->session->usuario['logado']) && $this->session->usuario['logado']){
			if($this->session->usuario['usu_tipo'] == 1){
				$this->load->view('estrutura/header');
				$this->load->view('empresa/app');
				$this->load->view('estrutura/footer');
			}else{
				$this->load->view('estrutura/header');
				$this->load->model('trail_model');
                $trail = $this->trail_model->sugestTrail($this->session->usuario['usu_cod']);
                $modulos = $this->app_model->getModulos($trail);
                $usu_info = $this->app_model->getUsu_info($this->session->usuario['usu_cod']);
				$this->load->view('usuario/app', array('trail' => $modulos, 'usu_info'=>$usu_info));
				$this->load->view('estrutura/footer');
			}
		}else{
			$this->load->view('estrutura/header');
				$this->load->view('login',array("login" => true));
			$this->load->view('estrutura/footer');
		}
    }
    
    public function iniciarTrilha($tri_cod){
        $modulos = $this->app_model->iniciarTrilha($tri_cod);

        $this->load->view('estrutura/header');
        $this->load->view('usuario/trilha', array('data' => $modulos));
        $this->load->view('estrutura/footer');
    }

    public function viewModulo($mod_cod){
        $questoes = $this->app_model->iniciarModulo($mod_cod);

        $this->load->view('estrutura/header');
        $this->load->view('usuario/view_modulo', array('modulo' => $questoes));
        $this->load->view('estrutura/footer');

    }

    public function iniciarModulo($mod_cod){
        $questoes = $this->app_model->iniciarModulo($mod_cod);

        $this->load->view('estrutura/header');
        if($mod_cod == 1){
            $this->load->view('usuario/modulo', array('modulo' => $questoes));
        }else{
            $this->load->view('usuario/show_modulo', array('modulo' => $questoes));
        }
        
        $this->load->view('estrutura/footer');
    }

    public function finalizarModulo(){
        if($this->app_model->finalizarModulo($_POST['respostas'])){
            echo true;
        }else{
            echo false;
        }
    }

    public function iniciando(){
        $this->app_model->iniciarTrilha(1);

        $this->load->view('estrutura/header');
        $this->load->view('usuario/iniciando');
        $this->load->view('estrutura/footer');
    }

    public function iniciando_2(){
        $this->load->view('estrutura/header');
        $this->load->view('usuario/iniciando_2');
        $this->load->view('estrutura/footer');
    }
}
