<?php 
	//ARQUIVO PARA CADASTRO DE NOVA TAREFA QUE 
	//VAI DIRETO PARA O QUADRO

	session_start();
	include_once("modelBancoDeDados.php");

	//$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$nomeCliente = $_POST['nome-cliente'];

	$verificaClienteLogado = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$nomeCliente'");
	$verificaClienteLogado->execute();
	$totalClienteLogado = $verificaClienteLogado->fetchAlL(); 

	//$idBlocoCalendario = null;	
	//$usuarioLogado = $_SESSION['nome'];
	$idCliente = $totalClienteLogado[0]['id_cliente'];

	$tituloSolicitacao = $_POST['titulo-solicitacao'];
	$tipoSolicitacao = $_POST['tipo-solicitacao'];
	$descSolicitacao = $_POST['descricao-solicitacao'];
	$prazoSolicitacao = $_POST['prazo-solicitacao'];
	$dataAtual = date('d/m/Y H:i');

	$cadastrarSolicitacao = $pdo->prepare("INSERT INTO solicitacao_cliente (id_cliente_solicitacao_cliente, nome_cliente_solicitacao, titulo_solicitacao_cliente, tipo_solicitacao_cliente, descricao_solicitacao_cliente, prazo_solicitacao_cliente, data_solicitacao_cliente, status_solicitacao_cliente) VALUES ('$idCliente','$nomeCliente', '$tituloSolicitacao', '$tipoSolicitacao', '$descSolicitacao', '$prazoSolicitacao', '$dataAtual', 'solicitado')");

	$cadastrarSolicitacao->execute();

	//ATÉ AQUI ESTOU CADASTRANDO A SOLICITAÇÃO E VOU CADASTRAR A TAREFA AGORA

	$cadastrarTarefa = $pdo->prepare("INSERT INTO tarefa (nome_cliente_tarefa, prazo_tarefa, tipo_tarefa, descricao_tarefa) VALUES ('$nomeCliente', '$prazoSolicitacao', 'producao', '$descSolicitacao')");

	$cadastrarTarefa->execute();

	//VERIFICANDO QUAL A ULTIMA TAREFA PARA PEGAR O SEU ID E 
	//COLOCAR EM TODOS OS BLOCOS REFERENTES A ESSA TAREFA 
	$verificaTarefa = $pdo->prepare("SELECT * FROM tarefa");
	$verificaTarefa->execute();
	$totalTarefas = $verificaTarefa->fetchAlL();

	for($i = 0; $i < count($totalTarefas); $i++){		
	} 

	$i--;

	$idTarefa = $totalTarefas[$i]['id_tarefa'];

	$verificaSolicitacao = $pdo->prepare("SELECT * FROM solicitacao_cliente");
	$verificaSolicitacao->execute();
	$totalSolicitacao = $verificaSolicitacao->fetchAlL();

	for($i = 0; $i < count($totalSolicitacao); $i++){		
	} 

	$i--;

	$idSolicitacao = $totalSolicitacao[$i]['id_solicitacao_cliente'];
	
	
	$editarSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET id_tarefa = '$idTarefa', status_solicitacao_cliente = 'producao' WHERE id_solicitacao_cliente = '$idSolicitacao'");		

	$editarSolicitacao->execute();


	echo "<script>document.location='../View/viewQuadroTarefas.php'</script>";
?>