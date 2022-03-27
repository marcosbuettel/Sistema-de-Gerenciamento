<?php 
	session_start();
	
	include_once("modelBancoDeDados.php");

	$tipoSolicitacao = array('solicitado', 'andamento', 'aguardando', 'aprovado', 'postar', 'finalizado');

	$nomeCliente = $_SESSION['nome-cliente'];
	$coluna = $_GET['tipo'];
	$idSolicitacao = $_GET['id'];
	$direcao = $_GET['direcao'];
	
	if($coluna == 0){
		if($direcao == 'right'){
			$tipo = $tipoSolicitacao[1];
		}
	}else if($coluna == 1){
		if($direcao == 'right'){
			$tipo = $tipoSolicitacao[2];
		}else{
			$tipo = $tipoSolicitacao[0];
		}
	}	

	//$editarTipoSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET tipo_solicitacao_cliente = '$tipo' WHERE nome_cliente_solicitacao = '$nomeCliente' AND id_solicitacao_cliente = '$idSolicitacao'");

	//$editarTipoSolicitacao->execute();


?>