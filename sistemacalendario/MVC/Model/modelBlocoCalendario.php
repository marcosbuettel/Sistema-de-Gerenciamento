<?php	
	$verificaBlocosCalendarios = $pdo->prepare("SELECT * FROM bloco_calendario WHERE dia_semana_bloco_calendario = '$verificaDia' AND numero_semana_bloco_calendario = '$verificaSemana' AND id_calendario = '$idCalendario'");	

	$verificaBlocosCalendarios->execute();
	$totalBlocosCalendarios = $verificaBlocosCalendarios->fetchAlL(); 	
?>