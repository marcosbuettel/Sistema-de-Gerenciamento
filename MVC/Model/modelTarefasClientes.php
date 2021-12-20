<?php
	//ARQUIVO PARA BUSCAR TODAS AS TAREFAS POR CLIENTES

	$verificaTarefasClientes = $pdo->prepare("SELECT * FROM clientes INNER JOIN calendario ON clientes.id_cliente = calendario.id_cliente ORDER BY id_calendario DESC");
	$verificaTarefasClientes->execute();
	$totalTarefasClientes = $verificaTarefasClientes->fetchAlL(); 
?>