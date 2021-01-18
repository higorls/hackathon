
<?php
$teste = array(
    array(
        'titulo' => "O que eu preciso fazer? Aprendendo a listar as tarefas",
        'conteudo' => array(
            0 => "Sabe quando você lembra de realizar uma tarefa somente próximo do momento da entrega? Ou quando você tá deitado no sofá e sua mãe/pai te lembra que você tinha prometido dar banho no doguinho?/n Então, uma das atividades básicas da administração do tempo é a criação de listas das atividades que você precisa fazer. /n Dica: Tente sempre dividir atividades maiores em atividades menores, por exemplo:",
            1 => "img:EXERCICIO_ILUSTRADO.png",
            2 => "Assim, você sabe exatamente o que precisa fazer e a atividade não demora aquele tempão para ser marcada como feita./n Curiosidade: Você sabia que a música pode ajudar a gente a focar na hora de fazer uma atividade? Aqui vai uma sugestão de música que tem tudo a ver com tempo: Oração ao tempo – Caetano Veloso https://www.youtube.com/watch?v=HQap2igIhxA"
        )
    ),
    array(
        'titulo' => "Priorização",
        'conteudo' => array(
            0 => "Tá, já fiz a minha lista de tarefas e ela ficou enorme, socorro!! Como eu decido o que devo fazer primeiro?/n Essa parte de definir qual atividade fazer primeiro é chamada de priorização. Essa etapa é  muito pessoal de cada pessoa, que define o que vai ser feito primeiro de acordo com o que é mais importante para ela, como por exemplo: /n * Data de entrega da atividade /n * Duração da atividade /n *  Importância",
            1 => "Exemplo: /n Maria tem que entregar todas as atividades da listinha na data de entrega, para definir  qual atividade deve ser feita primeiro, ela organizou a lista da data menor para a maior.",
            2 => "* Varrer meu quarto -  entrega: dia 08 /n * Estudar sobre mitocôndrias - entrega: dia 06 /n * Resolver exercício de matemática - entrega: dia 05 /n  Resolver exercício de matemática - entrega: dia 05 /n * Estudar sobre mitocôndrias - entrega: dia 06 /n * Varrer meu quarto - entrega: dia 08",
            3=> "A coluna da esquerda mostra a lista original, na coluna da direita as atividades já estão organizadas e na ordem em que deverão ser feitas.",
            3=> "Curiosidade: Já parou para pensar que o tempo é algo tão complexo, que desenvolvemos ferramentas de como aproveitar melhor? Doido, né? Aqui tá uma sugestão de um vídeo do Filósofo Mario Sergio Cortella, com reflexões sobre o tempo e a vida https://www.youtube.com/watch?v=Ek2LmQ5d6Jo&t=350s"
        )
    ),array(
        'titulo' => "Ferramentas",
        'conteudo' => array(
            0 => "Você sabia que existem diversas ferramentas que nos auxiliam na organização do tempo? Você pode listar suas tarefas num caderninho, no bloco de notas do celular e/ou computador, em uma lousa pendurada no seu quarto, nos post it colados na parede, e até em arquivos digitais no seu computador como planilhas e documentos.",
            1 => "Dica 1: Sempre lembre de listar suas atividades, caso seu caderno não esteja por perto, lembre-se de anotar num papel (ou na mão) e depois transferir para sua lista oficial, isso ajuda a não esquecer nadinha.",
            2 => "Dica 2: Não esqueça de reservar um tempinho no seu dia e semana para atualizar a sua lista de tarefas com as atividades novas e as já realizadas. Aaah, não se esqueça de sempre anotar as datas que devem estar prontas e definir qual a prioridade de cada uma delas.",
            3=> "Dica 3: Caso você goste de usar o celular e/ou o computador para se organizar, existem também vários sites e aplicativos que são ótimas ferramentas para organização do tempo como Evernote, Trello, Asana e muitos outros.",
            3=> "Curiosidade: Sabia que existem diversas técnicas que ajudam a gente na gestão do tempo? A técnica pomodoro é uma delas, que além de ajudar na gestão do tempo, ajuda também a manter o foco nas atividades. Saiba mais em Técnica Pomodoro on-line: https://tomato-timer.com/"
        )
    ),array(
        'titulo' => "Teste",
        'conteudo' => array(
            0 => "Pergunta 1",
            1 => "Luciano ficou responsável de organizar o teatro da escola, como você acha que ele poderia dividir as tarefas? Liste 3 tarefas principais.",
            2=> "input:text",
            3 => "input:text",
            4=> "input:text"
        )
    ),array(
        'titulo' => "Teste",
        'conteudo' => array(
            0 => "Pergunta 2",
            1 => "No domingo Catarina listou todas as atividades que ela precisa fazer nas próximas duas semanas, agora ela precisa definir qual atividade vai fazer primeiro de acordo com a data de entrega. Vamos ajudá-la? Coloque como 1 a atividade que tem que ser feita primeiro, 2 a que deve ser realizada depois e assim por diante.",
            2 => "input:radio:Atividade:Resenha de literatura - Livro Sobrevivendo no Inferno /n Dia da entrega: 01",
            3 => "input:radio:Atividade:Comprar materiais do projeto da feira de ciências - Vulcão /n Dia da entrega: 08",
            4 => "input:radio:Atividade:Estudar para a prova de matemática - Geometria /n Dia da entrega: 06",
            5 => "input:radio:Atividade:Estudar para a prova de história - Ditadura Militar /n Dia da entrega: 10"            
        )
    ),
);
//echo json_encode($teste, JSON_UNESCAPED_UNICODE);
//$modulo['mod_passos'] = (array) json_decode($modulo['mod_passos']);
?>
<div class ="blank-container">
    <div class ="blank_body">
        <div class ="texto">
            <div class ="titulo"></div>
            <div class="conteudo"></div>

        </div>
        <div class ="inputs">
        </div>
        <button class="btn-next" onclick="montarQuestao(modulo['mod_passos'], numero)" style = "position:fixed;bottom:20px;left:0px;"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    </div>
