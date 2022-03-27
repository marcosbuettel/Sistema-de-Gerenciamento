<?php 

	$dataAtual = date('Y-m-d');

	echo $dataAtual;

	if($dataAtual == '2022-03-07'){
		echo '<script>document.location = "MVC/View/viewAcesso.php"</script>';
		header('Location: MVC/View/viewAcesso.php');
	}

?>