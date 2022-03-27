<?php 
	//PÁGINA PARA CADA CLIENTE PODER VER SEUS CALENDARIOS
	//QUE FORAM ARQUIVADOS

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
?>
	
<section class="nav-painel separador">
	
	<ul>		
		<li>Calendários Arquivados</li>
	</ul>

</section>

<section class="calendario-box-wrapper separador tabela-box-wrapper">
		
	<table class="tabela-box">
		<tr>
			<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
				<th></th>
			<?php }?>
			<th>Calendário</th>
			<th>Cliente Referente</th>
			<th>Quantidade de Semanas</th>
		</tr>
		<?php 
			include_once("../Model/modelCalendarios.php");

			for ($i=0; $i < count($totalCalendarios) ; $i++){
				$idCalendario = $totalCalendarios[$i]['id_calendario'];
		?>

		<?php 
			$idCliente = $totalCalendarios[$i]['id_cliente'];
			include("../Model/modelCalendarioCliente.php");

			if($_SESSION['nome-cliente'] == $totalCalendarioCliente[0]['nome_cliente']){
		?>

		<?php if($totalCalendarios[$i]['arquivado_calendario'] == 1){?>

		<tr>
			<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

			<td>
				<div class="botao-editaExclui-cliente">					
					<a href="viewEditarCalendario.php?id=<?php echo $idCalendario?>">Editar</a>
					<i class="far fa-trash-alt" onclick="confirmarExcluir(<?php echo $idCalendario?>)"></i>
					<a href="#" onclick="confirmarExcluir(<?php echo $idCalendario?>)">Excluir</a>
				</div>
			</td>
			<?php }?>

			<td><a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><i class="fas fa-calendar-check" style="font-size: 30px; margin-right: 10px; position: relative; top: 5px"></i><?php echo $totalCalendarios[$i]['mes_calendario']?></a></td>

			<td><?php echo $totalCalendarioCliente[0]['nome_cliente']?></td>

			<td><?php echo $totalCalendarios[$i]['qtd_semanas_calendario']?></td>
		</tr>
	
		<?php } } }?><!-- FIM DO FOR CLIENTES-BOX -->
	</table>

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
            window.location.replace(doc);
        }        
	}
</script>

<?php 
	include_once("../View/viewFooter.php");	
?>