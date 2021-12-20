<?php
	//ARQUIVO PARA EDIÇÃO DO BLOCO DOS PROJETOS

	include_once("modelBancoDeDados.php");

	$idTarefa = $_GET['id'];

	$verificaTarefas = $pdo->prepare("SELECT * FROM tarefa WHERE id_tarefa = '$idTarefa'");
	$verificaTarefas->execute();
	$totalTarefas = $verificaTarefas->fetchAlL(); 

	if($totalTarefas[0]['tipo_tarefa'] != 'solicitacao'){					

		$editarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET status_tarefa = 'finalizado' WHERE id_tarefa = '$idTarefa'");
		$editarBlocoCalendario->execute();

	}else{

		$editarSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET status_solicitacao_cliente = 'aguardando' WHERE id_tarefa = '$idTarefa'");
		$editarSolicitacao->execute();

	}
	

	$editarTarefa = $pdo->prepare("UPDATE tarefa SET status_tarefa = 'finalizado', id_semana_tarefa = 999, dia_semana_tarefa = 999 WHERE id_tarefa = '$idTarefa'");

	$editarTarefa->execute();

	header('Location: ../View/viewQuadroTarefas.php');
	echo "<script>document.location='../viewQuadroTarefas.php</script>";	
?>