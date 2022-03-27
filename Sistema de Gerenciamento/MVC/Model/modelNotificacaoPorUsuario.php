<?php 
	//ARQUIVO PARA CADASTRAR AS NOTIFICAÇÕES PARA CADA USUARIO
	
	//FUNCIONA DA SEGUINTE FORMA:
	//DEPOIS DE UMA AÇÃO SER CONCLUÍDA NO SISTEMA, UMA NOTIFICAÇÃO É
	//SALVA NA TABELA "NOTIFICACAO". PORÉM APÓS ISSO, PRECISA
	//SER CRIADA UMA SOLICITAÇÃO NUMA TABELA SEPARADA
	//PARA CADA USUÁRIO QUE TENHA
	//LIGAÇÃO COM ESSA SOLICITAÇÃO.

	//POR EXEMPLO: SE UM CLIENTE FEZ UMA AÇÃO, COMO APROVAR UMA ARTE
	//É GERADA UMA NOTIFICAÇÃO, ENTÃO OS USUÁRIOS DO TIPO "ADM" E "MASTER"
	//PRECISAM VER ESSA NOTIFICAÇÃO. LOGO PRECISA SER GERADA UMA SOLICITAÇÃO
	//PARA CADA USUÁRIO SEPARADAMENTE
	
	include_once("modelNotificacao.php");

	$idClienteAtual = $idCliente;
	$idNotificacaoCliente = $totalNotificacao[0]['id_cliente'];
	
	include_once("modelUsuarios.php");
	include_once("modelNotificacaoCliente.php");

	$nomeClienteNotificacao = $totalClientesNotificacao[0]['nome_cliente'];


	$idNotificacao = $totalNotificacao[0]['id_notificacao'];

	$dataAtual = date('d/m/Y');

	//AQUI SERÁ PERCORRIDO TODOS OS USUÁRIOS DO SISTEMA
	for($i = 0; $i < count($totalUsuarios); $i++){

		$idUsuario = $totalUsuarios[$i]['id_usuario'];
		$idUsuarioNotificacao = $totalNotificacao[0]['id_usuario'];
		$tipoUsuario = $totalUsuarios[$i]['tipo_usuario'];
		$nomeCliente = $totalUsuarios[$i]['nome_cliente'];

		//NESSE PONTO VERIFICO O TIPO DO USUARIO
		//SE ELE FOR "ADM" OU "MASTER", A NOTIFICAÇÃO SERÁ
		//SALVA PRA ELE
		//SE ELE FOR O CLIENTE QUE TEM LIGAÇÃO COM A AÇÃO FEITA
		//A NOTIFICAÇÃO TAMBÉM SERÁ SALVA PRA ELE

		

		if($idUsuarioNotificacao != $idUsuario){
			if($tipoUsuario == 'cliente' and $nomeCliente == $nomeClienteNotificacao){

				$cadastrarNotificacaoPorUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$idNotificacao', '$idUsuario', '1','$dataAtual')");
				$cadastrarNotificacaoPorUsuario->execute();
			}else if($tipoUsuario == 'adm' or $tipoUsuario == 'master'){
				/*****************************************************************/
				//PARTE PARA VERIFICAR SE O USUARIO ESTÁ SEGUINDO O CLIENTE ANTES
				//DA NOTIFICAÇÃO SER CADASTRADA PRA ELE

				$verificarUsuarioCliente = $pdo->prepare("SELECT * FROM usuario_cliente WHERE id_usuario = '$idUsuario' AND id_cliente = '$idNotificacaoCliente'");	
				
				$verificarUsuarioCliente->execute();
				$totalUsuarioCliente = $verificarUsuarioCliente->fetchAlL(); 
				/*****************************************************************/
				
				if(isset($totalUsuarioCliente[0]['status_usuario_cliente'])){
					if($totalUsuarioCliente[0]['status_usuario_cliente'] == 1){
						$cadastrarNotificacaoPorUsuario = $pdo->prepare("INSERT INTO notificacao_usuario (id_notificacao, id_usuario, vista_notificacao, data_notificacao) VALUES ('$idNotificacao', '$idUsuario', '1','$dataAtual')");
							$cadastrarNotificacaoPorUsuario->execute();
					}
				}
			}
		}

		
	}

?>