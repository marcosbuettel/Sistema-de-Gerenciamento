<?php 
	//ARQUIVO PARA CADASTRO DAS TAREFAS QUE TEM LIGAÇÃO COM O PROJETO
	session_start();
	include_once("modelBancoDeDados.php");

	$idProjeto = $_GET['idP'];
	$criadorTarefa = $_SESSION['id-usuario-logado']; 
	$nomeTarefa = $_POST['nome-tarefa'];
	$responsavelTarefa = $_POST['responsavel-tarefa'];
	$tipoTarefa = $_POST['tipo-tarefa'];
	$prioridadeTarefa = $_POST['prioridade-tarefa'];
	$prazoTarefa = $_POST['prazo-tarefa'];
	$descricaoTarefa = $_POST['descricao-tarefa'];

	$cadastrarTarefaProjeto = $pdo->prepare("INSERT INTO tarefa_projeto (id_projeto, nome_tarefa_projeto, tipo_tarefa_projeto, prioridade_tarefa_projeto, id_usuario, responsavel_tarefa_projeto, prazo_tarefa_projeto, descricao_tarefa_projeto) VALUES ('$idProjeto', '$nomeTarefa', '$tipoTarefa', '$prioridadeTarefa','$criadorTarefa', '$responsavelTarefa','$prazoTarefa', '$descricaoTarefa')");

	$cadastrarTarefaProjeto->execute();


	
	//PARTE PARA CADASTRAR A NOTIFICAÇÃO PARA O USUÁRIO RESPONSÁVEL PELA TAREFA

	$buscarIdUsuario = $pdo->prepare("SELECT * FROM usuarios WHERE nome_usuario = '$responsavelTarefa'");
	$buscarIdUsuario->execute();
	$totalIdUsuario = $buscarIdUsuario->fetchAll();

	$idUsuarioResponsavel = $totalIdUsuario[0]['id_usuario'];

	
	$cadastrarNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_cliente, tipo_notificacao, vista_notificacao) VALUES ('$idUsuarioResponsavel', '$idProjeto', 'nova-tarefa', '1')");
	$cadastrarNotificacao->execute();

	$dataAtual = date('d/m/Y');

	$buscarUltimaNotificacao = $pdo->prepare("SELECT * FROM notificacao ORDER BY id_notificacao DESC");
	$buscarUltimaNotificacao->execute();
	$totalUltimaNotificacao = $buscarUltimaNotificacao->fetchAll();

	$idNotificacao = $totalUltimaNotificacao[0]['id_notificacao'];

	$cadastrarNotificacaoPorUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$idNotificacao', '$idUsuarioResponsavel', '1','$dataAtual')");
	$cadastrarNotificacaoPorUsuario->execute();


	echo "<script>document.location='../View/viewProjetos.php'</script>";
?>