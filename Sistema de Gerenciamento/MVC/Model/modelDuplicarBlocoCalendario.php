<?php 
	//ARQUIVO PARA DUPLICAR UM BLOCO JÁ CRIADO NO CALENDÁRIO
	//PRIMEIRO EU PEGO AS INFORMAÇÕES DO BLOCO QUE DESEJO DUPLICAR PELO ID DELE
	//DEPOIS EU PEGO O DIA E A SEMANA DO BLOCO ONDE ESSAS INFORMAÇÕES SERÃO INSERIDAS

	include_once("modelBancoDeDados.php");

	$idCalendario = $_GET['idC'];
	$idBlocoCopiado = $_GET['idB'];
	$diaBloco = $_GET['diaB'];
	$semanaBloco = $_GET['semanaB'];

	//AQUI EU PEGO AS INFORMAÇÕES DO BLOCO QUE QUERO COPIAR PELO ID DELE
	$blocoCopiado = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_bloco_calendario = '$idBlocoCopiado'");
	$blocoCopiado->execute();
	$totalBlocoCopiado = $blocoCopiado->fetchAll();

	$tipoBloco = $totalBlocoCopiado[0]['tipo_bloco_calendario'];
	$diaBlocoCalendario = $totalBlocoCopiado[0]['dia_bloco_calendario'];
	$mesBlocoCalendario = $totalBlocoCopiado[0]['mes_bloco_calendario'];
	$prazoBloco = $totalBlocoCopiado[0]['prazo_bloco_calendario'];
	$temaBloco = $totalBlocoCopiado[0]['tema_bloco_calendario'];
	$descricaoBloco = $totalBlocoCopiado[0]['descricao_bloco_calendario'];
	$statusBloco = $totalBlocoCopiado[0]['producao_bloco_calendario'];

	$temaAprovadoBloco = $totalBlocoCopiado[0]['tema_aprovado_bloco_calendario'];
	$arteBloco = $totalBlocoCopiado[0]['arte_aprovado_bloco_calendario'];
	$legendaBloco = $totalBlocoCopiado[0]['legenda_aprovado_bloco_calendario'];

	
	//CADASTRANDO O NOVO BLOCO COM AS INFORMAÇÕES DO BLOCO DUPLICADO
	
	$duplicarBlocoCalendario = $pdo->prepare("INSERT INTO bloco_calendario (id_calendario, tipo_bloco_calendario, dia_bloco_calendario, mes_bloco_calendario, prazo_bloco_calendario,tema_bloco_calendario, descricao_bloco_calendario, dia_semana_bloco_calendario, numero_semana_bloco_calendario, tema_aprovado_bloco_calendario, arte_aprovado_bloco_calendario, legenda_aprovado_bloco_calendario, producao_bloco_calendario) VALUES ('$idCalendario', '$tipoBloco', '$diaBlocoCalendario', '$mesBlocoCalendario', '$prazoBloco', '$temaBloco', '$descricaoBloco', '$diaBloco', '$semanaBloco', '$temaAprovadoBloco', '$arteBloco', '$legendaBloco', '$statusBloco')");

	$duplicarBlocoCalendario->execute();


	//AQUI EU BUSCO O ID DO BLOCO QUE ACABOU DE SER CRIADO
	//COM ESSE ID, IREI COPIAR AS IMAGENS DO BLOCO QUE FOI DUPLICADO
	//PARA O BLOCO ATUAL
	$buscarBlocoAtual = $pdo->prepare("SELECT * FROM bloco_calendario ORDER BY id_bloco_calendario DESC");
	$buscarBlocoAtual->execute();

	$totalBlocoAtual = $buscarBlocoAtual->fetchAll();

	$idBlocoAtual = $totalBlocoAtual[0]['id_bloco_calendario'];



	//BUSCANDO TODAS AS IMAGENS QUE PERTENCEM AO BLOCO QUE ESTÁ SENDO COPIADO
	$buscarImagensBlocoDuplicado = $pdo->prepare("SELECT * FROM imagens_bloco WHERE id_bloco_calendario = '$idBlocoCopiado'");

	$buscarImagensBlocoDuplicado->execute();
	$totalImagens = $buscarImagensBlocoDuplicado->fetchAll();

	//PERCORRENDO TODAS AS IMAGENS E CADASTRANDO ELAS PARA O BLOCO QUE FOI DUPLICADO
	for($i = 0; $i < count($totalImagens); $i++){
		$urlImagemBloco = $totalImagens[$i]['nome_imagem_bloco'];

		$cadastrarImagensBlocoAtual = $pdo->prepare("INSERT INTO imagens_bloco (id_bloco_calendario, nome_imagem_bloco) VALUES ('$idBlocoAtual', '$urlImagemBloco')");

		$cadastrarImagensBlocoAtual->execute();
	}

	
	header('Location: ../View/viewPaginaCalendario.php?id='.$idCalendario);

	echo "<script>document.location='../View/viewPaginaCalendario.php?id='.$idCalendario.</script>";
?>