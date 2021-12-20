<?php 

	include_once("modelBancoDeDados.php");
	include_once("../Model/modelSemanaQuadroTarefa.php");

	for ($i = 0; $i < count($totalSemanaTarefa); $i++) { 
		
	}
	
	$i--;
	$ordemSemana = $totalSemanaTarefa[$i]['ordem_semana_quadro_tarefa'] + 1;

	$cadastrarSemanaQuadroTarefas = $pdo->prepare("INSERT INTO semana_quadro_tarefa (ordem_semana_quadro_tarefa) VALUES ('$ordemSemana')");

	$cadastrarSemanaQuadroTarefas->execute();

	header('Location: ../View/viewQuadroTarefas.php');

	echo "<script>document.location='../viewQuadroTarefas.php</script>";
?>