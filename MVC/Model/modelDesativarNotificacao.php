<?php 
	//ARQUIVO PARA COLOCAR A NOTIFICAÇÃO COMO VISTA
	//QUANDO ELA FOR CLICADA PELO USUARIO

	session_start();

	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['id'];

	$verificaTipo =  $_GET['idB'];

	if($verificaTipo != 'false'){
		$idBlocoCalendario = $_GET['idB'];
	}

	$idNotificacaoAtiva = $_GET['idN'];

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];

	//SETANDO A "vista_notificacao" NO BANCO DE DADOS
	//ELA NÃO SERÁ MAIS MARCADA COMO "NÃO LIDA"
	$notificacaoDesativada = $pdo->prepare("UPDATE notificacao_usuario SET vista_notificacao = 0 WHERE id_usuario = $idUsuarioLogado AND id_notificacao = $idNotificacaoAtiva");
	$notificacaoDesativada->execute();
	
	if($verificaTipo != 'false'){
		echo "<script>document.location='../View/viewPaginaCalendarioDescricao.php?id=$idCalendario&idB=$idBlocoCalendario'</script>";
	}else{
		echo "<script>document.location='../View/viewPaginaCalendario.php?id=$idCalendario'</script>";
	}

?>