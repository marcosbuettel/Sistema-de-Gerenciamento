<?php
	//ARQUIVO PARA EDIÇÃO DO BLOCO DOS PROJETOS

	include_once("modelBancoDeDados.php");

	$idTarefa = $_POST['id'];				

	$editarTarefaProjeto = $pdo->prepare("UPDATE tarefa_projeto SET status_tarefa_projeto = 'finalizado' WHERE id_tarefa_projeto = '$idTarefa'");

	$editarTarefaProjeto->execute();

	header('Location: ../View/viewProjetos.php');
	echo "<script>document.location='../View/viewProjetos.php'</script>";	
?>