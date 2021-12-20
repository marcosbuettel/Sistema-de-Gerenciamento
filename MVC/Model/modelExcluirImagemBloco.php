<?php 
	//ARQUIVO PARA EXCLUIR A IMAGEM DO BLOCO DO CALENDÁRIO
	
	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];
	$idBlocoCalendario = $_GET['idB'];
	$idImagem = $_GET['idI'];
	
	$excluirImagem = $pdo->prepare("DELETE FROM imagens_bloco WHERE id_imagem_bloco = '$idImagem'");

	$excluirImagem->execute();
	
	header('Location: ../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario);
	echo "<script>document.location='../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario'</script>";
?>