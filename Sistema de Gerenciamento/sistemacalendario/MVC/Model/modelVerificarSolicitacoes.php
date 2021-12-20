<?php
	$verificaSolicitacoes = $pdo->prepare("SELECT * FROM solicitacao_cliente WHERE nome_cliente_solicitacao = '$nomeCliente' ORDER BY tipo_solicitacao_cliente");
	$verificaSolicitacoes->execute();
	$totalSolicitacoes = $verificaSolicitacoes->fetchAlL(); 
?>