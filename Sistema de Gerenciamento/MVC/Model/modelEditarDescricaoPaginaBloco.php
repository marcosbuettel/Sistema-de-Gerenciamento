<?php
	//ARQUIVO PARA EDITAR A DESCRIÇÃO DO BLOCO DO CALENDÁRIO
	//QUANDO ESTIVER DENTRO DA PÁGINA DO BLOCO
	
	include_once("modelBancoDeDados.php");
	
	$idBlocoCalendario = $_GET['idB'];
	$idCalendario = $_GET['id'];

	$descricaoBloco = $_POST['descricao-bloco-editar'];

	$editarDescricaoBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET descricao_bloco_calendario = '$descricaoBloco' WHERE id_bloco_calendario = '$idBlocoCalendario'");

	$editarDescricaoBlocoCalendario->execute();

	header('Location: ../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario);

	echo "<script>document.location='../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario.</script>";
?>