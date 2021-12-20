<?php 
	session_start();
	//ARQUIVO PARA CADASTRO DE NOVO PROJETO
	//AINDA NÃO ESTÁ SENDO USADO
	
	/*$tipoProjeto = $_POST['tipo-projeto'];
	$clienteProjeto = $_POST['nome-cliente'];
	$statusProjeto = $_POST['status-projeto'];
	$dataCriacaoProjeto = $_POST['data-criacao-projeto'];*/

	$tipoProjeto = 'MARKETING';
	$clienteProjeto = $idCliente;
	$statusProjeto = 'CALENDÁRIO CRIADO';
	$dataCriacaoProjeto = date('d-m-Y');

	$cadastrarProjeto = $pdo->prepare("INSERT INTO projeto (nome_projeto, id_cliente, status_projeto,data_inicial_projeto) VALUES ('$tipoProjeto', '$clienteProjeto', '$statusProjeto','$dataCriacaoProjeto')");

	$cadastrarProjeto->execute();

	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$tipoNotificacao = 'calendario-cadastrado';

	$novaNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_bloco_calendario, id_cliente, tipo_notificacao, vista_notificacao) VALUES ('$idUsuarioLogado', '0', '$idCliente', '$tipoNotificacao', '1')");

	$novaNotificacao->execute();

	include_once("modelNotificacaoPorUsuario.php");

	//echo "<script>document.location='../View/viewProjetos.php'</script>";
?>