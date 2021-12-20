<?php 
	include_once("modelBancoDeDados.php");

	$idProjeto = $_GET['id'];
	
	$excluirProjeto = $pdo->prepare("DELETE FROM projeto WHERE id_projeto = '$idProjeto'");

	$excluirProjeto->execute();

	echo "<script>document.location='../View/viewProjetos.php'</script>";
?>