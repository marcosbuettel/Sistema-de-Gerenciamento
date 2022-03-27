<?php 

	include_once("modelBancoDeDados.php");
	
	$idComentario = $_GET['idC'];
	$idTarefa = $_GET['idT'];

	$comentario = $_POST['comentario-tarefa'];

	$editarComentario = $pdo->prepare("UPDATE comentario_tarefa SET descricao_comentario_tarefa = '$comentario' WHERE id_comentario_tarefa = '$idComentario'");

	$editarComentario->execute();

	header("Location: ../View/viewTarefa.php?id=$idTarefa");

	echo "<script>document.location='../View/viewTarefa.php?id=$idTarefa'</script>";

?>