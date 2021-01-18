
<div class ="modulo-container">
    <div class ="modulo-wrap">
        <div class ="questao">

        </div>
        <div class ="alternativas">
        </div>
        <button class="btn-next" onclick="montarQuestao(modulo['mod_passos'], numero)" style = "position:fixed;bottom:50px;left:0px;"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    </div>
<div>
<script>
    var modulo = '<?php echo json_encode($modulo);?>'
    modulo = JSON.parse(modulo);
    var numero = 0;
    var qtde_respostas = 0;
    var respostas = {
        "modulo": modulo['mod_cod'],
        "respostas":[]
    };    
    
    montarQuestao()
    function montarQuestao(questoes = modulo['mod_passos'], num = numero){
        var html = ""
        if(num > 0){
            alternativas = $("input.alternativa:checked").val();

            respostas["respostas"].push({"questao":num,"resposta":alternativas})
        }
        if(num < questoes.length){
            qtde_respostas = questoes[num]['selecao']
            
            $('.questao').html(questoes[num]['questao'])
            
            for(i = 0;i < questoes[num]['respostas'].length;i++){                
                html = html + 
                    '<input class ="alternativa" type="checkbox" name="opcao" id="alternativa-'+num + '-'+(i+1)+'" value="'+questoes[num]['respostas'][i]['valor']+'">' +  
                    '<label for="alternativa-'+num + '-'+(i+1)+'" class="filter-label" id="label-alternativa-'+num + '-'+(i+1)+'">'+questoes[num]['respostas'][i]['texto']+'</label>'                  
            }
            $('.alternativas').html(html)
            
            numero++
            vetificaQtde()
        }else{
            $.ajax({
            url: base_url+"app/finalizarModulo",
            type: "POST",
            data:{respostas},
            success: function(result){               
               if(result){
                   if(modulo['mod_cod'] == 1){
                        window.location.href = base_url+'app/iniciando_2'
                   }else{
                        window.location.href = base_url+'app'
                   }
               }else{
                  alert("erro");
               }
            },
            error: function(e){
               console.log(e)
            }
         })
        }
    }
    function vetificaQtde(){
        $("input.alternativa").change(function(){
            if($(this).siblings(':checked').length >= qtde_respostas){
                this.checked = false; 
            }
        })
    }
    
        
        
</script>