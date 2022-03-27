<?php
	//ARQUIVO PARA EDIÇÃO DO BLOCO DOS PROJETOS

	include_once("modelBancoDeDados.php");

	$idTarefa = $_GET['id'];
	$tipo = $_GET['tipo'];
	
	if($tipo == 0){
		$tipoStatus = 'aguardando-aprovacao';
		$tipoNotificacao = 'aguardando-aprovacao';
	}else if($tipo == 1){
		$tipoStatus = 'enviar-cliente';
		$tipoNotificacao = 'enviar-cliente';
	}else{
		$tipoStatus = 'finalizado';
	}	

	$verificaTarefas = $pdo->prepare("SELECT * FROM tarefa WHERE id_tarefa = '$idTarefa'");
	$verificaTarefas->execute();
	$totalTarefas = $verificaTarefas->fetchAlL(); 

	if($totalTarefas[0]['tipo_tarefa'] != 'solicitacao'){					

		$editarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET status_tarefa = '$tipoStatus' WHERE id_tarefa = '$idTarefa'");
		$editarBlocoCalendario->execute();

	}else{

		$editarSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET status_solicitacao_cliente = '$tipoStatus' WHERE id_tarefa = '$idTarefa'");
		$editarSolicitacao->execute();

	}
	

	$editarTarefa = $pdo->prepare("UPDATE tarefa SET status_tarefa = '$tipoStatus', id_semana_tarefa = 999, dia_semana_tarefa = 999 WHERE id_tarefa = '$idTarefa'");

	$editarTarefa->execute();


	//A PARTIR DAQUI VOU COMEÇAR A PEGAR INFORMAÇÕES PARA COLOCAR NA NOTIFICAÇÃO
	//PEGO O ID DO USUÁRIO LOGADO, O ID DO CLIENTE, ID DO BLOCO CALENDARIO = 0
	//
	//		

	$tituloTarefa = $totalTarefas[0]['titulo_tarefa'];
	$nomeCliente = $totalTarefas[0]['nome_cliente_tarefa'];

	$buscarCliente = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$nomeCliente'");
	$buscarCliente->execute();
	$totalCliente = $buscarCliente->fetchAlL();

	$idCliente = $totalCliente[0]['id_cliente'];


	if($tipo == 0 || $tipo == 1){

		$novaNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_cliente, titulo_notificacao, tipo_notificacao, vista_notificacao, id_tarefa) VALUES ('0', '$idCliente', '$tituloTarefa','$tipoNotificacao', '1', '$idTarefa')");

		$novaNotificacao->execute();

		include_once("modelNotificacao.php");

		$idNotificacao = $totalNotificacao[0]['id_notificacao'];
		$dataAtual = date('d/m/Y');

		if($tipo == 0){
			for($k = 0; $k < 2; $k++){
				if($k == 0){
					$idUsuarioNotificacao = 26;
				}else{
					$idUsuarioNotificacao = 29;
				}

				$cadastrarNotificacaoPorUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$idNotificacao', '$idUsuarioNotificacao', '1','$dataAtual')");
				$cadastrarNotificacaoPorUsuario->execute();
			}
			
		}else if($tipo == 1){
			$idUsuarioNotificacao = 31;

			$cadastrarNotificacaoPorUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$idNotificacao', '$idUsuarioNotificacao', '1','$dataAtual')");
			$cadastrarNotificacaoPorUsuario->execute();
		}
	}
	//AQUI TERMINA A PARTE DA NOTIFICAÇÃO AO MUDAR O STATUS DA TAREFA

	header('Location: ../View/viewQuadroTarefas.php');
	echo "<script>document.location='../viewQuadroTarefas.php</script>";	
?>