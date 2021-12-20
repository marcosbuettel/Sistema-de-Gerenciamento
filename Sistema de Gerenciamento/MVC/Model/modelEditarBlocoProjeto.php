<?php
	//ARQUIVO PARA EDIÇÃO DO BLOCO DOS PROJETOS

	include_once("modelBancoDeDados.php");

	$idBlocoProjetoSelecionado = $_GET['id'];
	$idProjeto = $_GET['idP'];

	$descBlocoProjeto = $_POST['descricao-bloco-projeto'];
	$statusBlocoProjeto = $_POST['status-bloco-projeto'];					

	$editarBlocoProjeto = $pdo->prepare("UPDATE bloco_projeto SET desc_bloco_projeto = '$descBlocoProjeto', status_bloco_projeto = '$statusBlocoProjeto' WHERE id_bloco_projeto = '$idBlocoProjetoSelecionado'");

	$editarBlocoProjeto->execute();

	header('Location: ../View/viewPaginaProjeto.php?id='.$idProjeto);
	echo "<script>document.location='../viewPaginaProjeto.php?id='.$idProjeto.</script>";	
?>