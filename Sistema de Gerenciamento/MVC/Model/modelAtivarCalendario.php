<?php 
	//ARQUIVO PARA ATIVAR O CALENDÁRIO
	include_once("modelBancoDeDados.php");

	$idCalendario = $_POST['id'];

	$ativarCalendario = $pdo->prepare("UPDATE calendario SET ativo_calendario = 0 WHERE id_calendario = '$idCalendario'");

	$ativarCalendario->execute();

	
?>