<div>
<script>
    var modulo = '<?php echo json_encode($modulo['mod_passos']);?>'
    console.log(modulo)
    modulo = JSON.parse(modulo);
    var numero = 0;
    var qtde_respostas = 0;
    var respostas = {
        "modulo": <?php echo $modulo['mod_cod'];?>,
        "respostas":[]
    };    
    
    montarQuestao()
    function montarQuestao(questoes = modulo, num = numero){
        var html = ""
        if(num > 0 && $(".input").length > 0){
            valores="";
            for(i=0;i < $(".input").length;i++){
                valores = valores + $(".input").eq(i).val() + ',';
            }
            respostas["respostas"].push({"questao":num,"resposta":valores})
        }
        if(num < questoes.length){            
            $('.titulo').html(questoes[num]['titulo'])
            
            for(i = 0;i < questoes[num]['conteudo'].length;i++){
                if(questoes[num]['conteudo'][i].indexOf("img:") >= 0){
                    html = html +
                        '<div class = "blank_img" style="margin-left:15%">'+
                            '<img src="'+base_url+'assets/img/modulos/'+questoes[num]['conteudo'][i].replace('img:','')+'">'+
                        '</div><br><br>'
                }else if(questoes[num]['conteudo'][i].indexOf("input:text") >= 0){
                    html = html + '<div class = "blank_img" style="margin-left:15%">'+
                            '<input id="input-'+num+'-'+i+'" type="text" class="input-text" style ="margin:0px; margin-top: 1px;">'+
                        '</div><br>'
                }else if(questoes[num]['conteudo'][i].indexOf("input:radio") >= 0){
                    html = html+questoes[num]['conteudo'][i].replaceAll("/n","<br>").replace('input:radio:','')+'<br>'
                    html = html + '<input type="radio" value=1 name="questao1">'+
                                    '<label for="questao1">1</label><br>'+
                                    '<input type="radio" value=2 name="questao2">'+
                                    '<label for="questao2">2</label><br>'+
                                    '<input type="radio" value=3 name="questao3">'+
                                    '<label for="questao3">3</label><br>'+
                                    '<input type="radio" value=4 name="questao4">'+
                                    '<label for="questao4">4</label><br><hr>'
                }else{
                    html = html+questoes[num]['conteudo'][i].replaceAll("/n","<br>")+'<br><br>'
                }         
                
            }
            $('.conteudo').html(html)
            
            numero++
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