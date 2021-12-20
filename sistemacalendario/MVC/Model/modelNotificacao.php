<?php 
	$notificacao = $pdo->prepare("SELECT * FROM notificacao ORDER BY id_notificacao DESC");
	$notificacao->execute();
	$totalNotificacao = $notificacao->fetchAlL(); 
?>