<?php 
	session_start();

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	
	include_once("../Model/modelBancoDeDados.php");
	include_once("../Model/modelNotificacao.php");
	include_once("../Model/modelNotificacaoAtiva.php");	
	include_once("../Model/modelContadorNotificacaoAtiva.php");	

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
		<script src="../../js/main.js"></script>	
		<link href="../../css/fontawesome.min.css" rel="stylesheet">
		<link href="../../css/all.css" rel="stylesheet">
		<link href="../../css/style-pa.css" rel="stylesheet">
	</head>

	<body>		

		<header>
			<?php 
				//if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){

				//REMOVI AQUI PARA QUE NÃO SÓ OS USUÁRIOS MASTER E ADM VEJAM 
				//AS NOTIFICAÇÕES, MAS TAMBÉM OS CLIENTES
			?>

			<div class="nav-superior">
				<div class="img-sino">
					<img src="../../images/sino.png" onclick="abrirNotificacao()">
					<!-- BEM NESSA PARTE, COLOCAR OUTRO MODEL
						PARA CONTAR AS NOTIFICAÇÕES ATIVAS -->
					<?php if(count($totalContadorNotificacaoAtiva) != 0){?>
					
					<div class="aviso-notificacao" onclick="abrirNotificacao()"><h4><?php echo count($totalContadorNotificacaoAtiva)?></h4></div>

					<?php }?>

					<div class="barra-notificacao">
						<?php 
							for($i=0; $i<count($totalNotificacao); $i++){
								include("../Model/modelInformacoesNotificacao.php");		
								if(isset($totalNotificacaoAtiva[$i]['id_notificacao'])){
									$idNotificacaoAtiva = $totalNotificacaoAtiva[$i]['id_notificacao'];	
								}else{
									$idNotificacaoAtiva = 0;
								}						
								

								$idNotificacao = $totalNotificacao[$i]['id_notificacao'];

								include("../Model/modelVerificaNotificacaoPorUsuario.php");
								if(!isset($totalVerificarNotificacaoPorUsuario[0])){
						?>

						<!--<div class="notificacao">
							<h3>Sem notificações</h3>
						</div>-->

						<?php }else{
								if(isset($totalVerificarNotificacaoPorUsuario[0]['id_usuario'])){

									if($totalVerificarNotificacaoPorUsuario[0]['id_usuario'] == $idUsuarioLogado){
								
						?>

						<?php 
							if($totalVerificarNotificacaoPorUsuario[0]['vista_notificacao'] == 1){

								$idBlocoCalendarioLink = $totalNotificacao[$i]['id_bloco_calendario'];
								
								include('../Model/modelVerificarLinkNotificacao.php');

								$idCalendarioLink = $totalLink[0]['id_calendario'];

						?>
						<!--<a href="viewPaginaCalendarioDescricao.php?id=<?php //echo $idCalendarioLink;?>&idB=<?php //echo $idBlocoCalendarioLink;?>">-->
						<div class="notificacao" style="background-color: #E2EAFF" onclick="visualizarNotificacao(<?php echo $idCalendarioLink;?>, <?php echo $idBlocoCalendarioLink;?>, <?php echo $idNotificacaoAtiva?>)">							
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
						?>

						<!--<a href="viewPaginaCalendarioDescricao.php?id=<?php //echo $idCalendarioLink;?>&idB=<?php //echo $idBlocoCalendarioLink;?>">-->
						<div class="notificacao" onclick="visualizarNotificacao(<?php echo $idCalendarioLink;?>, <?php echo $idBlocoCalendarioLink;?>, <?php echo $idNotificacaoAtiva;?>)">	
						<?php }?>	

							<?php if($totalNotificacao[$i]['tipo_notificacao'] == 'comentário'){?>

							<!-- 
								TROCAR O NOME DE QUEM FEZ O COMENTÁRIO AQUI!!
								PEGAR PELO ID DO USUÁRIO, PARA BUSCAR O NOME.
								IR NO ARQUIVO modelVerificaNotificacaoPorUsuario.php
								E TROCAR AS INFORMAÇÕES DO CLIENTE PELA 
								DO USUÁRIO
							-->	
							<i class="fas fa-comment-dots" style="color: #5F88EA"></i><span>Novo comentário de <b><?php echo ucfirst($totalBuscaCliente[0]['nome_usuario'])?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'aprovado'){?>

							<i class="fas fa-check-double" style="color: #34d399"></i><span> Arte aprovada por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'reprovado'){?>

							<i class="fas fa-exclamation-circle" style="color: red"></i><span> Arte reprovada por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>

							<?php }else if($totalNotificacao[$i]['tipo_notificacao'] == 'solicitacao'){?>

							<i class="fas fa-question-circle" style="color: #F8E774"></i><span> Solicitação feita por <b><?php echo $totalBuscaCliente[0]['nome_cliente']?></b>,</span>
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

							<?php }?>
							
							<?php if($totalNotificacao[$i]['tipo_notificacao'] != 'solicitacao'){?>
							<p>no post <?php echo $totalBlocoCalendario[0]['tema_bloco_calendario']?></p>
							<?php }?>
						</div><!--</a>-->

						<?php }}}}?><!-- FIM DO FOR E DOS IF'S -->
					</div>
				</div>

			</div>

			<?php //}?>

			<div class="nav-left">				

				<img src="../../images/logoiSeven2.png">
				<h2>Painel Administrativo</h2>	

				<p>OLÁ <?php echo strtoupper($_SESSION['login'])?>!</p><br><br>
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
					<!--<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>-->
				<?php }?>

				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<a href="viewCalendariosArquivados.php"><i class="fas fa-calendar-times"></i>Calendários Arquivados</a><br><br>
				<?php }else{?>
					<a href="viewCalendariosArquivadosPorCliente.php"><i class="fas fa-calendar-times"></i>Calendários Arquivados</a><br><br>
				<?php }?>
				
				<!--<a href="viewProjetos.php"><i class="fas fa-paste"></i>Gerenciar Projetos</a><br><br>-->

				<a href="../Controller/controllerLogout.php"><i class="fas fa-door-open"></i>Sair</a>
			</div>
			
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

					<a href="../Controller/controllerLogout.php"><i class="fas fa-door-open"></i>Sair</a>
				</div>
			</div>

		</header><!-- FIM DO HEADER -->

		<script>
			$('#icone-menu').click(function(){
			  $('.menu-mobile').slideToggle();
			});

			function abrirNotificacao(){
				$('.barra-notificacao').slideToggle();				
			}

			function visualizarNotificacao(idCalendario, idBlocoCalendario,idNotificacaoAtiva){
				document.location = '../Model/modelDesativarNotificacao.php?id='+idCalendario+'&idB='+idBlocoCalendario+'&idN='+idNotificacaoAtiva;
			}
		</script>

	