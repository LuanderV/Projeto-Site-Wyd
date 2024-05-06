<?php
session_start();
if (!isset($_SESSION['emailOuUsuario'])) {
    // Se o usuário não estiver logado, redirecione-o para a página de login
    header("Location: Entrar.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <style type="text/css">
        #user {
            position:absolute;
            left:430px;
            top:293px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #equipe {
            position:absolute;
            left:127px;
            top:46px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #locker {
            position:absolute;
            left:429px;
            top:315px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #locker2 {
            position:absolute;
            left:429px;
            top:337px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #contato {
            position:absolute;
            left:120px;
            top:39px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #guilds {
            position:absolute;
            left:120px;
            top:37px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #gmark {
            position:absolute;
            left:119px;
            top:37px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #down {
            position:absolute;
            left:119px;
            top:37px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #dnt {
            position:absolute;
            left:126px;
            top:50px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <style type="text/css">
        #lista {
            position:absolute;
            left:115px;
            top:37px;
            margin-left:-110px;
            margin-top:-40px;
        }
    </style>

    <title>WYD 2.0 - Trocar Senha</title>
    <meta name="description" content="Um jogo aluscinante em mundo aberto. Totalmente grátis no estilo MMO"/>
    <meta name="keywords" content="WYD">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/rs3/font_fallback-0.css" type="text/css" media="all" />
    <![endif]-->
    <!--[if gt IE 8]><!--><!-- x -->
        <link rel="stylesheet" href="css/rs3/font_base64-0.css" type="text/css" media="all" />
    <!--<![endif]-->

    <!-- alert -->
    <link rel="stylesheet" type="text/css" href="lib/sweet-alert.css">

    <link href="prod/css/main-12.css" rel="stylesheet" />
    <link rel="shortcut icon" href="img/global/favicon.ico">
    <script src="../ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src='js/rs3/recaptcha.js'></script>
    <script src='js/rs3/functions.js'></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- alert -->
    <script src="lib/sweet-alert.min.js"></script>

</head>

<body id="support" class="support en">

<Script Language="JavaScript1.2">
<!--
    if (document.all)
    document.body.onmousedown=new Function("if (event.button==2||event.button==3)alert('Ops! Você não pode usar o botão direito.')");
// -->
</SCRIPT>

<div class="stickyWrap">

    <header class="header" role="banner">
		<div class="header__bg">
			<div class="header__container">
			<div class="header-second">
			<div class="header-table">
			<a class="header-second__logo" href="index.html" >
				<img class="header-second__logo-image" src="img/rs3/global/header_logo.png" title="Wyd MoW" alt="Wyd MoW" />
			</a>
			<nav class="main-nav" id="main-nav">
				
			<ul class="main-nav__list">
				<li class="main-nav__item main-nav__item--news">
					<a class="main-nav__heading" href="index.html">Home</a>
				</li>
				<li class="main-nav__item main-nav__item--group main-nav__item--game">
					
				<a href="#!" class="main-nav__heading">Tutoriais<span class="main-nav__expander"></span></a>
				<ul class="main-nav__group">
					
					<li class="main-nav__group-item"><a  class="main-nav__group-item-link" href="Tutarch.html">Destravando Leveis ARCH</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link"  href="Tutcele.html">Destravando Leveis CELE</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link"  href="Capacele.html">Refinando Capa CELE</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link"  href="Ref10.html">Refinando Itens +10</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link"  href="Ref15.html">Refinando Itens +12 à +15</a></li>
				</ul>
				<li class="main-nav__item main-nav__item--group main-nav__item--community">
				<a href="#!" class="main-nav__heading">Comunidade<span class="main-nav__expander"></span></a>
				<ul class="main-nav__group">
					<li class="main-nav__group-item"><a class="main-nav__group-item-link" href="Download.html"align="center"><img src="img\rs3\iconesmenu\ideal.png" width="50" height="50" id="down">Downloads</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link" href="Cadastro.html"align="center"><img src="img\rs3\iconesmenu\perga.png" width="50" height="50" id="contato"></img>Cadastro</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link" href="TrocarSenha.html"align="center"><img src="img\rs3\iconesmenu\perga.png" width="50" height="50" id="contato"></img>Trocar Senha</a></li>
					<li onClick="alert('Em breve!')" class="main-nav__group-item"><a class="main-nav__group-item-link" href="#!" align="center"><img src="img\rs3\iconesmenu\cyth.png" width="50" height="50" id="guilds"></img>Guilds</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link" href="EnviarGuildMark.html"align="center"><img src="img\rs3\iconesmenu\pesa.png" width="50" height="50" id="gmark"></img>Guild Mark</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link" href="Equipe.html"align="center"><img src="img\rs3\iconesmenu\shield.png" width="33" height="33" id="equipe"></img>Equipe</a></li>
				</ul>
				</li>
				<li class="main-nav__item main-nav__item--group main-nav__item--game">
				<a href="#!" class="main-nav__heading">Guias<span class="main-nav__expander"></span></a>
				<ul class="main-nav__group">
					<li class="main-nav__group-item"><a  class="main-nav__group-item-link" href="Up.html" align="center"><img src="img\rs3\iconesmenu\carta.png" width="30" height="30" id="up">Como/Onde upar?</a></li>
	
				</ul>
				<li class="main-nav__item main-nav__item--group main-nav__item--shop">
				<a href="#!" class="main-nav__heading">Shop<span class="main-nav__expander" align="center"></span></a>
				<ul class="main-nav__group">
					<li class="main-nav__group-item"><a class="main-nav__group-item-link" href="Doacao.html"align="center"><img src="img\rs3\iconesmenu\gold.png" width="28" height="28" id="dnt"> Fazer Doação</a></li>
					<li class="main-nav__group-item"><a class="main-nav__group-item-link" href="Lista.html"align="center"><img src="img\rs3\iconesmenu\bau.png" width="50" height="50" id="lista"></img>Lista de Itens</a></li>
					</ul>
				</li>
				
				<style>	 
				
					#playfundo {
						text-align: center;
						padding: 14px;
						background-image: linear-gradient(to bottom, rgb(255, 165, 0), rgb(255, 87, 34), rgb(51, 0, 0));
						border-top:1px solid #ffea83c5;
						border-bottom:1px solid #272625;
						box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
					}
	
					#playfundo:hover {
						background-image: linear-gradient(to bottom, rgba(255, 166, 0, 0.80), rgba(255, 86, 34, 0.80),rgba(51, 0, 0, 0.80));
						box-shadow: inset 2px 2px 10px rgba(1, 1, 1, 1);
						border-top: 1px solid #5c5329d0;
					}
	
					#playtexto {
						font-family: 'Times New Roman', Times, serif;
						color: black;
						font-size: 30px;
					}
	
					#playtexto:hover {
						color: white;
					}
	
					#playfundo:after {
					border-color: transparent transparent transparent black;
					border-style: solid;
					border-width: 5px 8px;
					content: '';
					right: 1%;
					position: absolute;
					top: 41%;
					}
	
					#playfundo:after:hover {
						color: white;
					}
					
			
				</style>
	
				<li id="playfundo">
					<a id="playtexto" href="Entrar.html">LOGIN</a>
				</li>
	
			</ul>
			
			</nav>
			
			
			
			</div>
			
			</div>
			
			</div>
			
		</div>
	</header>
