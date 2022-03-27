<?php 
	$verificarComentarios = $pdo->prepare("SELECT * FROM comentario_tarefa WHERE id_tarefa = '$idTarefa'");
	$verificarComentarios->execute();
	$totalComentarios = $verificarComentarios->fetchAll();
?>