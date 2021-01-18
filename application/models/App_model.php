<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class App_model extends CI_Model{
    
        public function iniciarTrilha($tri_cod){            
            //recolhendo info do usuario
            $sql = "SELECT * FROM usuario_informacoes WHERE usi_usu_cod =". $this->session->usuario['usu_cod'];
            $usuario_informacoes_all = $this->db->query($sql)->result_array()[0];
            $usuario_informacoes = (array) json_decode($usuario_informacoes_all['usi_info']);

            if(!in_array($tri_cod,$usuario_informacoes['trilhas_finalizadas'])){
                array_push($usuario_informacoes['trilhas_iniciadas'],$tri_cod);

                $this->db->replace('usuario_informacoes',array(
                    'usi_cod' => $usuario_informacoes_all['usi_cod'],
                    'usi_info' => json_encode($usuario_informacoes), 
                    'usi_usu_cod' => $this->session->usuario['usu_cod']));            
            }

            $sql = "SELECT * FROM modulos WHERE mod_tri_cod =". $tri_cod;
            $modulos = $this->db->query($sql)->result_array();

            foreach($modulos as $key => $value){
                $modulos[$key]['mod_passos'] = (array) json_decode($value['mod_passos']);
            }
            
            return array('modulos' => $modulos, 'usu_info' => $usuario_informacoes);
        }

        public function iniciarModulo($mod_cod){
            //recolhendo as questoes
            $sql = "SELECT * FROM modulos WHERE mod_cod =".$mod_cod;
            $questoes = $this->db->query($sql)->result_array()[0];
            $questoes['mod_passos'] = (array) json_decode($questoes['mod_passos']);

            return $questoes;
        }

        public function finalizarModulo($data){
            if(isset($data['modulo'])){
                $sql = "SELECT * FROM usuario_informacoes WHERE usi_usu_cod =". $this->session->usuario['usu_cod'];
                $usuario_informacoes_all = $this->db->query($sql)->result_array()[0];
                $usuario_informacoes = (array) json_decode($usuario_informacoes_all['usi_info']);

                array_push($usuario_informacoes['modulos_finalizados'],$data['modulo']);

                $this->db->replace('usuario_informacoes',array(
                    'usi_cod' => $usuario_informacoes_all['usi_cod'],
                    'usi_info' => json_encode($usuario_informacoes), 
                    'usi_usu_cod' => $this->session->usuario['usu_cod']));
                
                $modulo = array(
                    "umo_usu_cod" => $this->session->usuario['usu_cod'],
                    "umo_mod_cod" => $data['modulo'],
                    "umo_info" => json_encode($data['respostas'])
                );
                $this->db->insert('usuario_modulos', $modulo);
                
                $this->finalizaTrilha($data['modulo']);

                if($data['modulo'] == 1){
                    $valores =array(
                        "B" => 0,
                        "T" => 0,
                        "C" => 0,
                        "RH" => 0
                    );

                    foreach($data['respostas'] as $key => $value){
                        $indice = explode(',',$value['resposta']);
                        foreach($indice as $value){
                            $valores[$value]++;
                        }
                    }
                    $_SESSION['usuario']['usu_info'] = json_encode($valores);
                    $data = $_SESSION['usuario'];
                    unset($data['logado']);
                    $this->db->replace('usuarios',$data);
                }

                return true;            
            }else{
                return $data;
            }
        }

        public function finalizaTrilha($mod_cod){
            $sql = "
                SELECT 
                    A.mod_cod,
                    A.mod_tri_cod
                FROM modulos A
                JOIN modulos B on B.mod_tri_cod = A.mod_tri_cod 
                WHERE 
                    B.mod_cod =".$mod_cod;
            $modulos = $this->db->query($sql)->result_array();
            $tri_cod = $modulos[0]['mod_tri_cod'];

            $sql = "SELECT * FROM usuario_informacoes WHERE usi_usu_cod =". $this->session->usuario['usu_cod'];
            $usuario_informacoes_all = $this->db->query($sql)->result_array()[0];
            $usuario_informacoes = (array) json_decode($usuario_informacoes_all['usi_info']);

            foreach($modulos as $key => $value){
                if(in_array($value['mod_cod'], $usuario_informacoes['modulos_finalizados'])){
                    unset($modulos[$key]);
                }
            }

            if(count($modulos) == 0){
                array_push($usuario_informacoes['trilhas_finalizadas'],$tri_cod);

                $this->db->replace('usuario_informacoes',array(
                    'usi_cod' => $usuario_informacoes_all['usi_cod'],
                    'usi_info' => json_encode($usuario_informacoes), 
                    'usi_usu_cod' => $this->session->usuario['usu_cod']));
            }
        } 

        public function getModulos($data){            
            foreach($data as $key => $value){
                $sql = "SELECT * FROM modulos WHERE mod_tri_cod =".$value['tri_cod'];
                $modulos = $this->db->query($sql)->result_array();

                $data[$key]['modulos'] = $modulos;
            }
            
            return $data;
        }

        public function getUsu_info($usu_cod){
            $sql = "SELECT * FROM usuario_informacoes WHERE usi_usu_cod =". $this->session->usuario['usu_cod'];
            $usuario_informacoes_all = $this->db->query($sql)->result_array()[0];
            $usuario_informacoes = (array) json_decode($usuario_informacoes_all['usi_info']);

            return $usuario_informacoes;
        }
    }
?>