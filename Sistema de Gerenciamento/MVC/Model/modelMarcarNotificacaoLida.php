<?php
	//ARQUIVO PARA MARCAR TODAS AS NOTIFICAÇÕES
	//COMO LIDAS 

	session_start();
	include_once("modelBancoDeDados.php");

	$idUsuarioLogado = $_GET['idN'];				

	$editarStatusNotificacao = $pdo->prepare("UPDATE notificacao_usuario SET vista_notificacao = '0' WHERE id_usuario = '$idUsuarioLogado'");

	$editarStatusNotificacao->execute();

	header('Location: ../View/viewPainelAdministrativo.php');
?>