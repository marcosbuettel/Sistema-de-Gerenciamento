<?php 
	//ARQUIVO PARA CADASTRO DE PROJETOS
	session_start();
	include_once("modelBancoDeDados.php");

	$idUsuario = $_SESSION['id-usuario-logado'];
	$idCliente = $_GET['idC'];

	$verificarUsuarioCliente = $pdo->prepare("SELECT * FROM usuario_cliente WHERE id_usuario = '$idUsuario' AND id_cliente = '$idCliente'");	
	
	$verificarUsuarioCliente->execute();
	$totalUsuarioCliente = $verificarUsuarioCliente->fetchAlL(); 

	if(count($totalUsuarioCliente) > 0){
		if($totalUsuarioCliente[0]['status_usuario_cliente'] == 1){
			$status = 0;
		}else{
			$status = 1;
		}
	}else{
		$status = 1;
	}

	if(count($totalUsuarioCliente) > 0){
		$cadastrarUsuarioCliente = $pdo->prepare("UPDATE usuario_cliente SET status_usuario_cliente = '$status' WHERE id_usuario = '$idUsuario' AND id_cliente = '$idCliente'");
	}else{
		$cadastrarUsuarioCliente = $pdo->prepare("INSERT INTO usuario_cliente (id_usuario, id_cliente, status_usuario_cliente) VALUES ('$idUsuario', '$idCliente', '1')");		
	}

	$cadastrarUsuarioCliente->execute();

	echo "<script>document.location='../View/viewClientes.php'</script>";
?>