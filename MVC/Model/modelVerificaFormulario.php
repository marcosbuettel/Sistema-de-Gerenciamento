<?php
	//ARQUIVO PARA BUSCAR TODOS OS FORMULARIOS

	include_once("modelBancoDeDados.php");
	
	$verificaFormulario = $pdo->prepare("SELECT * FROM formulario");
	$verificaFormulario->execute();
	$totalFormulario = $verificaFormulario->fetchAlL(); 
?>