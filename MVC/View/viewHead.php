<?php 
	//PÁGINA ONDE TEM TODAS AS INFORMAÇÕES DO CABEÇALHO DE CA
	//PÁGINA DO SISTEMA
	//QUALQUER ALTERAÇÃO NO CABEÇALHO, DEVE SER FEITA AQUI,
	//POIS IRÁ SER ALTERADO EM TODAS AS PÁGINAS

	session_start();

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	
	include_once("../Model/modelBancoDeDados.php");
	include_once("../Model/modelNotificacao.php");
	include_once("../Model/modelNotificacaoAtiva.php");	
	include_once("../Model/modelContadorNotificacaoAtiva.php");	

	//SE UM USUARIO QUE NÃO FEZ O LOGIN TENTAR ENTRAR DIRETAMENTE
	//NESSA PÁGINA, ESSA CONDIÇÃO IRÁ RETORNAR ELE PARA A TELA
	//DE LOGIN
	if(empty($_SESSION['login'])){
		echo "<script>document.location = '../../index.php'</script>";
	}	
?>

<!DOCTYPE html>

<html lang="pt-BR">

	<head>
		<title>Sistema Calendário</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="../../js/main.js"></script>	
		<link href="../../css/fontawesome.min.css" rel="stylesheet">
		<link href="../../css/all.css" rel="stylesheet">
		<link href="../../css/style-pa.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
 		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</head>

	<body>		

		<header>
			<?php 
				//if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){

				//REMOVI AQUI PARA QUE NÃO SÓ OS USUÁRIOS MASTER E ADM VEJAM 
				//AS NOTIFICAÇÕES, MAS TAMBÉM OS CLIENTES
			?>

			<!-- DIV QUE CONTEM A BARRA SUPERIOR, ONDE FICA O SINO
				COM AS NOTIFICAÇÕES -->
			<div class="nav-superior">	
				<img src="../../images/logoiSeven2.png">			
				<div class="img-sino">
					<div style="position: relative;top: 10px; right: 50px; display: flex">
						<span>OLÁ <?php echo strtoupper($_SESSION['login'])?></span>
						<?php if($_SESSION['imagem-usuario'] != null){?>
							<div class="imagem-perfil-usuario-nav" style="background-image: url('<?php echo $_SESSION['imagem-usuario']?>')"></div>
							
						<?php }else{?>
							<img style="border-radius: 50%; position: relative; top: -10px; left: 5px" src="../../images/profile.png">
						<?php }?>
					</div>
					<img src="../../images/sino.png" onclick="abrirNotificacao()">
					<!-- ESSA CONDIÇÃO MOSTRA TODAS AS NOTIFICAÇÕES
						QUE AINDA NÃO FORAM VISTAS -->
					<?php if(count($totalContadorNotificacaoAtiva) != 0){?>
					
					<div class="aviso-notificacao" onclick="abrirNotificacao()"><h4><?php echo count($totalContadorNotificacaoAtiva)?></h4></div>

					<?php }?>

					<!-- ESSA DIV SERÁ PARA MOSTRAR TODAS AS
						INFORMAÇÕES DE TODAS AS NOTIFICAÇÕES -->
					<div class="barra-notificacao">
						<?php 
							for($i=0; $i<count($totalNotificacao); $i++){
								//CHAMO ESSE ARQUIVO PARA COLETAR
								//OS DADOS DE CADA NOTIFICAÇÃO
								include("../Model/modelInformacoesNotificacao.php");

								//$nomeCliente = $totalClienteSolicitacao[0]['nome_cliente'];

								//NESSA CONDIÇÃO EU VERIFICO SE O ID
								//DA NOTIFICAÇÃO ATUAL BATE COM O ID
								//DA NOTIFICAÇÃO QUE AINDA NAO FOI
								//VISTA
								if(isset($totalNotificacaoAtiva[$i]['id_notificacao'])){
									$idNotificacaoAtiva = $totalNotificacaoAtiva[$i]['id_notificacao'];	
								}else{
									$idNotificacaoAtiva = 0;
								}								

								$idNotificacao = $totalNotificacao[$i]['id_notificacao'];

								//CHAMO ESSE ARQUIVO PARA VERIFICAR
								//SE O USUÁRIO POSSUI NOTIFICAÇÕES
								//SE NÃO TIVER, EXIBE UMA MENSAGEM
								//QUE NÃO HÁ NOTIFICAÇÕES
								//PORÉM NÃO FUNCIONOU NO SERVIDOR
								//ENTÃO RETIREI A MENSAGEM
								include("../Model/modelVerificaNotificacaoPorUsuario.php");
								if(!isset($totalVerificarNotificacaoPorUsuario[0])){
						?>

						<!--<div class="notificacao">
							<h3>Sem notificações</h3>
						</div>-->

						<?php }else{

								if(isset($totalVerificarNotificacaoPorUsuario[0]['id_usuario'])){
									//CONDIÇÃO PARA MOSTRAR A 
									//NOTIFICAÇÃO
									//APENAS SE ELA TIVER LIGADA
									//AO USUARIO LOGADO
									if($totalVerificarNotificacaoPorUsuario[0]['id_usuario'] == $idUsuarioLogado){		
						?>

						<?php 
							//CONDIÇÃO PARA VERIFICAR SE A NOTIFICAÇÃO
							//AINDA NÃO FOI VISUALIZADA PARA PODER
							//MUDAR A COR DO SEU FUNDO
							if($totalVerificarNotificacaoPorUsuario[0]['vista_notificacao'] == 1){

								$idBlocoCalendarioLink = $totalNotificacao[$i]['id_bloco_calendario'];

								//PEGANDO O ID DO CALENDARIO E O ID
								//DO BLOCO QUE ESTÁ LIGADO A //NOTIFICAÇÃO PARA QUANDO FOR CLICADA
								//IR PARA O BLOCO 
								include('../Model/modelVerificarLinkNotificacao.php');

								//DEPOIS VER A QUESTÃO DO LINK
								//PRA QUANDO FOR UMA SOLICITAÇÃO
								if(isset($totalLink[0]['id_calendario'])){
									$idCalendarioLink = $totalLink[0]['id_calendario'];
								}else{
									$idCalendarioLink = 0;
								}

						?>
						<!--<a href="viewPaginaCalendarioDescricao.php?id=<?php //echo $idCalendarioLink;?>&idB=<?php //echo $idBlocoCalendarioLink;?>">-->


						<?php 
							$idNotificacaoSolicitacao = $totalNotificacao[$i]['id_notificacao'];

							include('../Model/modelNotificacaoSolicitacao.php');

							if($totalNotificacao[$i]['tipo_notificacao'] == 'solicitacao'){
								
						?>

						<!-- MUDAR OS PARAMETROS QUE SERÃO PASSADOS
							NA FUNÇÃO PARA PODER MARCAR A NOTIFICAÇÃO
							COMO LIDA	
						-->
						<div class="notificacao" style="background-color: #E2EAFF" onclick="visualizarNotificacaoSolicitacao(<?php echo $totalNotificacao[$i]['id_cliente']?>, <?php echo $totalVerificarNotificacaoPorUsuario[0]['id_notificacao']?>)">	

						<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'calendario-cadastrado'){?>		

						<div class="notificacao" style="background-color: #E2EAFF">				

						<?php }else{?>
						<div class="notificacao" style="background-color: #E2EAFF" onclick="visualizarNotificacao(<?php echo $idCalendarioLink;?>, <?php echo $idBlocoCalendarioLink;?>, <?php echo $totalVerificarNotificacaoPorUsuario[0]['id_notificacao']?>)">
						<?php }?>

						<?php }else{?>

						<!-- 
							LINK QUE REDIRECIONA PARA O BLOCO 
							DA NOTIFICAÇÃO 
						-->	
						<?php 
							if($totalNotificacao[$i]['id_bloco_calendario'] != 0){
								$idBlocoCalendarioLink = $totalNotificacao[$i]['id_bloco_calendario'];
								
							include('../Model/modelVerificarLinkNotificacao.php');

							$idCalendarioLink = $totalLink[0]['id_calendario'];
							}

							if($totalNotificacao[$i]['tipo_notificacao'] == 'solicitacao'){
						?>

						<div class="notificacao" onclick="visualizarNotificacaoSolicitacao(<?php echo $totalNotificacao[$i]['id_cliente']?>, <?php echo $totalVerificarNotificacaoPorUsuario[0]['id_notificacao']?>)">

						<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'calendario-cadastrado'){?>		

						<div class="notificacao">	

						<?php }else{?>
						
						<div class="notificacao" onclick="visualizarNotificacao(<?php echo $idCalendarioLink;?>, <?php echo $idBlocoCalendarioLink;?>, <?php echo $idNotificacaoAtiva;?>)">	
						<?php }}?>	

							<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'comentário'){?>

							<!-- 
								VERIFICANDO QUE TIPO DE AÇÃO FOI FEITA
								PARA PODER DESCREVER NA NOTIFICAÇÃO
							-->	
							<i class="fas fa-comment-dots" style="color: #5F88EA"></i><span>Novo comentário de <b><?php echo ucfirst($totalBuscaCliente[0]['nome_usuario'])?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'aprovado'){?>

							<i class="fas fa-check-double" style="color: #34d399"></i><span> Arte aprovada por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'reprovado'){?>

							<i class="fas fa-exclamation-circle" style="color: red"></i><span> Arte reprovada por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'solicitacao'){?>

							<i class="fas fa-question-circle" style="color: #F8E774"></i><span> Solicitação feita por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b></span>
							<!-- 
								TROCAR ESSA PARTE QUANDO NÃO FOR NO BLOCO
								DE CALENDÁRIO. QUANDO FOR NOTIFICAÇÃO
								DE SOLICITAÇÃO OU OUTRA NÃO MOSTRA O BLOCO
							-->
							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'arte-aprovada'){?>
							<i class="fas fa-check-double" style="color: #34d399"></i><span> Arte aprovada por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>	
							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'tema-aprovado'){?>
							<i class="fas fa-check-double" style="color: #34d399"></i><span> Tema aprovado por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'legenda-aprovada'){?>
							<i class="fas fa-check-double" style="color: #34d399"></i><span> Legenda aprovada por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'arte-cadastrada'){?>
							<i class="fas fa-images" style="color: #34d399"></i><span> Arte cadastrada por <b><?php echo ucfirst($totalBuscaCliente[0]['nome_usuario'])?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'calendario-cadastrado'){?>
							<i class="fas fa-images" style="color: #34d399"></i><span> Calendario criado por <b><?php echo ucfirst($totalBuscaCliente[0]['nome_usuario'])?></b></span>

							<?php }?>
							
							<?php if($totalNotificacao[$i]['tipo_notificacao'] != 'solicitacao' && $totalNotificacao[$i]['tipo_notificacao'] != 'calendario-cadastrado'){?>
							<p>no post <?php echo $totalBlocoCalendario[0]['tema_bloco_calendario']?></p>
							<?php }?>
						</div><!--</a>-->

						<?php }}}}?><!-- FIM DO FOR E DOS IF'S -->
					</div>
				</div>

			</div>

			<?php //}?>

			<!-- DIV DA BARRA (MENU) LATERAL -->
			<div class="nav-left">	
				<div class="ico-menu">			
					<i style="color: white;" class="fas fa-bars"></i>
				</div>
				
				<!--<h2>Painel Administrativo</h2>--><br><br><br>
				
				<a href="viewPainelAdministrativo.php"><i class="fas fa-house-user"></i>Início</a><br><br>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewUsuarios.php"><i class="fas fa-user-lock"></i>Gerenciar Usuários</a><br><br>
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<!--<a href="viewFormularios.php"><i class="fab fa-wpforms"></i>Controle de Formulários</a><br><br>-->
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewClientes.php"><i class='fas fa-user-cog'></i>Gerenciar Clientes</a><br><br>
				<?php }?>	

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewPrazos.php"><i class="fas fa-history"></i>Gerenciar Prazos</a><br><br>
				<?php }?>		
				
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewCalendarios.php"><i class="far fa-calendar-alt"></i>Gerenciar Calendários</a><br><br>
				<?php }else{?>
					<a href="viewCalendariosPorCliente.php"><i class="far fa-calendar-alt"></i>Calendários</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewCalendariosArquivados.php"><i class="fas fa-calendar-times"></i>Calendários Arquivados</a><br><br>
				<?php }else{?>
					<a href="viewCalendariosArquivadosPorCliente.php"><i class="fas fa-calendar-times"></i>Calendários Arquivados</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewSolicitacoes.php"><i class="fas fa-clipboard-list"></i>Gerenciar Solicitações</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewTarefas.php"><i class="fas fa-tasks"></i>Tarefas</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewQuadroTarefas.php"><i class="fas fa-chalkboard-teacher"></i>Quadro de Tarefas</a><br><br>
				<?php }?>

				
				
				<!--<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>-->

				<a href="../Controller/controllerLogout.php"><i class="fas fa-door-open"></i>Sair</a>
			</div>

			<!-- DIV DA BARRA (MENU) LATERAL -->
			<div class="nav-left-mini">	
				<div class="ico-menu-mini">			
					<i style="color: white" class="fas fa-bars" onmouseover="exibeInfoMenu('abrir-menu')"></i>
					<div class="info-ico-menu" id="abrir-menu">ABRIR MENU</div>
				</div>

				<br><br><br>
				<a href="viewPainelAdministrativo.php">
					<i class="fas fa-house-user" onmouseover="exibeInfoMenu('inicio')"></i>
					<div class="info-ico-menu" id="inicio">INÍCIO</div>
				</a><br><br>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewUsuarios.php">
						<i class="fas fa-user-lock" onmouseover="exibeInfoMenu('usuarios')"></i>
						<div class="info-ico-menu" id="usuarios">USUÁRIOS</div>
					</a><br><br>
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'master'){?>
					<!--<a href="viewFormularios.php"><i class="fab fa-wpforms"></i>Controle de Formulários</a><br><br>-->
				<?php } ?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewClientes.php">
						<i class='fas fa-user-cog' onmouseover="exibeInfoMenu('clientes')"></i>
						<div class="info-ico-menu" id="clientes">CLIENTES</div>
					</a><br><br>
				<?php }?>	

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewPrazos.php">
						<i class="fas fa-history" onmouseover="exibeInfoMenu('prazos')"></i>
						<div class="info-ico-menu" id="prazos">PRAZOS</div>
					</a><br><br>
				<?php }?>		
				
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewCalendarios.php">
						<i class="far fa-calendar-alt" onmouseover="exibeInfoMenu('calendarios')"></i>
						<div class="info-ico-menu" id="calendarios">CALENDÁRIOS</div>
					</a><br><br>
				<?php }else{?>
					<a href="viewCalendariosPorCliente.php">
						<i class="far fa-calendar-alt" onmouseover="exibeInfoMenu('calendarios')"></i>
						<div class="info-ico-menu">CALENDÁRIOS</div>
					</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewProjetos.php">
						<i class="fas fa-paste" onmouseover="exibeInfoMenu('projetos')"></i>
						<div class="info-ico-menu" id="projetos">PROJETOS</div>
					</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewCalendariosArquivados.php">
						<i class="fas fa-calendar-times" onmouseover="exibeInfoMenu('arquivados')"></i>
						<div class="info-ico-menu" id="arquivados">ARQUIVADOS</div>
					</a><br><br>
				<?php }else{?>
					<a href="viewCalendariosArquivadosPorCliente.php">
						<i class="fas fa-calendar-times" onmouseover="exibeInfoMenu('arquivados')"></i>
						<div class="info-ico-menu" id="arquivados">ARQUIVADOS</div>
					</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewSolicitacoes.php">
						<i class="fas fa-clipboard-list" onmouseover="exibeInfoMenu('solicitacoes')"></i>
						<div class="info-ico-menu" id="solicitacoes">SOLICITAÇÕES</div>
					</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewTarefas.php">
						<i class="fas fa-tasks" onmouseover="exibeInfoMenu('tarefas')"></i>
						<div class="info-ico-menu" id="tarefas">TAREFAS</div>
					</a><br><br>
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewQuadroTarefas.php">
						<i class="fas fa-chalkboard-teacher" onmouseover="exibeInfoMenu('quadro')"></i>
						<div class="info-ico-menu" id="quadro">QUADRO</div>
					</a><br><br>
				<?php }?>				
				
				<!--<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>-->

				<a href="../Controller/controllerLogout.php">
					<i class="fas fa-door-open" onmouseover="exibeInfoMenu('sair')"></i>
					<div class="info-ico-menu" id="sair">SAIR</div>
				</a>
			</div>
			
			<!-- DIV DA BARRA (MENU) LATERAL PARA O MOBILE -->
			<div class="nav-left-mobile">
				<div class="sub-header-mobile">
					<img src="../../images/logoiSeven2.png">
					<h2>Painel Administrativo</h2>
					<p>OLÁ <?php echo strtoupper($_SESSION['login'])?>!</p><br><br>
					<i class="fas fa-bars" id="icone-menu"></i>
				</div>

				<div class="menu-mobile">
					<a href="viewPainelAdministrativo.php"><i class="fas fa-house-user"></i>Início</a><br><br>

					<?php if($_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewUsuarios.php"><i class="fas fa-user-lock"></i>Gerenciar Usuários</a><br><br>
					<?php } ?>

					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewClientes.php"><i class='fas fa-user-cog'></i>Gerenciar Clientes</a><br><br>
					<?php }?>			
					
					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewCalendarios.php"><i class="far fa-calendar-alt"></i>Gerenciar Calendários</a><br><br>
					<?php }else{?>
						<a href="viewCalendariosPorCliente.php"><i class="far fa-calendar-alt"></i>Calendários</a><br><br>
					<?php }?>

					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewCalendariosArquivados.php"><i class="fas fa-calendar-times"></i>Calendários Arquivados</a><br><br>
					<?php }else{?>
						<a href="viewCalendariosArquivadosPorCliente.php"><i class="fas fa-calendar-times"></i>Calendários Arquivados</a><br><br>
					<?php }?>

					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<a href="viewSolicitacoes.php"><i class="fas fa-clipboard-list"></i>Gerenciar Solicitações</a><br><br>
					<?php }?>

					<a href="../Controller/controllerLogout.php"><i class="fas fa-door-open"></i>Sair</a>
				</div>
			</div>

		</header><!-- FIM DO HEADER -->

		<script>
			//ABRIR A BARRA DO MENU MOBILE
			$('#icone-menu').click(function(){
			  $('.menu-mobile').slideToggle();
			});

			//ABRIR A BARRA DAS NOTIFICAÇÕES
			function abrirNotificacao(){
				$('.barra-notificacao').slideToggle();				
			}

			//QUANDO CLICAR NA NOTIFICAÇÃO, LEVAR PARA O BLOCO
			//ONDE ELA ESTÁ LIGADA E MARCAR ELA COMO LIDA NO BANCO
			function visualizarNotificacao(idCalendario, idBlocoCalendario,idNotificacaoAtiva){
				document.location = '../Model/modelDesativarNotificacao.php?id='+idCalendario+'&idB='+idBlocoCalendario+'&idN='+idNotificacaoAtiva;
			}

			function visualizarNotificacaoSolicitacao(idCliente, idNotificacao){
				document.location = '../Model/modelVerificaClienteSolicitacao.php?id='+idCliente+'&idN='+idNotificacao;
			}

			function visualizarNotificacaoCalendario(idCalendario, idNotificacaoAtiva){
				document.location = '../Model/modelDesativarNotificacao.php?id='+idCalendario+'&idB=false&idN='+idNotificacaoAtiva;
			}

			$( ".ico-menu-mini" ).click(function() {
				$('.nav-left-mini').css('display', 'none');
				$( ".nav-left" ).animate({
			    width: "toggle"
			  }, 500, function() {
			  	$('.separador').css('width', '70%'); 
				$('.separador').css('margin-left', '300px'); 
				
			  });
			});

			$( ".ico-menu" ).click(function() {
				$('.nav-left-mini').css('display', 'block');
				$( ".nav-left" ).animate({
			    width: "toggle"
			  }, 500, function() {
			  	$('.separador').css('width', '90%'); 
				$('.separador').css('margin-left', '100px'); 
				
			  });
			});

			function exibeInfoMenu(icone){
				$('#'+icone).css('display', 'block');
			}

			$('.nav-left-mini i').mouseleave(function(){
				$('.info-ico-menu').css('display', 'none');
			});

			/*$('.ico-menu').click(function() {
			   $('.nav-left').css({
			      'width': $('.nav-left').width(),
			      'height': $('.nav-left').height()
			});
				$('.separador').css('width', '90%'); 
				$('.separador').css('margin-left', '100px'); 
				$('.nav-left').animate({'width': 'toggle'});
				$('.nav-left-mini').css('display', 'block');
			});


			$('.ico-menu-mini').click(function(){
				$('.nav-left').css({
			      'width': $('.nav-left').width(),
			      'height': $('.nav-left').height()
			});
				$('.separador').css('width', '70%'); 
				$('.separador').css('margin-left', '300px'); 
				$('.nav-left').animate({'width': 'toggle'});
				$('.nav-left-mini').css('display', 'none');
				$('.nav-left').css('width', '300px');
			});*/

			
		</script>	