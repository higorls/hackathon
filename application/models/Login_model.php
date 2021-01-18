<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Login_model extends CI_Model{
    
        public function validaUsuario($dados){
            $dados = array_merge(
                array('usu_email' => '',
                      'usu_senha' => '',
                ),$dados
            );
            //sql que retorna o usuario
            $sql = "SELECT * FROM usuarios WHERE usu_email = '".$dados["usu_email"].
            "' AND usu_senha = '".md5($dados["usu_senha"])."'";

            $result = $this->db->query($sql)->result_array();
            
            //caso exista usuario com aquele login e senha, inicia sessao
            if(count($result) > 0){
                //sql que retorna as informacoes do usuario
                $sql = "SELECT * FROM usuario_informacoes WHERE usi_usu_cod = ".$result[0]["usu_cod"];
                $usuario_informacoes = $this->db->query($sql)->result_array();
                if(count($usuario_informacoes) == 0){
                    $dados_usuario_informacoes = array(
                        "usi_usu_cod" => $result[0]["usu_cod"],
                        "usi_info" => json_encode(array(
                            "trilhas_finalizadas" =>array(),
                            "trilhas_iniciadas" => array(),
                            "modulos_finalizados" => array()
                        ))
                    );

                    $this->db->insert('usuario_informacoes', $dados_usuario_informacoes);
                }
                $this->session->set_userdata("usuario",array_merge($result[0],array("logado" => true,)));
                
                return true;
            }else{
                return false;
            }
        } 
        
        public function criarUsuario($dados){
            $dados = array_merge(
                array('usu_nome' => '',
                      'usu_email' => '',
                      'usu_senha' => '',
                      'usu_info' => json_encode(array(
                          "B" => 0,
                          "T" => 0,
                          "C" => 0,
                          "RH" => 0
                      ))
                ), $dados
            );

            //sql que retorna o usuario
            $sql = "SELECT * FROM usuarios WHERE usu_email = '".$dados["usu_email"]."'";
            $result = $this->db->query($sql)->result_array();
            
            //caso exista usuario
            if(count($result) > 0){
                return false;
            }else{
                $dados['usu_senha'] = md5($dados['usu_senha']);
                $this->db->insert('usuarios', $dados);
                
                return true;
            }
        }    
    }
?>