<div class="banner">
<div class="inner">
    <img src="img/rs3/banners/generic.jpg"/>
</div>
</div>
<div class="contents">
<div class="main">
<h1 class="title"><span>Trocar senha</span></h1>
<ul class="breadcrumb" itemprop="breadcrumb">
<li><a href="index.html">Início</a></li>
<li><a href="">Comunidade</a></li>
<li>Trocar Senha</li>
</ul>
<section class="suppLandingSection">
<h2><span>Preencha os campos para</span>trocar sua senha</h2>
</section>

<p>&nbsp;</p>
<p>&nbsp;</p>

<div>
<center><form id="form1" name="form1" method="post" action="passch.php" >
  <table width="483" border="0">
   <tr>
     <td width="105" class="style6">Login : <img src="img\rs3\user.png" width="20" height="20" id="user"></td>
     <td width="222"><input name="userid" type="text" id="userid" maxlength="12" size="35" /></td>
     <td width="142">&nbsp;</td>
   </tr>
  <tr>
  
    <td class="style6">Senha atual: <img src="img\rs3\lock.png" width="20" height="20" id="locker"></td>
    <td> <input name="password" type="password" maxlength="12" id="password" size="35"/></td>
    <td><table id="mostra"></table></td>
  </tr>
  
	<tr>
		<td class="style6">Nova senha : <img src="img\rs3\lock.png" width="20" height="20" id="locker2"></td>
		<td> <input name="newpass" type="password" id="newpass" size="35"/></td>
		<td><table id="mostra"></table></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 10px;">
			<p style="font-size: 12px; color: #ffffff88; text-align: center; padding-bottom: 10px;">Sua senha deve conter entre 6 e 10 caracteres incluindo pelo menos 1 número, 1 letra minúscula, 1 letra maiúscula e 1 caractere especial.</p>
		</td>
	</tr>
  
    <tr>
      <td class="style6">Pergunta secreta:</td>
      <td><input name="pergunta" type="text" id="pergunta" size="35"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="style6">Resposta secreta:</td>
      <td><input name="resposta" type="text" id="resposta" size="35"></td>
      <td>&nbsp;</td>
    </tr>
  
    <tr>
      <td height="32" class="style6">&nbsp;</td>

       <td><br><div align="center">
        <div class="g-recaptcha" data-sitekey="6Legzx4TAAAAACdR3dfe0Qwvzgz5liw299pIaTuf"></div>
      <input name="Submit2" value="Confimar" type="submit" />
        <input type="reset" name="Cancelar" id="button" value="Limpar" />

        


        </div></td>
      <td></td>
    </tr>
</table>
</form></center>

<section class="suppLandingSection">
<h2 class="serviceStatusTitle">Atenção!</h2>
<ul>

<li><span>ADMINS e GMs <strong>nunca pedirão sua senha</strong>. Se você for furtado por conta de inocência, é de <strong>sua total responsabilidade</strong> e não iremos fazer nada!</span></li>
</ul>
</section>
</div>
</div>
</div>
<footer class="footer" role="contentinfo">
<div class="footer__inner">
<p class="footer__paragraph">Direitos reservados à <strong>RafsF.</strong>
<br></a> &copy; 2015 - 2016 WYD 2.0<br>
<div id="classificacao"><img src="img/rs3/classificacao.png"></img></div>
<div id="persofooter"><a class="header-second__rollforte"><img src="img/rs3/imgsoldado/perso.png"></img></a></div>

</div>
</footer></body>



</html>
