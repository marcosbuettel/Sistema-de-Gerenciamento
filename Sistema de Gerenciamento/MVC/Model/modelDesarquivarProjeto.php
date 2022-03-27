<?php 	
	//ARQUIVO PARA DESARQUIVAR O PROJETO

	include_once("modelBancoDeDados.php");

	$idProjeto = $_GET['id'];

	$arquivarProjeto = $pdo->prepare("UPDATE projetos SET arquivado_projeto = '0' WHERE id_projeto = '$idProjeto'");

	$arquivarProjeto->execute();

	header('Location: ../View/viewProjetosArquivados.php');
?>