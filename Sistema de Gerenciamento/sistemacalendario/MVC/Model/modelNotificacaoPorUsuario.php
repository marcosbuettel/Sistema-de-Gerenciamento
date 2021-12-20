<?php 
	
	include_once("modelNotificacao.php");

	$idClienteAtual = $idCliente;
	$idNotificacaoCliente = $totalNotificacao[0]['id_cliente'];
	
	include_once("modelUsuarios.php");
	include_once("modelNotificacaoCliente.php");

	$nomeClienteNotificacao = $totalClientesNotificacao[0]['nome_cliente'];

	$idNotificacao = $totalNotificacao[0]['id_notificacao'];

	$dataAtual = date('d/m/Y');

	for($i = 0; $i < count($totalUsuarios); $i++){

		$idUsuario = $totalUsuarios[$i]['id_usuario'];
		$idUsuarioNotificacao = $totalNotificacao[0]['id_usuario'];
		$tipoUsuario = $totalUsuarios[$i]['tipo_usuario'];
		$nomeCliente = $totalUsuarios[$i]['nome_cliente'];

		if($idUsuarioNotificacao != $idUsuario){
			if($tipoUsuario == 'master' or $tipoUsuario == 'adm' or $nomeCliente == $nomeClienteNotificacao){
				$cadastrarNotificacaoPorUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$idNotificacao', '$idUsuario', '1','$dataAtual')");
				$cadastrarNotificacaoPorUsuario->execute();
			}
		}
	}

?>