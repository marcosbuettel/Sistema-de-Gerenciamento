<?php 
	include_once("modelBancoDeDados.php");

	$atualizarStatus = $pdo->prepare("UPDATE usuarios SET logado_usuario = '1' WHERE id_usuario = '$idUsuarioLogado'");

	$atualizarStatus->execute();

	//header('Location: ../View/viewPaginaCalendario.php?id='.$idCalendario);

	//echo "<script>document.location='../View/viewPaginaCalendario.php?id='.$idCalendario.</script>";
?>