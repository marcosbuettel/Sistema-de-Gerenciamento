<?php 
	//PÁGINA PARA VISUALIZAR TODOS OS PROJETOS
	//EM FORMA DE QUADRO
	

	include_once("../View/viewHead.php");
?>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA
		OS USUARIOS TIPO 'LEITOR' TEM
		SUA PRÓPRIA PÁGINA SEPARADA PARA 
		VER SEUS PROJETOS -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	<!-- TROCAR ESSE IF PELO DO USUARIO LOGADO OU MARCADO NO PROJETO -->
	<section class="nav-painel separador">
		
		<ul>		
			<li>Fluxos</li>
		</ul>

	</section>

	<section class="calendario-box-wrapper separador tabela-box-wrapper">

		<br>

		<div class="opcoes-quadro-projetos-wrapper">
		
			<?php 
				$opcoes = array('FLUXO MACRO - IDENTIDADE VISUAL', 'FLUXO MACRO - MARKETING ORGÂNICO', 'FLUXO MACRO - MARKETING PERFORMANCE', 'FLUXO MACRO - WEB SITE E-COMMERCE', 'FLUXO MACRO - SITE INSTITUCIONAL');

				for($i = 0; $i < 5; $i++){			
			?>

			<!-- 
				TIPOS PASSADOS PELO LINK:
				0 -> IDENTIDADE VISUAL
				1 -> MARKETING ORGÂNICO
				2 -> MARKETING PERFORMANCE
				3 -> ECOMMERCE
				4 -> INSTITUCIONAL			
			-->

			<a href="viewAndamentoProjetos.php?tipo=<?php echo $i?>">
				<div class="opcoes-quadro-projetos">
				
				<?php if($i == 0){ ?>
					
					<i class="fa-solid fa-id-badge"></i>
				
				<?php }else if($i == 1){ ?>
				
					<i class="fa-solid fa-person"></i>

				<?php }else if($i == 2){ ?>
					
					<i class="fa-solid fa-lightbulb"></i>

				<?php }else if($i == 3){ ?>
					
					<i class="fa-solid fa-comment-dollar"></i>

				<?php }else{ ?>
					
					<i class="fa-solid fa-copy"></i>

				<?php } ?>					

					<p><?php echo $opcoes[$i]?></p>

				</div>		
			</a>
			<?php }?>

		</div>

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
			
		
	</script>

<?php }else{?>
	<!-- CASO O USUARIO LOGADO NÃO SEJA 'ADM' OU 'MASTER'
		E TAMBÉM NÃO SEJA O CLIENTE QUE ESTEJA LIGADO
		A ESSE CALENDARIO, ELE VERÁ ESSA MENSAGEM NA TELA -->
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>