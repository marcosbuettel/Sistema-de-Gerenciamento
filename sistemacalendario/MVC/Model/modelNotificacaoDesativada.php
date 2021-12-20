<?php 
	include_once("modelBancoDeDados.php");
	
	$notificacaoDesativada = $pdo->prepare("UPDATE notificacao SET vista_notificacao = 0");
	$notificacaoDesativada->execute();

	echo "<script>document.location='../View/viewPainelAdministrativo.php'</script>";
?>