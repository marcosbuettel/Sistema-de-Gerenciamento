<?php 
	//ARQUIVO PARA CADASTRO DE NOVA TAREFA QUE 
	//VAI DIRETO PARA O QUADRO

	session_start();
	include_once("modelBancoDeDados.php");

	//$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	//$nomeCliente = $_POST['nome-cliente'];

	/*$verificaClienteLogado = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$nomeCliente'");
	$verificaClienteLogado->execute();
	$totalClienteLogado = $verificaClienteLogado->fetchAlL(); */

	//$idBlocoCalendario = null;	
	//$usuarioLogado = $_SESSION['nome'];
	//$idCliente = $totalClienteLogado[0]['id_cliente'];

	$tituloAgendamento = $_POST['titulo-agendamento'];
	$nomeCliente = $_POST['nome-cliente'];
	$tipoAgendamento = $_POST['tipo-agendamento'];
	$descricaoAgendamento = $_POST['descricao-agendamento'];
	$dataAgendamento = $_POST['data-agendamento'];

	$cadastrarAgendamento = $pdo->prepare("INSERT INTO agendamento (titulo_agendamento, cliente_agendamento, descricao_agendamento, tipo_agendamento, data_agendamento) VALUES ('$tituloAgendamento', '$nomeCliente', '$descricaoAgendamento', '$tipoAgendamento', '$dataAgendamento')");

	$cadastrarAgendamento->execute();

	echo "<script>document.location='../View/viewAgenda.php'</script>";
?>