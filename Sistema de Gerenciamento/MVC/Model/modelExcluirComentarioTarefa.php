<?php 

	include_once("modelBancoDeDados.php");

	$idComentario = $_GET['idC'];
	$idTarefa = $_GET['idT'];

	$excluirComentario = $pdo->prepare("DELETE FROM comentario_tarefa WHERE id_comentario_tarefa = '$idComentario'");

	$excluirComentario->execute();
	
	header('Location: ../View/viewTarefa.php?id='.$idTarefa);

?>