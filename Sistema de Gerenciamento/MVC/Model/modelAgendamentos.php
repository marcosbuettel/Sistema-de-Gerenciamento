<?php 

	$buscarAgendamentos = $pdo->prepare("SELECT * FROM agendamento");
	$buscarAgendamentos->execute();
	$totalAgendamentos = $buscarAgendamentos->fetchAll();

?>