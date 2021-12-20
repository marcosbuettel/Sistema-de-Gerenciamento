<?php 
	include_once("modelBancoDeDados.php");
	
	$tipoProjeto = $_POST['tipo-projeto'];
	$clienteProjeto = $_POST['nome-cliente'];
	$statusProjeto = $_POST['status-projeto'];
	$dataCriacaoProjeto = $_POST['data-criacao-projeto'];

	$cadastrarProjeto = $pdo->prepare("INSERT INTO projeto (nome_projeto, id_cliente, status_projeto,data_inicial_projeto) VALUES ('$tipoProjeto', '$clienteProjeto', '$statusProjeto','$dataCriacaoProjeto')");

	$cadastrarProjeto->execute();

	echo "<script>document.location='../View/viewProjetos.php'</script>";
?>