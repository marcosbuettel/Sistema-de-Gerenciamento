<?php 	
	$contErro = 0;
	for($i=0;$i<count($totalUsuarios);$i++){
		if(isset($_POST['login']) and isset($_POST['senha'])){
			if($totalUsuarios[$i]['nome_usuario'] == trim($_POST['login']) and $totalUsuarios[$i]['senha_usuario'] == $_POST['senha']){
				
				$idUsuarioLogado = $totalUsuarios[$i]['id_usuario'];	

				include_once("MVC/Model/modelStatusUsuario.php");

				$usuarioLogado = $_POST['login'];
				$nomeUsuario = $totalUsuarios[$i]['nome_usuario'];	
				$tipoUsuario = $totalUsuarios[$i]['tipo_usuario'];				
				$nomeCliente = $totalUsuarios[$i]['nome_cliente'];				
				
				$_SESSION['id-usuario-logado'] = $idUsuarioLogado;
				$_SESSION['login'] = $usuarioLogado;
				$_SESSION['nome'] = $nomeUsuario;
				$_SESSION['tipo-usuario'] = $tipoUsuario;
				$_SESSION['nome-cliente'] = $nomeCliente;

				header('Location: MVC/View/viewPainelAdministrativo.php');

				//echo "<script>document.location='MVC/View/viewPainelAdministrativo.php'</script>";		
			}
			else{
				if($contErro == 0){
					$contErro += 1;
					echo "DADOS INCORRETOS!";
				}
			}
		}
	}					
?>