<?php 	
	//ARQUIVO PARA ARQUIVAR O CALENDÁRIO
	//ARQUIVANDO, O CALENDÁRIO NÃO VAI MAIS APARECER
	//JUNTO AOS OUTROS
	//VAI APARECER EM OUTRA ABA SEPARADA

	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];

	$arquivarCalendario = $pdo->prepare("UPDATE calendario SET arquivado_calendario = '1' WHERE id_calendario = '$idCalendario'");

	$arquivarCalendario->execute();

	header('Location: ../View/viewCalendarios.php');
?>