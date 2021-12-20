<?php
	//ARQUIVO PARA VERIFICAR TODOS OS BLOCOS QUE TEM 
	//O ID DA TAREFA CLICADA
	
	include_once("modelBancoDeDados.php");
	
	$idBlocoCalendario = $_POST['id'];

	$editarStatusBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET status_tarefa = 'finalizado' WHERE id_bloco_calendario = '$idBlocoCalendario'");

	$editarStatusBlocoCalendario->execute();
?>