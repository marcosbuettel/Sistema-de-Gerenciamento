<?php 
	//ARQUIVO PARA EXCLUIR A TAREFA DOS PROJETOS

	include_once("modelBancoDeDados.php");

	$idTarefa = $_GET['id'];
	
	$excluirTarefaProjeto = $pdo->prepare("DELETE FROM tarefa_projeto WHERE id_tarefa_projeto = '$idTarefa'");

	$excluirTarefaProjeto->execute();
	
	header('Location: ../View/viewProjetos.php');
	echo "<script>document.location='../View/viewProjetos.php'</script>";
?>