<?php 
	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];

	$desarquivarCalendario = $pdo->prepare("UPDATE calendario SET arquivado_calendario = 0 WHERE id_calendario = '$idCalendario'");

	$desarquivarCalendario->execute();

	header('Location: ../View/viewCalendariosArquivados.php?id='.$idCalendario);
?>