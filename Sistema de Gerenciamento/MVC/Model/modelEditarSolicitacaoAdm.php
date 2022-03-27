<?php
	//ARQUIVO PARA EDIÇÃO DA SOLICITACAO

	include_once("modelBancoDeDados.php");

	$idSolicitacao = $_GET['idS'];
	$nomeCliente = $_GET['nome'];	

	$nomeSolicitacao = $_POST['titulo-solicitacao'];				
	$descricaoSolicitacao = $_POST['descricao-solicitacao'];
	$prazoSolicitacao = $_POST['prazo-solicitacao'];

	$editarSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET titulo_solicitacao_cliente = '$nomeSolicitacao', descricao_solicitacao_cliente = '$descricaoSolicitacao', prazo_solicitacao_cliente = '$prazoSolicitacao' WHERE id_solicitacao_cliente = '$idSolicitacao'");

	$editarSolicitacao->execute();

	header("Location: ../View/viewSolicitacoesPorCliente.php?cliente=$nomeCliente");
?>