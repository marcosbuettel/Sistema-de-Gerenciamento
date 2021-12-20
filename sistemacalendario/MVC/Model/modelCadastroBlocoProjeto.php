<?php 
	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];
	$posicaoBlocoProjeto = $_GET['idBP'];

	$descBlocoProjeto = $_POST['descricao-bloco-projeto'];
	$statusBlocoProjeto = $_POST['status-bloco-projeto'];

	$cadastrarBlocoProjeto = $pdo->prepare("INSERT INTO bloco_projeto (id_projeto, posicao_bloco_projeto, desc_bloco_projeto, status_bloco_projeto) VALUES ('$idCalendario', '$posicaoBlocoProjeto', '$descBlocoProjeto', '$statusBlocoProjeto')");

	$cadastrarBlocoProjeto->execute();

	header('Location: ../View/viewPaginaProjeto.php?id='.$idCalendario);

	echo "<script>document.location='../viewPaginaProjeto.php?id='.$idCalendario.</script>";
?>