<?php 
	
	include_once("modelBancoDeDados.php");
	
	$idTarefa = $_POST['id'];
	$linkTarefa = $_POST['link'];

	$cadastrarLinkImg = $pdo->prepare("UPDATE tarefa SET link_img_tarefa = '$linkTarefa' WHERE id_tarefa = '$idTarefa'");

	$cadastrarLinkImg->execute();

?>