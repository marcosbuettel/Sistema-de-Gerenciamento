<?php 
	//COLOCAR UMA DIV SÓ PRA EXIBIR AS INFORMAÇÕES 
	//DA SOLICITAÇÃO, MAS PEGAR OS PARÂMETROS DA FUNÇÃO
	//PRA VER QUAL INFORMAÇÃO SERÁ MOSTRADA

?>

<style>	

	.janela-modal-tarefas tr:nth-child(2n){
		background-color: #F3F3F3;
	}

	.botao-editaExclui-cliente{
		position: relative;
	}

	.botao-editaExclui-cliente i{
		margin: 0 10px;
		cursor: pointer;
	}

	.botao-editaExclui-cliente2 i{
		margin: 0 10px;
		cursor: pointer;
	}

	.primeira-coluna-tabela{
		padding-top: 10px;
	}

	.icones-acao{
		background-color: #2A2A2A;
		color: white;
		font-size: 12px;
		padding: 5px 10px; 
		display: none;
		position: absolute;
		margin-top: 10px;
	}

	/********************************************************************
							JANELA MODAL DE CADASTRO
	********************************************************************/

	.janela-modal-cadastro{
		width: 500px;
		position: absolute;
		z-index: 9999999;
		background-color: white; 
		display: none;
		margin-left: auto;
		margin-right: auto;
		left: 0;
		right: 0;
		top: 30px;
		border-radius: 10px;
	}

	.janela-modal-cadastro-tarefa{
		width: 500px;
		position: absolute;
		z-index: 9999999;
		background-color: white; 
		display: none;
		margin-left: auto;
		margin-right: auto;
		left: 0;
		right: 0;
		top: 30px;
		border-radius: 10px;
	}

	.janela-modal-editar{
		width: 350px;
		position: absolute;
		z-index: 9999999999;
		background-color: white;
		margin-left: auto;
		margin-right: auto;
		left: 0;
		right: 0;
		top: 100px;
		border-radius: 10px;
	}

	.janela-modal-editar-calendario{
		width: 500px;
		position: absolute;
		z-index: 9999999;
		background-color: white; 
		margin-left: auto;
		margin-right: auto;
		left: 0;
		right: 0;
		top: 30px;
		border-radius: 10px;
	}

	.janela-modal-editar-calendario img{
		width: 30px;
		position: absolute;
		right: 10px;
		top: 10px;
		color: red;
		cursor: pointer;
	}

	.janela-editar-usuario{
		width: 500px;
		position: absolute;
		z-index: 9999999;
		background-color: white; 
		margin-left: auto;
		margin-right: auto;
		left: 0;
		right: 0;
		top: 100px;
		border-radius: 10px;
	}

	.janela-editar-usuario img{
		width: 30px;
		position: absolute;
		right: 10px;
		top: 10px;
		color: red;
		cursor: pointer;
	}

	.janela-modal-cadastro img{
		width: 30px;
		position: absolute;
		right: 10px;
		top: 10px;
		color: red;
		cursor: pointer;
	}

	.janela-modal-cadastro-tarefa img{
		width: 30px;
		position: absolute;
		right: 10px;
		top: 10px;
		color: red;
		cursor: pointer;
	}


	.janela-modal-editar img{
		width: 30px;
		position: absolute;
		right: 10px;
		top: 10px;
		color: red;
		cursor: pointer;
	}

	.header-janela-modal{
		font-size: 12px;
		padding: 10px;
		color: white;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
		background-color: #2D323E;
	}

	.info-cadastro-cliente{
		font-size: 30px;
		text-align: center;
	}

	/*.info-cadastro-cliente input{
		width: 300px;
		font-size: 18px;
		padding: 10px;
		margin: 20px 0;
	}*/

	.info-cadastro-cliente button{
		background-color: #01BC00;
		border: none;
		color: white;
		font-size: 20px;
		padding: 10px;
		border-radius: 10px;
		cursor: pointer;
	}

	.info-cadastro-usuario{
		font-size: 18px!important;
		font-weight: bold;
	}

	
	/********************************************************************
							FORM CALENDARIO
	********************************************************************/

	.form-box{
		display: flex;
		justify-content: space-around;
		font-size: 18px;
		background-color: #F5F5F5;
		margin: 0 20px;
		padding: 20px;
		-webkit-box-shadow: 0px 0px 5px 2px rgba(212,212,212,1);
		-moz-box-shadow: 0px 0px 5px 2px rgba(212,212,212,1);
		box-shadow: 0px 0px 5px 2px rgba(212,212,212,1);
	}

	select{
		height: 45px;
		min-width: 100px;
		margin-top: 20px;
		font-size: 20px;
	}

	.form-box-cliente{
		font-size: 18px;
		background-color: #F5F5F5;
		margin: 0 20px;
		padding: 20px;
		-webkit-box-shadow: 0px 0px 5px 2px rgba(212,212,212,1);
		-moz-box-shadow: 0px 0px 5px 2px rgba(212,212,212,1);
		box-shadow: 0px 0px 5px 2px rgba(212,212,212,1);
		text-align: left;
	}

	.form-box-cliente input[type=text]{
		width: 400px!important;
		text-align: left!important;
	}

	.form-box-cliente input[type=radio]{
		margin-top: 5px;
	}

	.form-box-cliente textarea{
		width: 100%;
		height: 70px;
		resize: none;
		padding: 5px 10px;
	}

	.opcoes-solicitacao-cliente{
		font-size: 16px;
	}

	.info-cadastro-cliente .anexar-foto input{
		width: auto!important;
		margin-top: 5px;
		margin-right: 5px;
	}

	.anexar-foto{
		justify-content: center;
		font-size: 16px;
	}

	#fileToUpload{
		display: none;
	}

	/********************************************************************
						JANELAS DE CADASTRO E EDIÇÃO
	********************************************************************/
	.janela-modal-geral img{
		width: 20px;
		top: 12px;
	}

	.janela-modal-geral{
		position: fixed;
	}

	.campos-formulario-container{
		padding: 5px 10px;
		background-color: #EBEBEB;
	}

	.campos-formulario{
		text-align: left;
		margin-top: 5px;
		margin-bottom: 20px; 
		background-color: white;
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
		padding: 0 10px;
		padding-bottom: 10px;
	}

	.campos-formulario label{
		font-size: 14px;
		font-weight: bold;
	}

	.campos-formulario input{
		border: none;
		border-bottom: 2px solid #E0E0E0;
		padding: 5px;
		font-size: 14px;
		margin: 0;
		background-color: white;
	}

	.campos-formulario input[type="text"]{
		width: 200px;
	}

	.campos-formulario input[type="date"]{
		width: 200px;
	}

	.campos-formulario input:focus{
		outline: 0;
		transition: 0.3s;
		border-bottom: 2px solid black;
	}

	.campos-formulario textarea{
		position: relative;
		resize: none;
		height: 60px;
		width: 100%;
		top: 5px;
		padding: 5px;
	}

	.campos-formulario select{
		height: 20px;
		font-size: 14px;
		margin: 0;
		background-color: white;
	}

	.campos-formulario img{
		position: static;
		width: 50px;
		height: 50px;
	}

	.campos-formulario-botao{
		display: flex;
		justify-content: center;
	}

	.campos-formulario-botao button{
		background-color: #2D323E;
		border-radius: 2px;
		font-size: 14px; 
	}

	.campos-formulario-botao button:hover{
		transition: 0.3s;
		background-color: white;
		color: black;
		-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
		box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
	}


	/********************************************************************
					  JANELAS MODAL SEPARADAS POR TIPO
	********************************************************************/
	.modal-cadastro-usuario{
		width:570px;
	}

	.modal-cadastro-calendario{
		width: 700px;
	}

	.modal-cadastro-cliente{
		width: 370px;
	}

	.modal-cadastro-solicitacao{
		width: 600px;
	}

	.modal-cadastro-projeto{
		width: 550px;
	}


	


	/********************************************************************
							MEDIA QUERIES
	********************************************************************/


	@media screen and (max-width: 900px){
		.nav-superior{
			display: flex;
			height: auto;
			position: static;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			padding-bottom: 20px;
		}

		.nav-superior > img{
			padding: 20px;
			width: 150px;
		}

		.img-sino{
			display: flex;
			color: white;
			position: relative;
			right: 0;
			top: 0;
		}

		.img-sino p{
			font-size: 16px;
			padding-top: 10px;
			padding-right: 40px;
		}

		.img-sino img{
			width: 40px;
			height: auto;
			text-align: center;
			margin-bottom: auto;
			cursor: pointer;
		}
			
		.nav-left{
			display: none;
		}

		.nav-left-mini{
			display: none;
		}

		.sub-header-mobile{
			background-color: #474D5B!important;
		}

		.nav-left-mobile{
			display: block;
			margin-top: 60px;		
		}

		.barra-notificacao{
			width: 270px;
			display: none;
			z-index: 9999999999;
			right: -20px;
		}

		.nav-painel ul{
			flex-direction: column;
			align-items: center;
		}

		.nav-painel li{
			margin-top: 20px;
		}

		.nav-painel a{
			font-size: 12px;
			margin-top: 20px;
		}


		.sub-header-mobile{
			background-color: #2D323E;
			font-size: 12px;
			text-align: center;
			color: #8C8F95!important;
		}

		.sub-header-mobile h2{
			margin-top: -60px;
			margin-bottom: 10px;
		}

		.sub-header-mobile i{
			color: white;
			margin-bottom: 20px!important;
			cursor: pointer;
		}

		.menu-mobile{
			font-size: 20px;
			display: none;
			position: absolute;
			background-color: black;
			width: 100%;
			padding: 10px 50px;
		}

		.menu-mobile i{
			margin-right: 10px;
		}

		.separador{
			padding: 40px 5px;
			width: 100%;
			margin: 0 auto;
		}

		.clientes-box-wrapper{
			flex-direction: column;
			align-items: center;
			overflow-x: scroll;  
		}

		.calendario-box-wrapper{
			overflow-x: scroll;
		}

		.calendarios-visao-clientes{
			flex-direction: column;
			align-items: center;
		}

		.nav-painel li:first-child{
			margin-top: -20px;
			font-size: 20px;
		}

		.janela-modal-geral{
			width: 80%
		}

		.campos-formulario input{
			margin: 5px 0;
		}

		.dashboard-adm{
			flex-direction: column;
			justify-content: center;
		}
	}

