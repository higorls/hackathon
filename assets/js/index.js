$(document).ready(function(){
   //executa a função de validação de sessao
   //validaMobile()
   //botao de login do cabeçalho
   $('#login-nav').click(function(){
      $('#modal-login').modal({backdrop: 'static', keyboard: false})
      $('#erro-login').text('')
      $('#usuario-input').val('')
      $('#senha-input').val('')
   })

   //botao de logoff do cabecalho
   $('#logoff-nav').click(function(){
      $.ajax({
         url: base_url+"/home/fazerLogoff",
         type: "POST",
         success: function(){  
            validaSessao() 

            $('#modal-login').modal({backdrop: 'static', keyboard: false})
            $('#erro-login').text('')
            $('#usuario-input').val('')
            $('#senha-input').val('')
         },
         error: function(){
            console.log("erro")
         }
      })
   })

   //botao de entrar do modal de login
   $("#btn-entrar").click(function(){
      let usuario = $('#usuario-input').val()
      let senha = $('#senha-input').val()

      if(usuario && senha){
         $.ajax({
            url: base_url+"login/fazerLogin",
            type: "POST",
            data:{usuario,senha},
            success: function(result){               
               if(result){
                  window.location.href = base_url+'home/app'
               }else{
                  $('#erro-login').css("padding-left","3%")
                  $('#erro-login').text('Usuário ou senha incorretos.')
               }
            },
            error: function(e){
               console.log(e)
            }
         })
         console.log(base_url+"login")
      }
   })

   //click no botao de next da criação de usuario
   $("#btn-next").click(function(){
      var input = $("input:visible").attr("name")
      if($("input:visible").val() == ""){
         $('#erro-login').text('Preencha o(s) campo(s) para prosseguir.')
      }else{
         $('#erro-login').text("")
         if(input == "usu_nome"){
            $(".new-nome").hide();
            $(".new-idade").show();
            $(".new-desc").text("Qual é a sua idade?")
         }else if(input == "usu_idade"){
            $(".new-idade").hide();
            $(".new-endereco").show();
            $(".new-desc").text("Onde você mora?")
         }else if(input == "usu_cidade"){
            $(".new-endereco").hide();
            $(".new-email").show();
            $(".new-desc").text("Qual é o seu e-mail?")
         }else if(input == "usu_email"){
            $(".new-email").hide();
            $(".new-senha").show();
            $(".new-desc").text("Digite uma senha")
         }else{
            var usu_nome = $("input[name='usu_nome']").val()
            var usu_idade = $("input[name='usu_idade']").val()
            var usu_estado = $("select[name='usu_estado']").val()
            var usu_cidade = $("input[name='usu_cidade']").val()
            var usu_email = $("input[name='usu_email']").val()
            var usu_senha = $("input[name='usu_senha']").val()

            $.ajax({
               url: base_url+"login/novoUsuario",
               type: "POST",
               data:{usu_nome,usu_idade,usu_estado,usu_cidade,usu_email,usu_senha},
               success: function(result){               
                  if(result){
                     window.location.href = base_url+'login'
                  }else{
                     $('#erro-login').text('Ocorreu um erro no cadastro.')
                  }
               },
               error: function(e){
                  console.log(e)
               }
            })
         }
      }
   })

   $("input:radio[name='opcao']").change(function(){
      if ($(this).val() == 1) {
         $(".content-text-1").show();
         $(".content-text-2").hide();
         $(".content-text-3").hide();         
      }else if ($(this).val() == 2) {
         $(".content-text-1").hide();
         $(".content-text-2").show();
         $(".content-text-3").hide();
      }else if ($(this).val() == 3) {
         $(".content-text-1").hide();
         $(".content-text-2").hide();
         $(".content-text-3").show();
       }
   })

   $("#btnIniciar").click(function(){
      window.location.href = base_url+'app/iniciando'
   })

   $('.accordion').click(function(){
      this.classList.toggle("active");

      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
         panel.style.display = "none";
      } else {
         panel.style.display = "block";
      }
   })


})
//função de validação de sessao
function validaSessao(){
   $.ajax({
      url: base_url+"/home/validarSessao",
      type: "POST",
      data:{valida:"true"},
      success: function(result){
         result = JSON.parse(result) 

         //caso seja uma sessao valida
         if(result[0]){               
            $('#pagina').html(result[1])
            $('#modal-login').modal('hide')
            $('#login-nav').hide()
            $('#logoff-nav').show()

            carregarGrid(result[2])            
         }else{
            $('#pagina').html(result[1])
            $('#login-nav').show()
            $('#logoff-nav').hide()
            $('#modal-login').modal({backdrop: 'static', keyboard: false})
         }
      },
      error: function(){
         console.log("erro")
      }
   })  
}
//função que carrega a grid de estados
function carregarGrid(dados){
   $("#tb_estados").DataTable({
      autoWidth: false,
      searching: false,
      language: {
         info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      },
      order: false,
      scrollY: '80vh',
      scrollCollapse: true,
      paging: false,
      responsive: 1,
      data: dados, 
      bLengthChange: false,
      keys: true,
      columns: [
         { data: "estado",title: "Estado", width: 150, orderable: false},
         { data: "capital", title: "Capital", width: 150, orderable: false },
         { data: "uf", title: "UF", width: 40, orderable: false }
      ]    
   
   })
}
function validaMobile(){
   if ((screen.width > 640 || screen.height > 1000) && window.location.href != base_url+'home/support') {
      window.location.href = base_url+'home/support'
  }
}