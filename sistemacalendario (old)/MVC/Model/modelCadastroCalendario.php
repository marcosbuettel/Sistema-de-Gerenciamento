<?php 
	include_once("modelBancoDeDados.php");

	$tipo = $_GET['tipo'];
	
	$mesCalendario = $_POST['mes-calendario'];

	$clienteCalendario = $_POST['nome-cliente'];
	include_once("modelVerificarCliente.php");
	$idCliente = $totalClientes[0]['id_cliente'];

	$qtdSemanasCalendario = $_POST['qtd-semanas-calendario'];
	$usuarioCalendario = $_POST['usuario-calendario'];
	$dataCriacaoCalendario = $_POST['data-criacao-calendario'];

	if($tipo == 0){
		$cadastrarCalendario = $pdo->prepare("INSERT INTO calendario (mes_calendario, id_cliente, qtd_semanas_calendario, usuario_calendario, data_criacao_calendario) VALUES ('$mesCalendario', '$idCliente', '$qtdSemanasCalendario', '$usuarioCalendario', '$dataCriacaoCalendario')");	
	}else{
		$cadastrarCalendario = $pdo->prepare("INSERT INTO calendario (mes_calendario, id_cliente, qtd_semanas_calendario, usuario_calendario, data_criacao_calendario, planilha_calendario) VALUES ('$mesCalendario', '$idCliente', '$qtdSemanasCalendario', '$usuarioCalendario', '$dataCriacaoCalendario', 1)");
	}	

	$cadastrarCalendario->execute();

	if($tipo == 0){
		echo "<script>document.location='../View/viewCalendarios.php'</script>";	
	}else{
		echo "<script>document.location='../View/viewPrazos.php'</script>";
	}
	
?>