</style>

<div class="bloco-solicitacao">
	<div style="display: flex; justify-content: space-between;">
		<h3><?php echo $totalSolicitacoes[$j]['titulo_solicitacao_cliente']?></h3>

		<div>
		<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
			
			<i onmouseover="exibirEditarSolicitacao(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"class="fas fa-edit" class="lixeira" style="margin-right: 10px" onclick="editarSolicitacao(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"></i>
			<div class="editar-solicitacao" id="editar-solicitacao-<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
				<p>EDITAR</p>
			</div>

			<a href="../Model/modelExcluirSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&cliente=<?php echo $nomeCliente?>"><i onmouseover="removerSolicitacao(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"class="far fa-trash-alt" class="lixeira"></i></a>
			<div class="remover-solicitacao" id="<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
				<p>REMOVER SOLICITAÇÃO</p>
			</div>
		<?php }?>
		</div>
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


			<!-- JANELA PARA EDITAR A SOLICITAÇÃO -->
			<div class="janela-modal-cadastro modal-cadastro-solicitacao janela-modal-geral" id="janela-editar-solicitacao<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente'] ?>">
				<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
				<div class="header-janela-modal">
					<h2>Editar solicitação:</h2>
				</div>

				<div class="info-cadastro-cliente">
					<form method="POST" action="../Model/modelEditarSolicitacaoAdm.php?idS=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente'] ?>&nome=<?php echo $nomeCliente ?>" enctype="multipart/form-data">

						<div class="campos-formulario-container">

							<div class="campos-formulario">
								
								<div>
									<label>Título:</label>
									<input type="text" placeholder="Título" name="titulo-solicitacao" style="text-align: center; width: 200px" value="<?php echo $totalSolicitacoes[$j]['titulo_solicitacao_cliente']?>">
								</div>
							</div>		

							<!--<div class="campos-formulario">
								<div>
									<label>Tipo:</label>

									<div class="opcoes-solicitacao-cliente">
										<input type="radio" value="web" name="tipo-solicitacao" required>WEB
										<input type="radio" value="midiasocial" name="tipo-solicitacao" required>Midia Social
										<input type="radio" value="outdoor" name="tipo-solicitacao" required>Outdoor
										<input type="radio" value="folder" name="tipo-solicitacao" required>Folder
										<input type="radio" value="outro" name="tipo-solicitacao" required>Outro
									</div>
								</div>
							</div> -->

							<div class="campos-formulario">
								<div>
									<label>Descrição:</label>
									<textarea name="descricao-solicitacao"><?php echo $totalSolicitacoes[$j]['descricao_solicitacao_cliente']?></textarea>
								</div>

								<div>
									<label>Informe o prazo:</label><br>
									<input type="date" name="prazo-solicitacao" value="<?php echo $totalSolicitacoes[$j]['prazo_solicitacao_cliente']?>">
								</div>
							</div>

							<div class="campos-formulario-botao">
								<button>CONFIRMAR</button>
							</div>
						</div>
						<!--<div class="anexar-foto">
							<input type="checkbox" name="anexar-foto" value="1" onclick="enviarFoto()"> ANEXAR FOTO?
							<br>
							<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
						</div>-->
						
						
					</form>
				</div>
			</div>

		<?php }?>

		<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>
			
			<div class="aprovar-arte-solicitacao-container">
				<i class="far fa-eye" onmouseover="exibirVisualizarSolicitacao(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)"></i>
				<div class="exibir-visualizar-solicitacao" id="exibir-visualizar-solicitacao<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">VISUALIZAR</div>

				<?php if($i == 2){?>
					<!--<a href="../Model/modelAprovarSolicitacao.php?id=<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>&nome=<?php echo $totalSolicitacoes[$j]['nome_cliente_solicitacao']?>">
						<div class="aprovar-arte-solicitacao">
							<p>APROVAR</p>
						</div>
					</a>-->
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
	