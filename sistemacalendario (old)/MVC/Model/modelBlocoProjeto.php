<?php	
	$verificaBlocosProjeto = $pdo->prepare("SELECT * FROM bloco_projeto WHERE id_projeto = '$idCalendario'");	

	$verificaBlocosProjeto->execute();
	$totalBlocosProjeto = $verificaBlocosProjeto->fetchAlL(); 	
?>