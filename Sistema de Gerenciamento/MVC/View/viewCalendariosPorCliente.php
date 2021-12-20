<?php 
	//PÁGINA ONDE CADA CLIENTE IRÁ VER OS SEUS CALENDÁRIOS

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");
	include_once("../Model/modelVerificarClienteLogado.php");
	$idCliente = $totalCalendarios[0]['id_cliente'];	
	include_once("../Model/modelClienteCalendario.php");
?>
	
<section class="nav-painel separador">
	
	<ul>		
		<li>Seus calendários</li>
	</ul>

</section>

<section class="separador calendarios-visao-clientes">
	<?php 
		for($i = 0; $i < count($totalClienteCalendario); $i++){
			
			$idCalendario = $totalClienteCalendario[$i]['id_calendario'];

			include('../Model/modelBlocoCalendarioAtivo.php');

			if($totalClienteCalendario[$i]['arquivado_calendario'] != 1){
	?>

	<a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>">
		<div class="calendario-cliente-info">
			<img src="../../images/ico-calendar5.png">
			<div class="mes-posts-calendario">
				<h2><?php echo $totalClienteCalendario[$i]['mes_calendario']?></h2>
				<h3>POSTS: <?php echo count($totalBlocoAtivo)?></h3>
			</div>
		</div>
	</a>
	<?php }}?>
	

</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

<script type="text/javascript">
	
	function cadastroCalendario(){
		$('.janela-modal-cadastro').css('display', 'block');
		$('body').css('background-color', 'rgba(0,0,0,0.5)');
		$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
	}


	function fecharJanelaModal(){
		$('.janela-modal-cadastro').css('display', 'none');	
		$('body').css('background-color', '#F5F5F5');
		$('tr:nth-child(2n)').css('background-color', 'white');
	}

	function confirmarExcluir(idCalendario){
		var idCalendario = idCalendario;
        var doc; 
        var result = confirm("Confirmar exclusão do calendário?"); 

        if (result == true) { 
            doc = "../Model/modelExcluirCalendario.php?id="+idCalendario; 
        } else { 
            doc = "viewCalendarios.php"; 
        } 

        window.location.replace(doc);
	}
</script>

<?php 
	include_once("../View/viewFooter.php");	
?>