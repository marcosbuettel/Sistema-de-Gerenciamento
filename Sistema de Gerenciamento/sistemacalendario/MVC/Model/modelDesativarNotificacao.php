<?php 
	session_start();

	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];
	$idBlocoCalendario = $_GET['idB'];
	$idNotificacaoAtiva = $_GET['idN'];

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];

	$notificacaoDesativada = $pdo->prepare("UPDATE notificacao_usuario SET vista_notificacao = 0 WHERE id_usuario = $idUsuarioLogado AND id_notificacao = $idNotificacaoAtiva");
	$notificacaoDesativada->execute();

	echo "<script>document.location='../View/viewPaginaCalendarioDescricao.php?id=$idCalendario&idB=$idBlocoCalendario'</script>";

?>