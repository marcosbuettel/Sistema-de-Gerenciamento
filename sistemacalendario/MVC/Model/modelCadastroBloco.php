<?php 
	include_once("modelBancoDeDados.php");

	$tipo = $_GET['tipo'];

	$idCalendario = $_POST['id-calendario'];
	$semanaBloco = $_POST['semana-bloco'];
	$diaBloco = $_POST['dia-bloco'];

	if($tipo == 0){
		$tipoBloco = $_POST['tipo-bloco'];		
		$temaBloco = $_POST['tema-bloco'];
		if(isset($_POST['etapa-bloco'])){
			$etapaBloco = $_POST['etapa-bloco'];
		}else{
			$etapaBloco = null;
		}
		$mesBloco = $_POST['mes-do-bloco'];
	}else{
		$tipoBloco = null;
		$temaBloco = null;
		$etapaBloco = null;
		$mesBloco = null;
	}	

	$diaDoBloco = $_POST['dia-do-bloco'];
	$mesBloco = $_POST['mes-do-bloco'];
	$descricaoBloco = $_POST['descricao-bloco'];
	
	$cadastrarBloco = $pdo->prepare("INSERT INTO bloco_calendario (id_calendario, tipo_bloco_calendario, dia_bloco_calendario, mes_bloco_calendario, tema_bloco_calendario, producao_bloco_calendario, descricao_bloco_calendario, dia_semana_bloco_calendario, numero_semana_bloco_calendario) VALUES ('$idCalendario', '$tipoBloco', '$diaDoBloco', '$mesBloco', '$temaBloco', '$etapaBloco', '$descricaoBloco', '$diaBloco', '$semanaBloco')");
	

	$cadastrarBloco->execute();
	
	header('Location: ../View/viewPaginaCalendario.php?id='.$idCalendario);

	//echo "<script>document.location='../View/viewPaginaCalendario.php?id='.$idCalendario.</script>";
?>