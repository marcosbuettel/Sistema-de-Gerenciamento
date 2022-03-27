<?php 
	//ARQUIVO PARA CADASTRAR NOVO CALENDARIO

	include_once("modelBancoDeDados.php");

	if(isset($_GET['tipo'])){
		$tipo = $_GET['tipo'];
	}else{
		$tipo = 0;
		$p1CopyCalendario = $_POST['p1-copy-calendario'];
		$p1ArteCalendario = $_POST['p1-arte-calendario'];
		$p2CopyCalendario = $_POST['p2-copy-calendario'];
		$p2ArteCalendario = $_POST['p2-arte-calendario'];
	}
	
	$mesCalendario = $_POST['mes-calendario'];

	$clienteCalendario = $_POST['nome-cliente'];
	include_once("modelVerificarCliente.php");
	$idCliente = $totalClientes[0]['id_cliente'];

	$qtdSemanasCalendario = $_POST['qtd-semanas-calendario'];
	$usuarioCalendario = $_POST['usuario-calendario'];
	$dataCriacaoCalendario = $_POST['data-criacao-calendario'];	

	//SEPARACAO DO TIPO QUE SERA SALVO NO BANCO
	//$tipo -> [0 - CALENDARIO], [1 - CADASTRO DE PRAZOS]
	if($tipo == 0){
		$cadastrarCalendario = $pdo->prepare("INSERT INTO calendario (mes_calendario, id_cliente, qtd_semanas_calendario, usuario_calendario, data_criacao_calendario, p1_copy_calendario, p1_arte_calendario, p2_copy_calendario, p2_arte_calendario) VALUES ('$mesCalendario', '$idCliente', '$qtdSemanasCalendario', '$usuarioCalendario', '$dataCriacaoCalendario', '$p1CopyCalendario', '$p1ArteCalendario', '$p2CopyCalendario', '$p2ArteCalendario')");	
	}else{
		$cadastrarCalendario = $pdo->prepare("INSERT INTO calendario (mes_calendario, id_cliente, qtd_semanas_calendario, usuario_calendario, data_criacao_calendario, planilha_calendario) VALUES ('$mesCalendario', '$idCliente', '$qtdSemanasCalendario', '$usuarioCalendario', '$dataCriacaoCalendario', 1)");
	}	

	$cadastrarCalendario->execute();

	//include_once('modelCadastroProjeto.php');

	if($tipo == 0){
		echo "<script>document.location='../View/viewCalendarios.php'</script>";	
	}else{
		echo "<script>document.location='../View/viewPrazos.php'</script>";
	}
	
?>