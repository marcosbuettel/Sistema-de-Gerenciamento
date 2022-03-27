<?php 
	session_start();
	include_once("modelBancoDeDados.php");
	
	$idNotificacaoAtiva = $_GET['idN'];

	$notificacaoDesativada = $pdo->prepare("UPDATE notificacao_usuario SET vista_notificacao = 0 WHERE id_notificacao = $idNotificacaoAtiva");
	$notificacaoDesativada->execute();

	$buscarIdTarefa = $pdo->prepare("SELECT * FROM notificacao WHERE id_notificacao = '$idNotificacaoAtiva'");
	$buscarIdTarefa->execute();
	$totalTarefas = $buscarIdTarefa->fetchAll();

	$idTarefa = $totalTarefas[0]['id_tarefa'];

	echo "<script>document.location = '../View/viewTarefa.php?id=$idTarefa'</script>";

?>