<?php
	//ARQUIVO PARA EDITAR O STATUS DO PROJETO
	
	include_once("modelBancoDeDados.php");
	
	$idProjeto = $_GET['idP'];
	$colunaProjeto = $_GET['coluna'];
	$tipoFluxo = $_GET['tipo'];


	$fluxoIdentidade = array('solicitado', 'brainstorming', 'criacao', 'apresentacao', 'alteracao', 'enviar-arquivos', 'grafica', 'concluido');

	$fluxoOrganico = array('solicitado', 'planejamento', 'criacao-conteudo', 'design', 'aprovacao', 'publicacao', 'concluido');

	$fluxoPerformance = array('solicitado', 'planejamento', 'estrategia', 'copy', 'design', 'landing-page', 'verba', 'subir-campanha', 'relatorio', 'concluido');

	$fluxoEcommerce = array('solicitado', 'b2','registro-dominio', 'dns', 'config-iniciais', 'layout', 'banners', 'ap-cliente', 'treinamento', 'concluido');

	$fluxoInstitucional = array('solicitado', 'b2','registro-dominio', 'dns', 'config-iniciais', 'layout', 'banners', 'ap-cliente', 'treinamento', 'concluido');

	/*
		TIPOS PASSADOS PELO LINK:
		0 -> IDENTIDADE VISUAL
		1 -> MARKETING ORGÂNICO
		2 -> MARKETING PERFORMANCE
		3 -> ECOMMERCE
		4 -> INSTITUCIONAL		
	*/

	if($tipoFluxo == 0){
		$novoStatus = $fluxoIdentidade[$colunaProjeto];
	}else if($tipoFluxo == 1){
		$novoStatus = $fluxoOrganico[$colunaProjeto];
	}else if($tipoFluxo == 2){
		$novoStatus = $fluxoPerformance[$colunaProjeto];
	}else if($tipoFluxo == 3){
		$novoStatus = $fluxoEcommerce[$colunaProjeto];
	}else if($tipoFluxo == 4){
		$novoStatus = $fluxoInstitucional[$colunaProjeto];
	}

	$editarStatusProjeto = $pdo->prepare("UPDATE projetos SET status_projeto = '$novoStatus' WHERE id_projeto = '$idProjeto'");

	$editarStatusProjeto->execute();

	header('Location: ../View/viewAndamentoProjetos.php?tipo='.$tipoFluxo);

	echo "<script>document.location='../View/viewAndamentoProjetos.php?tipo='.$tipoFluxo.</script>";
?>