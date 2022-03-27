<?php
	//ARQUIVO PARA EDIÇÃO DO PROJETO

	session_start();
	include_once("modelBancoDeDados.php");

	$idProjeto = $_GET['idP'];				

	$nomeProjeto = $_POST['nome-projeto'];
	$prazoProjeto = $_POST['prazo-projeto'];
	$tipoProjeto = $_POST['tipo-projeto'];
	$responsavelProjeto = $_POST['responsavel-projeto'];

	$editarProjeto = $pdo->prepare("UPDATE projetos SET nome_projeto = '$nomeProjeto', prazo_projeto = '$prazoProjeto', tipo_projeto = '$tipoProjeto', responsavel_projeto = '$responsavelProjeto' WHERE id_projeto = '$idProjeto'");

	$editarProjeto->execute();

	header('Location: ../View/viewProjetos.php');
?>