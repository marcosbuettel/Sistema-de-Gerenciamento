<?php
	//ARQUIVO PARA EDIÇÃO DA TAREFA DO PROJETO

	include_once("modelBancoDeDados.php");

	$idTarefa = $_GET['idT'];	

	$nomeTarefa = $_POST['nome-tarefa'];				
	$tipoTarefa = $_POST['tipo-tarefa'];
	$prioridadeTarefa = $_POST['prioridade-tarefa'];
	$responsavelTarefa = $_POST['responsavel-tarefa'];
	$prazoTarefa = $_POST['prazo-tarefa'];
	$descricaoTarefa = $_POST['descricao-tarefa'];

	$editarTarefa = $pdo->prepare("UPDATE tarefa_projeto SET nome_tarefa_projeto = '$nomeTarefa', tipo_tarefa_projeto = '$tipoTarefa', prioridade_tarefa_projeto = '$prioridadeTarefa', responsavel_tarefa_projeto = '$responsavelTarefa', prazo_tarefa_projeto = '$prazoTarefa', descricao_tarefa_projeto = '$descricaoTarefa' WHERE id_tarefa_projeto = '$idTarefa'");

	$editarTarefa->execute();

	header('Location: ../View/viewProjetos.php');
?>