modulos disponíveis:
<?php
foreach($data['modulos'] as $key => $value){
    if(in_array($value['mod_cod'], $data['usu_info']['modulos_finalizados'])){
        echo $value['mod_nome'] . ' - finalizado.<br>';
    }else{
?>
<a href="<?php echo base_url('app/iniciarModulo/'.$value['mod_cod']) ?>">
<?php
        echo $value['mod_nome'] . ' - disponivel.<br>';
?>
</a>
<?php
    }
}
?>