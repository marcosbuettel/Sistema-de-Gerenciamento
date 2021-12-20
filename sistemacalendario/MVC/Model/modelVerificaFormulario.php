<?php
	include_once("modelBancoDeDados.php");
	
	$verificaFormulario = $pdo->prepare("SELECT * FROM formulario");
	$verificaFormulario->execute();
	$totalFormulario = $verificaFormulario->fetchAlL(); 
?>