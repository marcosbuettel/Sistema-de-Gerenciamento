<?php 
	session_start();

	include_once("modelBancoDeDados.php");

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];	
	$nomeUsuario = $_SESSION['nome'];

	$idTarefa = $_GET['id'];
	$dataComentario = date('Y-m-d');
	$descricaoComentario = $_POST['descricao-comentario'];

	$cadastrarComentarioTarefa = $pdo->prepare("INSERT INTO comentario_tarefa (id_usuario_comentario_tarefa, usuario_comentario_tarefa, data_comentario_tarefa, descricao_comentario_tarefa, id_tarefa) values ('$idUsuarioLogado', '$nomeUsuario', '$dataComentario', '$descricaoComentario', '$idTarefa')");

	$cadastrarComentarioTarefa->execute();

	/*
	NESSE BLOCO PEGAR O ID DA TAREFA E VERIFICAR SEU TÍTULO
	DEPOIS DISSO, CADASTRAR UMA NOTIFICAÇÃO NOVA COM O TÍTULO
	DESSA TAREFA
	DEPOIS CADASTRAR UMA NOTIFICACAO_USUARIO SÓ PARA O ID DO CAIO
	ID = 32
	*/

	$verificarTarefas = $pdo->prepare("SELECT * FROM tarefa WHERE id_tarefa = '$idTarefa'");
	$verificarTarefas->execute();
	$totalTarefas = $verificarTarefas->fetchAll();

	$tituloTarefa = $totalTarefas[0]['titulo_tarefa'];


	$cadastrarNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_bloco_calendario, id_tarefa, id_cliente, titulo_notificacao, tipo_notificacao, vista_notificacao) VALUES ('32', '0', '$idTarefa', '0', '$tituloTarefa', 'comentario-tarefa', '1')");
	$cadastrarNotificacao->execute();

	$verificarNotificacao = $pdo->prepare("SELECT * FROM notificacao ORDER BY id_notificacao DESC");
	$verificarNotificacao->execute();
	$totalNotificacao = $verificarNotificacao->fetchAll();

	$ultimaNotificacao = $totalNotificacao[0]['id_notificacao'];


	$dataAtual = date('Y-m-d');

	$cadastrarNotificacaoUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$ultimaNotificacao','31','1', '$dataAtual')");
	$cadastrarNotificacaoUsuario->execute();

	$cadastrarNotificacaoUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$ultimaNotificacao','32','1', '$dataAtual')");
	$cadastrarNotificacaoUsuario->execute();


	header("Location: ../View/viewTarefa.php?id=$idTarefa");
	echo "<script>document.location='../View/viewTarefa.php?id=$idTarefa'</script>";
?>