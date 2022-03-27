<?php 
	//ARQUIVO PARA CADASTRO DE TAREFAS QUE SÃO SOLICITAÇÕES
	include_once("modelBancoDeDados.php");
	
	$idSolicitacao = $_POST['id'];

	//CRIAR UMA FORMA DE COLETAR AS INFORMAÇÕES DA SOLICITAÇÃO
	//POR UMA BUSCA QUE IDENTIFICA O ID DA SOLICITAÇÃO

	$verificaSolicitacoesPorId = $pdo->prepare("SELECT * FROM solicitacao_cliente WHERE id_solicitacao_cliente = '$idSolicitacao'");
	$verificaSolicitacoesPorId->execute();
	$totalSolicitacoesPorId = $verificaSolicitacoesPorId->fetchAlL(); 

	$nomeCliente = $totalSolicitacoesPorId[0]['nome_cliente_solicitacao'];
	$tituloTarefa = $totalSolicitacoesPorId[0]['titulo_solicitacao_cliente'];
	$prazoTarefa = $totalSolicitacoesPorId[0]['prazo_solicitacao_cliente'];
	$descTarefa = $totalSolicitacoesPorId[0]['descricao_solicitacao_cliente'];

	$cadastrarTarefa = $pdo->prepare("INSERT INTO tarefa (nome_cliente_tarefa, titulo_tarefa, prazo_tarefa, tipo_tarefa, descricao_tarefa) VALUES ('$nomeCliente', '$tituloTarefa','$prazoTarefa', 'solicitacao', '$descTarefa')");

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
	
	
	$editarSolicitacao = $pdo->prepare("UPDATE solicitacao_cliente SET id_tarefa = '$idTarefa', status_solicitacao_cliente = 'producao' WHERE id_solicitacao_cliente = '$idSolicitacao'");		

	$editarSolicitacao->execute();

	//echo "<script>document.location='../View/viewTarefas.php'</script>";
?>