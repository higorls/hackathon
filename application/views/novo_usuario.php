<div class = "form-container-create">
<a href="<?php echo base_url('home') ?>" id="voltarHome"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
  <div class = "form">
    <h4 class="new-desc">Qual é seu nome?</h4>
    <input class="new new-nome" name="usu_nome" type="text" class="input-text" placeholder="Nome">
    <input class="new new-idade" name="usu_idade" type="text" class="input-text" placeholder="Idade" style="display:none">
    <select class="new new-endereco" name="usu_estado" style="display:none" >
        <option value="" selected>Estado</option>
        <option value="SP">São Paulo</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="MG">Minas Gerais</option>
    </select>
    <input class="new new-endereco" name="usu_cidade" type="text" class="input-text" placeholder="Cidade" style="display:none">
    <input class="new new-email" name="usu_email" type="text" class="input-text" placeholder="Email" style="display:none">
    <input class="new new-senha" name="usu_senha" type="password" class="input-text" placeholder="Senha" style="display:none">
    <span id ="erro-login" style="color:red;font-size:70%"></span>
    <button class="btn-next" id="btn-next"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
  </div>
</div>