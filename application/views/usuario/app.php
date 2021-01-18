<?php
    $trail_form = array(
        "Negócios" => array("alias" =>"negocios","trilha" =>array()),
        "Tecnologia" => array("alias" =>"tecnologia","trilha" =>array()),
        "Criatividade" => array("alias" =>"criatividade","trilha" =>array()),
        "Relações Humanas" => array("alias" =>"rh","trilha" =>array())
    );

    foreach($trail as $key => $value){
        if($value['tri_esp_cod'] == 1){
            array_push($trail_form["Negócios"]['trilha'],array("trilhas"=>$trail[$key]));
        }elseif($value['tri_esp_cod'] == 2){
            array_push($trail_form["Tecnologia"]['trilha'],array("trilhas"=>$trail[$key]));
        }elseif($value['tri_esp_cod'] == 3){
            array_push($trail_form["Criatividade"]['trilha'],array("trilhas"=>$trail[$key]));
        }elseif($value['tri_esp_cod'] == 4){
            array_push($trail_form["Relações Humanas"]['trilha'],array("trilhas"=>$trail[$key]));
        }
    }
        
?>

<div class = "form-container-text">
    <div class = "header-app">
        <div class = "header-avatar-engine" style="margin-left:75%">
            <img src="<?php echo base_url('assets/img/engine_icon.png')?>" alt="" class="content-text-1">            
        </div>
        <div class = "header-avatar" >
            <img src="<?php echo base_url('assets/img/avatar.png')?>" alt="" class="content-text-1">            
        </div>
    </div>
    <div class="body-app">
        <div class ="body-recomendado">
            <div class ="recomendado-title" style="text-align:center;">
                <b>Essas são as trilhas que mais combinam com seu perfil<b>
            </div>
            <?php 
                foreach($trail_form as $key => $value){
                    if(count($trail_form[$key]['trilha']) > 0){
            ?>
                        <div class ="recomendado-title-2 <?php echo $value['alias']; ?>" style="text-align:center;">
                            <b><?php echo $key; ?><b>
                        </div>
            <?php
                        foreach($value['trilha']  as $key2 => $value2){
                            foreach($value2 as $key3=>$value3){
            ?>                  <div class ="trilha-desc">
                                    <b><?php echo $value3['tri_nome'] ?><b>   
                                </div>
                                <div class="modulos">                        
            <?php
                                foreach($value3['modulos'] as $key4 => $value4){
                                    if(in_array($value4['mod_cod'], $usu_info['modulos_finalizados'])){
                                        $icon = json_decode($value4['mod_img'])->finalizado??'0'.$value4['mod_cod'].'.png';
                                    }else{
                                        $icon = json_decode($value4['mod_img'])->pendente??'0'.$value4['mod_cod'].'_B.png';
                                    }
                                    
            ?>                                    
                                        <div class = "modulos-icon">
                                            <a href="<?php echo base_url('app/viewModulo/'.$value4['mod_cod'])?>">
                                            <img src="<?php echo base_url('assets/img/modulos/'.$icon)?>" alt="" class="content-text-1">
                                            <span style="font-size:80%;color:black;"><b><?php echo $value4['mod_nome'] ?></b></span>
                                            </a>        
                                        </div>                                    
            <?php
                                }
            ?>                  </div><?php
                            }
                        }
                    }
                }
            ?>
            <div class ="recomendado-title-2 mais-trilhas" style="text-align:center;">
                <b>Quero ver mais trilhas<b>
            </div><br>
            
        </div>        
    </div>
    <div class = "footer-app">
        <div class = "footer-icon" style="margin-right: 15%;margin-left:13%;">
            <img src="<?php echo base_url('assets/img/chat_icon.png')?>" alt="" class="content-text-1">            
        </div>
        <div class = "footer-icon" style="margin-right: 15%;">
            <img src="<?php echo base_url('assets/img/arrow-icon.png')?>" alt="" class="content-text-1">            
        </div>
        <div class = "footer-icon" >
            <img src="<?php echo base_url('assets/img/star_icon.png')?>" alt="" class="content-text-1">            
        </div>
    </div>

</div>