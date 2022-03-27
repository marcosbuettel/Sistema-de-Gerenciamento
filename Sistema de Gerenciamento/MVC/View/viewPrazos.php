<?php 
	//PÁGINA PARA MOSTRAR O OUTRO TIPO DE CALENDÁRIO
	//QUE MOSTRA MENOS OPÇÕES

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>PRAZOS</li>
			<li><a href="#" onclick="cadastroCalendario()">NOVA PLANILHA</a></li>
		</ul>

	</section>

	<!--<section class="botao-cadastro-cliente separador">
		
	</section>-->

	<section class="calendario-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
				<th>Calendário</th>
				<th>Cliente Referente</th>
				<th>Quantidade de Semanas</th>
				<th>Usuário Responsável</th>
				<th>Data de Criação</th>
			</tr>
			<?php 
				include_once("../Model/modelCalendarios.php");
				for ($i=0; $i < count($totalCalendarios) ; $i++){
					$idCalendario = $totalCalendarios[$i]['id_calendario']; 
			?>

			<?php if($totalCalendarios[$i]['arquivado_calendario'] != 1 && $totalCalendarios[$i]['planilha_calendario'] != null){?>

			<tr>
				

				<td><a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><?php echo $totalCalendarios[$i]['mes_calendario']?></a>
					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>	
					<div class="primeira-coluna-tabela">
						<div class="botao-editaExclui-cliente">
							<a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><i onmouseover="exibeFuncao('view', <?php echo $idCalendario?>)" class="far fa-eye"></i>
								<div class="icones-acao" id="view<?php echo $idCalendario?>">VISUALIZAR</div>
							</a>

							<a href="../Model/modelArquivarCalendario.php?id=<?php echo $idCalendario?>"><i onmouseover="exibeFuncao('arquivar', <?php echo $idCalendario?>)" class="far fa-folder-open"></i>
								<div class="icones-acao" id="arquivar<?php echo $idCalendario?>">ARQUIVAR</div>
							</a>

							<a href="viewEditarCalendario.php?id=<?php echo $idCalendario?>"><i onmouseover="exibeFuncao('editar', <?php echo $idCalendario?>)" class="far fa-edit"></i>
								<div style="left: 50px;" class="icones-acao" id="editar<?php echo $idCalendario?>">EDITAR</div>
							</a>

							<i onmouseover="exibeFuncao('excluir', <?php echo $idCalendario?>)" class="far fa-trash-alt" onclick="confirmarExcluir(<?php echo $idCalendario?>)" class="far fa-trash-alt" onclick="confirmarExcluir(<?php echo $idCalendario?>)">
								<div class="icones-acao" id="excluir<?php echo $idCalendario?>">EXCLUIR</div>
							</i>
							<!--<a href="#" onclick="confirmarExcluir(<?php echo $idCalendario?>)">Excluir</a>-->
						</div>
					</div>
				<?php }?>
				</td>

				<?php 
					$idCliente = $totalCalendarios[$i]['id_cliente'];
					include("../Model/modelCalendarioCliente.php");
				?>

				<td><?php echo $totalCalendarioCliente[0]['nome_cliente']?></td>

				<td><?php echo $totalCalendarios[$i]['qtd_semanas_calendario']?></td>
				<td><?php echo $totalCalendarios[$i]['usuario_calendario']?></td>
				<td><?php echo $totalCalendarios[$i]['data_criacao_calendario']?></td>
			</tr>
		
			<?php } }?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo calendário</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelCadastroCalendario.php?tipo=1">

					<div class="form-box">
						<div>
							<label>Mês do calendário:</label><br>
							<input type="text" placeholder="Mês do calendário" name="mes-calendario" style="text-align: center; width: 200px"><br>
						</div>

						<div>
							<label>Cliente:</label><br>
							<select name="nome-cliente">
								<?php 
									include_once("../Model/modelClientes.php");
									$dataAtual = date('d/m/Y');

									for ($i=0; $i < count($totalClientes); $i++){						
								?>
								<option value="<?php echo $totalClientes[$i]['nome_cliente']?>"><?php echo $totalClientes[$i]['nome_cliente']?></option>
								<?php }?><!-- FIM DO FOR DO SELECT -->
							</select>
						</div>
					</div>

					<br>

					<div class="form-box">
						<div>
							<label>Número de semanas:</label><br>
							<input type="number" min="1" name="qtd-semanas-calendario" style="text-align: center; padding: 10px!important; width: 80px"><br>
						</div>

						<div>
							<label>Usuário:</label><br>
							<input type="text" name="usuario-calendario" readonly value="<?php echo strtoupper($_SESSION['login'])?>" style="text-align: center; width: 250px"><br>
						</div>
					</div>
					<label>Data de criação:</label><br>
					<input type="text" name="data-criacao-calendario" readonly value="<?php echo $dataAtual?>" style="text-align: center"><br>

					<button>CONFIRMAR</button>
				</form>
			</div>
		</div>	

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

		function exibeFuncao(funcao, id){
			if(funcao == 'view'){
				$('#view'+id).css('display', 'block');
			}else if(funcao == 'arquivar'){
				$('#arquivar'+id).css('display', 'block');
			}else if(funcao == 'editar'){
				$('#editar'+id).css('display', 'block');
			}else{
				$('#excluir'+id).css('display', 'block');
			}	
		}

		$('.botao-editaExclui-cliente i').mouseleave(function(){
			$('.icones-acao').css('display', 'none');
		});
	</script>

<?php }else{?>
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>