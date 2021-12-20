<?php 
	include_once("modelBancoDeDados.php");

	$nomeUsuario = $_GET['nome-usuario'];
	$senhaUsuario = $_GET['senha-usuario'];
	$nomeCliente = $_GET['nome-cliente'];
	$tipoUsuario = $_GET['tipo-usuario'];

	$cadastrarUsuario = $pdo->prepare("INSERT INTO usuarios (nome_usuario, senha_usuario, tipo_usuario, nome_cliente) VALUES ('$nomeUsuario', '$senhaUsuario', '$tipoUsuario','$nomeCliente')");

	$cadastrarUsuario->execute();

	echo "<script>document.location='../View/viewUsuarios.php'</script>";
?>