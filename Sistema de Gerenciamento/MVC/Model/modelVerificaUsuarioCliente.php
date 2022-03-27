<?php 
	//ARQUIVO PARA BUSCAR A CONEXÃO DO USUARIO
	//LOGADO COM OS CLIENTES

	include_once("modelBancoDeDados.php");

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];

	$verificarUsuarioCliente = $pdo->prepare("SELECT * FROM usuario_cliente WHERE id_usuario = '$idUsuarioLogado' AND id_cliente = '$idCliente'");	
	
	$verificarUsuarioCliente->execute();
	$totalUsuarioCliente = $verificarUsuarioCliente->fetchAlL(); 

?>