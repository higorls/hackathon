<?php
   defined('BASEPATH') OR exit('URL inválida.');

   $fazer_login = isset($login) && $login === true ? $login : false;
?>
<div class = "form-container">
<a href="<?php echo base_url('home') ?>" id="voltarHome"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
  <div class = "form">
    <h3>Digite seus dados</h3>
    <input id="usuario-input" type="text" class="input-text" placeholder="E-mail">
    <input id="senha-input" type="password" class="input-text"  placeholder="Senha">
    <a href="#" style="color:black;margin-left:35px">Esqueci minha senha</a>
    <span id ="erro-login" style="color:red;"></span>
    <input type="button" id ="btn-entrar" class="btn-login" value="Entrar">
  </div>
</div>