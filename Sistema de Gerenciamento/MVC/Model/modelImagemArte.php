<?php
	//ARQUIVO PARA CADASTRO DE IMAGEM DA ARTE
	//NÃO ESTÁ SENDO USADO AINDA

	session_start();

	$idUsuario = $_SESSION['id'];
	require '../../vendor/autoload.php';
	include_once("modelBancoDeDados.php");
	
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

	// AWS Info
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

	
	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$dataHoraAtual = date("Y-m-d H:i:s"); 
	$keyName = 'iSeven/' .$dataHoraAtual. basename($_FILES["fileToUpload"]['name']);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUpload"]['tmp_name'];

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

	$atualizaItem = $pdo->prepare("UPDATE usuarios_teste SET foto_usuario = '$linkImg' WHERE id_usuario = '$idUsuario'");
					
	$atualizaItem->execute();

	echo "<script>document.location='../View/viewPerfilPrivado.php?tipoPerfil=baba'</script>";
?>