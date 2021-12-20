<?php 
	//ARQUIVO PARA EXCLUIR O COMENTARIO DO BLOCO DO CALENDARIO

	session_start();
	include_once("modelBancoDeDados.php");

	$idCalendario = $_SESSION['idCalendario'];
	$idComentario = $_GET['idComentario'];
	$idBlocoCalendario = $_SESSION['idBlocoCalendario'];
	
	$excluirComentario = $pdo->prepare("DELETE FROM comentario_bloco_calendario WHERE id_comentario_bloco_calendario = '$idComentario'");

	$excluirComentario->execute();
	
	header('Location: ../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario);
	//echo "<script>document.location='../View/viewCalendarios.php'</script>";
?>