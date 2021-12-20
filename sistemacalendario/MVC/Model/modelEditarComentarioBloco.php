<?php
	session_start();
	include_once("modelBancoDeDados.php");

	$idCalendario = $_SESSION['idCalendario'];
	$idBlocoCalendario = $_SESSION['idBlocoCalendario'];

	$idComentario = $_GET['idComentario'];

	$comentario = $_POST['comentario-bloco'];				

	$editarComentario = $pdo->prepare("UPDATE comentario_bloco_calendario SET descricao_comentario_bloco_calendario = '$comentario' WHERE id_comentario_bloco_calendario = '$idComentario'");

	$editarComentario->execute();

	header('Location: ../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario);
?>