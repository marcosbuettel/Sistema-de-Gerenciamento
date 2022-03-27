<?php 
	//ARQUIVO PARA CADASTRAR AS ARTES NO BLOCO
	//USO SISTEMA DA AWS (AMAZON) PARA ARMAZENAR AS IMAGENS
	//ASSIM NÃO IRÁ OCUPAR ESPAÇO NO BANCO DE DADOS
	//FAZENDO O SISTEMA FICAR MAIS LEVE

	session_start();
	include_once("modelBancoDeDados.php");
	require '../../vendor/autoload.php';

	$idCalendario = $_SESSION['idCalendario'];
	$idBlocoCalendario = $_SESSION['idBlocoCalendario'];
	$idUsuarioLogado = $_SESSION['id-usuario-logado'];
	$usuarioLogado = $_SESSION['nome'];
	$idCliente = $_SESSION['idCliente'];

	include_once('modelVerificarImagemBloco.php');

	//NESSA PARTE ESTOU VERIFICANDO SE JÁ TEM ALGUMA IMAGEM CADASTRADA
	//DENTRO DO BLOCO. SE JÁ TIVER, ELE IRÁ EXCLUIR TODAS E 
	//ARMAZENAR AS NOVAS
	/*if(count($totalImagemBloco) != 0){
		$excluirImagemBloco = $pdo->prepare("DELETE FROM imagens_bloco WHERE id_bloco_calendario = '$idBlocoCalendario'");

		$excluirImagemBloco->execute();
	}*/

	use Aws\S3\S3Client;
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
			$dataHoraAtual = date("Y-m-d H:i:s"); 
			$keyName = 'iSeven/' .$dataHoraAtual. basename($_FILES["fileToUpload"]['name'][$i]);
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
			$linkFormatadoImg = basename($_FILES["fileToUpload"]['name'][$i]);

			/*$cadastrarImagem = $pdo->prepare("INSERT INTO imagens_bloco (id_bloco_calendario , nome_imagem_bloco ) VALUES ('$idBlocoCalendario','$linkImg')");*/

			$cadastrarImagem = $pdo->prepare("INSERT INTO imagens_bloco (id_bloco_calendario , nome_imagem_bloco, nome_formatado_imagem_bloco ) VALUES ('$idBlocoCalendario','$linkImg', '$linkFormatadoImg')");

			$cadastrarImagem->execute();
		}
	}

	$tipoNotificacao = 'arte-cadastrada';

	$novaNotificacao = $pdo->prepare("INSERT INTO notificacao (id_usuario, id_bloco_calendario, id_cliente, tipo_notificacao, vista_notificacao) VALUES ('$idUsuarioLogado', '$idBlocoCalendario', '$idCliente', '$tipoNotificacao', '1')");

	$novaNotificacao->execute();

	include_once("modelNotificacaoPorUsuario.php");
	//USAR ATÉ AQUI PARA A SOLICITAÇÃO

	header('Location: ../View/viewPaginaCalendarioDescricao.php?id='.$idCalendario.'&idB='.$idBlocoCalendario);
	
	//header('Location: ../View/viewPaginaCalendario.php?id='.$idCalendario);
?>