<?php 
	session_start();
	include_once("modelBancoDeDados.php");
	
	$idNotificacaoAtiva = $_GET['idN'];

	$notificacaoDesativada = $pdo->prepare("UPDATE notificacao_usuario SET vista_notificacao = 0 WHERE id_notificacao = $idNotificacaoAtiva");
	$notificacaoDesativada->execute();

	echo "<script>document.location = '../View/viewProjetos.php'</script>";

?>