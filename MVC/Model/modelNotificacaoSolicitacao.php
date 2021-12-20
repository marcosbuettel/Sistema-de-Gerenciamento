<?php 
	$notificacaoSolicitacao = $pdo->prepare("SELECT * FROM notificacao WHERE id_notificacao = '$idNotificacaoSolicitacao' ORDER BY id_notificacao DESC");
	$notificacaoSolicitacao->execute();
	$totalNotificacaoSolicitacao = $notificacaoSolicitacao->fetchAlL();
?>