<?php 
	//ARQUIVO PARA BUSCAR AS NOTIFICAÇÕES
	//COLOQUEI EM ORDEM DECRESCENTE PARA
	//EXIBIR AS NOTIFICAÇÕES MAIS ATUAIS EM
	//PRIMEIRO LUGAR

	$notificacao = $pdo->prepare("SELECT * FROM notificacao ORDER BY id_notificacao DESC");
	$notificacao->execute();
	$totalNotificacao = $notificacao->fetchAlL(); 
?>