<?php 
	//ARQUIVO PARA CADASTRO DE COMENTARIOS DENTRO DOS BLOCOS

	session_start();
	include_once("modelBancoDeDados.php");
	//require '../../vendor/autoload.php';	

	$idCalendario = $_SESSION['idCalendario'];
	$idBlocoCalendario = $_SESSION['idBlocoCalendario'];
	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$usuarioLogado = $_SESSION['nome'];
	$idCliente = $_SESSION['idCliente'];

	$comentario = $_POST['comentario-bloco'];
	
	if(isset($_POST['aprovacao'])){
		$aprovacaoBloco = $_POST['aprovacao'];
	}

	$cadastrarComentario = $pdo->prepare("INSERT INTO comentario_bloco_calendario (id_bloco_calendario, id_usuario_comentario_bloco_calendario,usuario_comentario_bloco_calendario, descricao_comentario_bloco_calendario) VALUES ('$idBlocoCalendario', '$idUsuarioLogado','$usuarioLogado', '$comentario')");

	$cadastrarComentario->execute();

	$verificaComentarioBlocoCalendario = $pdo->prepare("SELECT * FROM comentario_bloco_calendario");
	$verificaComentarioBlocoCalendario->execute();
	$totalComentarioBlocoCalendario = $verificaComentarioBlocoCalendario->fetchAlL(); 

	//ESSE FOR É PARA PEGAR O ÚLTIMO ID DO COMENTARIO, JÁ QUE O ID DO
	//COMENTARIO NÃO PREENCHE AUTOMATICAMENTE
	for($j = 0; $j < count($totalComentarioBlocoCalendario); $j++){
		$idComentarioImagem = $totalComentarioBlocoCalendario[$j]['id_comentario_bloco_calendario'];
	}
	
	//TODA ESSA PARTE ESTÁ COMENTADA, POIS ANTES PODERIA SER ENVIADO
	//IMAGENS NO COMENTARIO. SE CASO PRECISAR, SÓ USAR O CÓDIGO ABAIXO

	/*use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;	

	$bucketName = 'deploy-arpoador';
	$IAM_KEY = 'AKIAREY7JX52VPRLVVWT';
	$IAM_SECRET = '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';

	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'us-east-1'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}

	if(!empty($_FILES["fileToUpload"]['name'][0])){
		
		for($i=0; $i<count($_FILES["fileToUpload"]['name']); $i++) {   
			// For this, I would generate a unqiue random string for the key name. But you can do whatever.
			$keyName = 'iSeven/' . basename($_FILES["fileToUpload"]['name'][$i]);
			$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

			// Add it to S3
			try {
				// Uploaded:
				$file = $_FILES["fileToUpload"]['tmp_name'][$i]; //NOME TEMP DO ARQUIVO NO SERVIDOR

				$s3->putObject(
					array(
						'Bucket'=>$bucketName,
						'Key' =>  $keyName,
						'SourceFile' => $file,
						'StorageClass' => 'REDUCED_REDUNDANCY'
					)
				);

			} catch (S3Exception $e) {
				die('Error:' . $e->getMessage());
			} catch (Exception $e) {
				die('Error:' . $e->getMessage());
			}

			$linkImg = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

			$cadastrarImagem = $pdo->prepare("INSERT INTO imagens_comentario (id_comentario_bloco_calendario ,nome_imagem_comentario ) VALUES ('$idComentarioImagem','$linkImg')");

			$cadastrarImagem->execute();
		}
	}*/

	if(isset($aprovacaoBloco)){
		if($_SESSION['tipo-usuario'] == 'leitor'){
			$atualizaAprovacaoBloco = $pdo->prepare("UPDATE bloco_calendario SET aprovado_bloco_calendario = '$aprovacaoBloco' WHERE id_bloco_calendario = $idBlocoCalendario");

			$atualizaAprovacaoBloco->execute();	
		}
	}

	//ESSE IF NÃO ESTA SENDO USADO MAIS
	//ANTES EXISTIA APROVAÇÃO PELO COMENTARIO
	//AGORA A APROVAÇÃO É FORA DO COMENTARIO
	if($_SESSION['tipo-usuario'] == 'leitor'){
		if(isset($aprovacaoBloco)){
			if($aprovacaoBloco == 1){
				$tipoNotificacao = 'aprovado';
			}else if($aprovacaoBloco == 2){
				$tipoNotificacao = 'reprovado';
			}	
		}else{
			$tipoNotificacao = 'comentário';
		}
	}else{
		$tipoNotificacao = 'comentário';
	}

	$novaNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_bloco_calendario, id_cliente, tipo_notificacao, vista_notificacao) VALUES ('$idUsuarioLogado', '$idBlocoCalendario', '$idCliente', '$tipoNotificacao', '1')");

	$novaNotificacao->execute();

	include_once("modelNotificacaoPorUsuario.php");
	//USAR ATÉ AQUI PARA A SOLICITAÇÃO

	header('Location: ../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario);

?>