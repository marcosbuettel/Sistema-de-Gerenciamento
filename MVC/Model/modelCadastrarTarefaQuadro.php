<?php 
	//ARQUIVO PARA CADASTRO DE TAREFAS
	include_once("modelBancoDeDados.php");
	
	$idCalendario = $_GET['id'];

	include_once("modelBlocoCalendarioAtivo.php");

	$periodoTarefa = $_GET['periodo'];
	$mesCalendario = $_GET['mes'];
	$nomeCliente = $_GET['nome'];
	$prazoTarefa = $_GET['prazo'];

	$cadastrarTarefa = $pdo->prepare("INSERT INTO tarefa (nome_cliente_tarefa, id_calendario, mes_calendario_tarefa, prazo_tarefa, p_tarefa) VALUES ('$nomeCliente', '$idCalendario','$mesCalendario', '$prazoTarefa', '$periodoTarefa')");

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
	
	if($periodoTarefa == 'p1'){
		$editarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET id_tarefa = '$idTarefa', status_tarefa = 'producao' WHERE numero_semana_bloco_calendario < 2 AND id_calendario = '$idCalendario'");
	}else{
		$editarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET id_tarefa = '$idTarefa', status_tarefa = 'producao' WHERE numero_semana_bloco_calendario > 1 AND id_calendario = '$idCalendario'");
	}	

	$editarBlocoCalendario->execute();

	echo "<script>document.location='../View/viewTarefas.php'</script>";
?>