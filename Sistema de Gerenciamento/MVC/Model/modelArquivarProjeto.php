<?php 	
	//ARQUIVO PARA ARQUIVAR O PROJETO
	//ARQUIVANDO, O PROJETO NÃO VAI MAIS APARECER
	//JUNTO AOS OUTROS
	//VAI APARECER EM OUTRA ABA SEPARADA

	include_once("modelBancoDeDados.php");

	$idProjeto = $_GET['id'];

	$arquivarProjeto = $pdo->prepare("UPDATE projetos SET arquivado_projeto = '1' WHERE id_projeto = '$idProjeto'");

	$arquivarProjeto->execute();

	header('Location: ../View/viewProjetos.php');
?>