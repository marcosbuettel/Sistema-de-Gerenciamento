<?php 
	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];
	
	$excluirCalendario = $pdo->prepare("DELETE FROM calendario WHERE id_calendario = '$idCalendario'");

	$excluirCalendario->execute();

	echo "<script>document.location='../View/viewCalendarios.php'</script>";
?>