<?php 
	//ARQUIVO PARA EXCLUIR O CALENDARIO
	//TALVEZ NÃO FUNCIONE POIS PRECISA APAGAR OS DADOS DAS OUTRAS
	//TABELAS QUE ESTÃO LIGADAS NESSA

	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];
	
	$excluirCalendario = $pdo->prepare("DELETE FROM calendario WHERE id_calendario = '$idCalendario'");

	$excluirCalendario->execute();

	echo "<script>document.location='../View/viewCalendarios.php'</script>";
?>