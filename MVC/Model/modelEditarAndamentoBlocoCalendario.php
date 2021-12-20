<?php
	//ARQUIVO PARA VERIFICAR TODOS OS BLOCOS QUE TEM 
	//O ID DA TAREFA CLICADA
	
	include_once("modelBancoDeDados.php");
	
	$idBlocoCalendario = $_POST['id'];
	$tipo = $_POST['tipo'];

	$editarStatusBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET producao_bloco_calendario = '$tipo' WHERE id_bloco_calendario = '$idBlocoCalendario'");

	$editarStatusBlocoCalendario->execute();
?>