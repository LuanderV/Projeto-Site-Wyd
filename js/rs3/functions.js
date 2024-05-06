$(document).ready(function(){
    
    $("#btnCadastrar").click(function(){
    
        validaCadastro();
    
    });

    $("#btnLogin").click(function(){
    
        validaLogin();
    
    });

    $("#btnRecuperar").click(function(){
    
        validaRecuperaSenha();
    
    });

    $("#btnJogar").click(function(){
    
        validaJogo();
    
    });

    $("#btnEncerrar").click(function(){
    
        validaEncerraTicket();
    
    });

    $("#btnCriarTicket").click(function(){
    
        validaCriarTicket();
    
    });

    $("#btnResponder").click(function(){
    
        validaRespondeTicket();
    
    });


    $("#btnResetarSenha").click(function(){
    
        carregaRecuperar();
    
    });

    $("#btnResgatarArma").click(function(){
    
        validaResgatarArma();
    
    });

    $("#btnCupom").click(function(){
    
        validaResgatarCupom();
    
    });

    $("#lnkBRL").click(function(){
    
        loadPayment('BRL');
    
    });

    $("#lnkUSD").click(function(){
    
        loadPayment('USD');
    
    });

    $("#lnkBRLGC").click(function(){
    
        loadPayment('BRLGC');
    
    });

    $("#lnkUSDGC").click(function(){
    
        loadPayment('USDGC');
    
    });

    $("#txtboxToFilter").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
                return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

});

function validaCadastro(){

    if(document.getElementById('usermail').value == "") {
        document.getElementById('usermail').focus(); return false;

    } else if(document.getElementById('username').value == "") {
        document.getElementById('username').focus(); return false;
        
    } else if(document.getElementById('password').value == "") {
        document.getElementById('password').focus(); return false;
        
    } else if(document.getElementById('password2').value == "") {
        document.getElementById('password2').focus(); return false;
        
    } else if(document.getElementById('name').value == "") {
        document.getElementById('name').focus(); return false;
        
    } else {

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", { 
         usermail:      document.getElementById('usermail').value,
         username:      document.getElementById('username').value,
         password:      document.getElementById('password').value,
         password2:     document.getElementById('password2').value,
         name:          document.getElementById('name').value,
         TYPE:          'Cadastro'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); }) 
    }   
}

function validaLogin(){

    if(document.getElementById('usermail').value == "") {
        document.getElementById('usermail').focus(); return false;

    } else if(document.getElementById('password').value == "") {
        document.getElementById('password').focus(); return false;
        
    } else {

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", { 
         usermail:      document.getElementById('usermail').value,
         password:      document.getElementById('password').value,
         TYPE:          'Login'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); }) 
    }   
}

function validaRecuperaSenha(){

    if(document.getElementById('usermail').value == "") {
        document.getElementById('usermail').focus(); return false;

    } else {

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", { 
         usermail:      document.getElementById('usermail').value,
         TYPE:          'RecuperarSenha'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); }) 
    }   
}

function loadPayment(value){

        var envio = $.post("inc/dataPayment.html", { 
        TYPE:       value
    })

    envio.done(function(data) { $("#resultado").html(data); })
        
    envio.fail(function() { alert("Erro na requisição"); })   
}

function loadPaymentGC(value){

        var envio = $.post("inc/dataPayment.html", {
        varGC:      value,
        IsGC:       true,
        TYPE:       'buyGC'
    })

    envio.done(function(data) { $("#resultado").html(data); })
        
    envio.fail(function() { alert("Erro na requisição"); })   
}

function carregaRecuperar () {

        var envio = $.post("inc/dataInput.html", {
        senha:        document.getElementById("recuperar_senha").value,
        rsenha:       document.getElementById("recuperar__senha").value,
        request:      document.getElementById('RequestID').value,
        TYPE:         'AtualizarSenha'

        })

        // Foi enviado com sucesso
        envio.done(function(data) {

            $("#midleHome").html(data);
        })

        // Ocorreu alguma falha no envio, arquivo faltando ou falta de conexão com internet
        envio.fail(function() {

            $("#midleHome").html('Ocorreu algum erro na requisição, verifique sua conexão com a internet.')
        }) 

}

function validaResgatarArma(){

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", { 
         ItemID:      document.getElementById('classType').value,
         TYPE:          'ResgatarArma'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); })   
}

function validaJogo(){

         var envio = $.post("inc/dataInput.html", { 
         Numero:      document.getElementById('txtboxToFilter').value,
         TYPE:          'NumeroSecreto'
    })

        envio.done(function(data) { validaJogoValor(); $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); })   
}

function validaJogoValor(){

         var envio = $.post("inc/dataInput.html", { 
         TYPE:          'NumeroSecretoValor'
    })

        envio.done(function(data) { $("#resultadoValor").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); })   
}

function validaResgatarCupom(){

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", { 
         Capsule:      document.getElementById('txtboxToFilter').value,
         TYPE:          'CupomSecreto'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); })   
}

function validaEncerraTicket(){

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", { 
         TYPE:          'EncerrarTicket'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); })   
}

function validaRespondeTicket(){

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", { 
         Description:      document.getElementById('txtResponder').value,
         TYPE:             'ResponderTicket'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); })   
}

function validaCriarTicket(){

        $("#resultado").html('<img src="img/rs3/loader.gif">');

         var envio = $.post("inc/dataInput.html", {
            TitleID:            document.getElementById('classType').value,
            Description:      document.getElementById('txtResponder').value,
            TYPE:             'CriarTicket'
    })

        envio.done(function(data) { $("#resultado").html(data); })
        
        envio.fail(function() { alert("Erro na requisição"); })   
}