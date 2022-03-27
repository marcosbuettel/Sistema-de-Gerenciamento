<?php 
	
	include_once("modelBancoDeDados.php");

	$idAgendamento = $_GET['id'];
	$diaSemana = $_GET['dia'];
	$semana = $_GET['semana'];

	echo $diaSemana;
	echo $semana;
	
	$mudarStatusAgendamento = $pdo->prepare("UPDATE agendamento SET dia_agendamento = '$diaSemana', semana_agendamento = '$semana', status_agendamento = 'agendado' WHERE id_agendamento = '$idAgendamento'");

	$mudarStatusAgendamento->execute();

	header("Location: ../View/viewAgenda.php");

?>