<?php 
	//ARQUIVO PARA EXCLUIR A TAREFA DO QUADRO DE TAREFAS

	include_once("modelBancoDeDados.php");

	$idTarefa = $_GET['id'];

	$verificaTarefas = $pdo->prepare("SELECT * FROM tarefa WHERE id_tarefa = '$idTarefa'");
	$verificaTarefas->execute();
	$totalTarefas = $verificaTarefas->fetchAlL(); 

	if($totalTarefas[0]['tipo_tarefa'] == 'solicitacao'){
		$editarSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET status_solicitacao_cliente = 'solicitado' WHERE id_tarefa = '$idTarefa'");
		$editarSolicitacao->execute();
	}else{
		$editarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET id_tarefa = null, status_tarefa = 'aguardando' WHERE id_tarefa = '$idTarefa'");
		$editarBlocoCalendario->execute();
	}
	
	$excluirTarefa = $pdo->prepare("DELETE FROM tarefa WHERE id_tarefa = '$idTarefa'");

	$excluirTarefa->execute();

	echo "<script>document.location='../View/viewQuadroTarefas.php'</script>";
?>