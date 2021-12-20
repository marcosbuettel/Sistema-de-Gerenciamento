<?php
	//ARQUIVO PARA EDITAR O STATUS DA SOLICITAÇÃO PARA APROVADO (PELO CLIENTE)

	include_once("modelBancoDeDados.php");

	$idSolicitacao = $_GET['id'];
	$nomeCliente = $_GET['nome'];					

	$editarStatusSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET status_solicitacao_cliente = 'aprovado' WHERE id_solicitacao_cliente = '$idSolicitacao'");

	$editarStatusSolicitacao->execute();

	header('Location: ../View/viewSolicitacoesPorCliente.php?cliente='.$nomeCliente);
	echo "<script>document.location='../viewSolicitacoesPorCliente.php?cliente='.$nomeCliente.</script>";	
?>