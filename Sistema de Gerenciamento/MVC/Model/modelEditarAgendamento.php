<?php 

	include_once("modelBancoDeDados.php");

	$idAgendamento = $_GET['id'];
	$dataHora = $_POST['dataHoraAgendamento'];

	$editarAgendamento = $pdo->prepare("UPDATE agendamento SET data_agendamento = '$dataHora' WHERE id_agendamento = '$idAgendamento'");
	$editarAgendamento->execute();

	header('Location: ../View/viewAgenda.php');

	echo "<script>document.location='../View/viewAgenda.php'</script>";
?>