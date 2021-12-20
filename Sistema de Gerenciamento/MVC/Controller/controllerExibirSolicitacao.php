<?php 
	//COLOCAR UMA DIV SÓ PRA EXIBIR AS INFORMAÇÕES 
	//DA SOLICITAÇÃO, MAS PEGAR OS PARÂMETROS DA FUNÇÃO
	//PRA VER QUAL INFORMAÇÃO SERÁ MOSTRADA

?>
<div class="bloco-solicitacao">
	<div style="display: flex; justify-content: space-between;">
		<h3><?php echo $totalSolicitacoes[$j]['titulo_solicitacao_cliente']?></h3>
		<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
			<a href="../Model/modelExcluirSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&cliente=<?php echo $nomeCliente?>"><i onmouseover="removerSolicitacao(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"class="far fa-trash-alt" class="lixeira"></i></a>
			<div class="remover-solicitacao" id="<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
				<p>REMOVER SOLICITAÇÃO</p>
			</div>
		<?php }?>
	</div>
	<h3>Tipo: <?php echo ucfirst($totalSolicitacoes[$j]['tipo_solicitacao_cliente'])?></h3>
	<h3><?php echo $totalSolicitacoes[$j]['descricao_solicitacao_cliente']?></h3>

	<div class="bloco-solicitacao-footer">
		<div class="bloco-solicitacao-prazo">
			
			<h2>Prazo: <?php echo $prazoFormatado?></h2>
		</div>
		<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
		
			<i class="fas fa-ellipsis-v" onmouseover="exibirTrocaStatus(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"></i>

			<div class="modificar-status-solicitacao" id="status<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
				<ul>
					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=0&cliente=<?php echo $nomeCliente?>">
						<li>SOLICITADO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=1&cliente=<?php echo $nomeCliente?>">
						<li>ANDAMENTO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=2&cliente=<?php echo $nomeCliente?>">
						<li>AGUARDANDO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=3&cliente=<?php echo $nomeCliente?>">
						<li>APROVADO</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=4&cliente=<?php echo $nomeCliente?>">
						<li>POSTAR</li>
					</a>

					<a href="../Model/modelModificaTipoSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&tipo=5&cliente=<?php echo $nomeCliente?>">
						<li>FINALIZADO</li>
					</a>
				</ul>
			</div>

		<?php }?>

		<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>
			
			<div class="aprovar-arte-solicitacao-container">
				<i class="far fa-eye" onmouseover="exibirVisualizarSolicitacao(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"></i>
				<div class="exibir-visualizar-solicitacao" id="exibir-visualizar-solicitacao<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">VISUALIZAR</div>

				<?php if($i == 2){?>
					<a href="../Model/modelAprovarSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&nome=<?php echo $totalSolicitacoes[$j]['nome_cliente_solicitacao']?>">
						<div class="aprovar-arte-solicitacao">
							<p>APROVAR</p>
						</div>
					</a>
				<?php }?>
			</div>				
			
		<?php }?>
	</div>

	<script type="text/javascript">
		function exibirVisualizarSolicitacao(id){
			$('#exibir-visualizar-solicitacao'+id).css('display', 'block');
		}

		$('.fa-eye').mouseleave(function(){
			$('.exibir-visualizar-solicitacao').css('display', 'none');
		});

	</script>
</div><!-- FIM DO BLOCO SOLICITACAO -->
	