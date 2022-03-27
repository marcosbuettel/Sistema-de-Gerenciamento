<?php 

	include_once("modelBancoDeDados.php");

	$idAgendamento = $_GET['id'];
	
	$excluirAgendamento = $pdo->prepare("DELETE FROM agendamento WHERE id_agendamento = '$idAgendamento'");

	$excluirAgendamento->execute();

	header('Location: ../View/viewAgenda.php');

	echo "<script>document.location='../View/viewAgenda.php'</script>";

?>