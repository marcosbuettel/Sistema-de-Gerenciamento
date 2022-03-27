<?php 
	//ARQUIVO PARA DESATIVAR O CALENDÁRIO
	include_once("modelBancoDeDados.php");

	$idCalendario = $_POST['id'];

	$desativarCalendario = $pdo->prepare("UPDATE calendario SET ativo_calendario = 1 WHERE id_calendario = '$idCalendario'");

	$desativarCalendario->execute();	
?>