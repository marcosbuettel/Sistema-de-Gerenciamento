<?php 
	include_once("modelBancoDeDados.php");

	$cadastrarFormulario = $pdo->prepare("INSERT INTO formulario (data_formulario, hora_formulario, nome_cliente_formulario, email_formulario) VALUES ('$partes[0]', '$partes[1]', '$partes[2]', '$partes[3]')");

	$cadastrarFormulario->execute();

	header('Location: ../View/viewFormularios.php');

	echo "<script>document.location='../viewFormularios.php</script>";
?>