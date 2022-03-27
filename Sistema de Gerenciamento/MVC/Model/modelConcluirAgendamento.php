<?php 

	include_once('modelBancoDeDados.php');

	$idAgendamento = $_GET['id'];

	$concluirAgendamento = $pdo->prepare("UPDATE agendamento SET status_agendamento = 'concluido' WHERE id_agendamento = '$idAgendamento'");
	$concluirAgendamento->execute();

	header("Location: ../View/viewAgenda.php");

?>