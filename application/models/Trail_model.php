<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Trail_model extends CI_Model{
    
        public function getAvaibleTrails($usu_cod){            
            //recolhendo as trilhas sugeridas
            $trilhas_sugeridas = $this->sugestTrail($usu_cod);

            //recolhendo todas as trilhas
            $sql = "SELECT * FROM trilhas";
            $trilhas = $this->db->query($sql)->result_array();

            if(count($trilhas_sugeridas) > 0){
                foreach($trilhas as $key => $value){
                    foreach($trilhas_sugeridas as $key2 => $value2){
                        if($value['tri_cod'] == $value2['tri_cod']){
                            unset($trilhas[$key]);
                        }
                    }
                }
            }

            foreach($trilhas as $key => $value){
                if($value['tri_cod'] == 1){
                    return array($trilhas[$key]);
                }
            }

            return $trilhas;
        }

        public function sugestTrail($usu_cod){
            $usu_info = (array) json_decode($this->db->select('usu_info')
                                             ->from('usuarios')
                                             ->where('usu_cod',$usu_cod)
                                             ->get()
                                             ->result_array()[0]['usu_info']);

            //recolhendo info do usuario
            $sql = "SELECT * FROM usuario_informacoes WHERE usi_usu_cod =". $usu_cod;
            $usuario_informacoes = $this->db->query($sql)->result_array()[0];
            $usuario_informacoes = (array) json_decode($usuario_informacoes['usi_info']);

            if(!in_array(1,$usuario_informacoes["trilhas_finalizadas"])){
                //recolhendo as trilhas
                $sql = "SELECT * FROM trilhas WHERE tri_cod = 1";
                return $this->db->query($sql)->result_array();
            }

            //recolhendo as trilhas
            $sql = "SELECT * FROM trilhas WHERE tri_cod > 1";
            $trilhas = $this->db->query($sql)->result_array();            

            //removendo trilhas finalizadas
            foreach($trilhas as $key => $value){
                if(in_array($value['tri_cod'],$usuario_informacoes['trilhas_finalizadas'])){
                    unset($trilhas[$key]);
                }
            }

            //comparando afinidade
            $afinidade = array();
            $max = max($usu_info);
            $max_key = array_search ($max,$usu_info);
            $especialidade = 0;
            switch($max_key){
                case "B":
                    $especialidade = 1;
                break;
                case "T":
                    $especialidade = 2;
                break;
                case "C":
                    $especialidade = 3;
                break;
                case "RH":
                    $especialidade = 4;
                break;
            }
            foreach($trilhas as $key => $value){
                if($value['tri_esp_cod'] == $especialidade && count($afinidade) < 2){
                    array_push($afinidade,$trilhas[$key]);
                }
            }

            unset($usu_info[$max_key]);
            $max = max($usu_info);
            $max_key = array_search ($max,$usu_info);
            $especialidade = 0;
            switch($max_key){
                case "B":
                    $especialidade = 1;
                break;
                case "T":
                    $especialidade = 2;
                break;
                case "C":
                    $especialidade = 3;
                break;
                case "RH":
                    $especialidade = 4;
                break;
            }
            foreach($trilhas as $key => $value){
                if($value['tri_esp_cod'] == $especialidade && count($afinidade) == 2){
                    array_push($afinidade,$trilhas[$key]);
                }
            }

            return $afinidade;
        }
    
    }
?>