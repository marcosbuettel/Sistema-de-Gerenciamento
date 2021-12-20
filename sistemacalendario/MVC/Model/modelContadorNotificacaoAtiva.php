<?php 
	$contadorNotificacaoAtiva = $pdo->prepare("SELECT * FROM notificacao_usuario WHERE vista_notificacao = 1 AND id_usuario = '$idUsuarioLogado' ORDER BY id_notificacao DESC");
	$contadorNotificacaoAtiva->execute();
	$totalContadorNotificacaoAtiva = $contadorNotificacaoAtiva->fetchAlL(); 

?>