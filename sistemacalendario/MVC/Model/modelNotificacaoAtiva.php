<?php 
	$notificacaoAtiva = $pdo->prepare("SELECT * FROM notificacao_usuario WHERE  id_usuario = '$idUsuarioLogado' ORDER BY id_notificacao DESC");
	$notificacaoAtiva->execute();
	$totalNotificacaoAtiva = $notificacaoAtiva->fetchAlL(); 
?>