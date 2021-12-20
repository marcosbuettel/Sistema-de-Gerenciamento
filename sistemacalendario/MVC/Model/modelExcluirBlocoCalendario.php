<?php 
	include_once("modelBancoDeDados.php");

	$idBlocoCalendario = $_GET['id'];
	$idCalendario = $_GET['idC'];
	
	$excluirBlocoCalendario = $pdo->prepare("DELETE FROM bloco_calendario WHERE id_bloco_calendario = '$idBlocoCalendario'");

	$excluirBlocoCalendario->execute();
	
	header('Location: ../View/viewPaginaCalendario.php?id='.$idCalendario);
	//echo "<script>document.location='../View/viewCalendarios.php'</script>";
?>