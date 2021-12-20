<?php 
	//ARQUIVO PARA EXCLUIR O CLIENTE

	include_once("modelBancoDeDados.php");

	$idSemana = $_GET['id'];
	
	$excluirSemanaQuadroTarefas = $pdo->prepare("DELETE FROM semana_quadro_tarefa WHERE id_semana_quadro_tarefa = '$idSemana'");

	$excluirSemanaQuadroTarefas->execute();

	echo "<script>document.location='../View/viewQuadroTarefas.php'</script>";

?>