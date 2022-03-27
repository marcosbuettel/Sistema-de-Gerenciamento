<?php 
	session_start();
	include_once("modelBancoDeDados.php");

	$tipoAprovacao = $_GET['tipoAprovacao'];

	$idCalendario = $_GET['id'];

	$idBlocoCalendario = $_SESSION['idBlocoCalendario'];

	if($tipoAprovacao == 0){
		$aprovarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET tema_aprovado_bloco_calendario = '1' WHERE id_bloco_calendario = '$idBlocoCalendario'");	
		$tipoNotificacao = "tema-aprovado";
	}else if($tipoAprovacao == 1){
		$aprovarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET arte_aprovado_bloco_calendario = '1' WHERE id_bloco_calendario = '$idBlocoCalendario'");
		$tipoNotificacao = "arte-aprovada";	
	}else{
		$aprovarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET legenda_aprovado_bloco_calendario = '1' WHERE id_bloco_calendario = '$idBlocoCalendario'");
		$tipoNotificacao = "legenda-aprovada";
	}
	

	$aprovarBlocoCalendario->execute();

	//PARTE COM AS VARIÁVEIS QUE SÃO USADAS NO CADASTRO DA NOFITICAÇÃO
	$idCalendario = $_SESSION['idCalendario'];
	$idBlocoCalendario = $_SESSION['idBlocoCalendario'];
	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$usuarioLogado = $_SESSION['nome'];
	$idCliente = $_SESSION['idCliente'];
	

	$novaNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_bloco_calendario, id_cliente, tipo_notificacao, vista_notificacao) VALUES ('$idUsuarioLogado', '$idBlocoCalendario', '$idCliente', '$tipoNotificacao', '1')");

	$novaNotificacao->execute();
	
	include_once("modelNotificacaoPorUsuario.php");

	header('Location: ../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario);

?>