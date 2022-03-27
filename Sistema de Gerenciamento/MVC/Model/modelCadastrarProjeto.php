<?php 
	//ARQUIVO PARA CADASTRO DE PROJETOS
	session_start();
	include_once("modelBancoDeDados.php");

	$criadorProjeto = $_SESSION['login'];
	$nomeProjeto = $_POST['nome-projeto'];
	$prazoProjeto = $_POST['prazo-projeto'];
	$responsavelProjeto = $_POST['responsavel-projeto'];
	$tipoProjeto = $_POST['tipo-projeto'];

	$cadastrarProjeto = $pdo->prepare("INSERT INTO projetos (nome_projeto, prazo_projeto, tipo_projeto, criador_projeto, responsavel_projeto) VALUES ('$nomeProjeto', '$prazoProjeto','$tipoProjeto', '$criadorProjeto', '$responsavelProjeto')");

	$cadastrarProjeto->execute();

	echo "<script>document.location='../View/viewProjetos.php'</script>";
?>