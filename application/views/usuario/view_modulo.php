<?php 

//echo json_encode($modulo, JSON_UNESCAPED_UNICODE);
$img = json_decode($modulo['mod_intro'])->img;
$text1 =json_decode($modulo['mod_intro'])->texto1;
$text2 =json_decode($modulo['mod_intro'])->texto2;
?>
<div class ="blank-container">
    <div class = "blank_img">
        <img src="<?php echo base_url('assets/img/modulos/'.$img)?>" alt="APPRENDE">
    </div>
    <div  class="blank-body">
        <h4><b><?php echo $modulo['mod_nome'] ?></b></h4>
        <?php echo $text1??""; ?><br><br>
        <?php echo $text2??""; ?>

        <br><br><input type="button" class ="btn-mod-ini" value="Demoro!" onclick="window.location.href = base_url+'app/iniciarModulo/<?php echo $modulo['mod_cod'];?>';">
    </div>
    
</div>