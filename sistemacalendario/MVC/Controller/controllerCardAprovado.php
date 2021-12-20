<?php 
	if($totalBlocosCalendarios[0]['aprovado_bloco_calendario'] == 1){
?>

<div style="margin-bottom: 5px"></div>
<i class="fas fa-check-double" style="color: #78FAA0; font-size: 20px"></i><span style="font-size: 16px; position: relative; top: -2px"> Aprovado</span>

<?php }else if($totalBlocosCalendarios[0]['aprovado_bloco_calendario'] == 2){?>

<div style="margin-bottom: 5px"></div>
<img src="../../images/cancel.png" width="20px"><span style="font-size: 16px; position: relative; top: -5px"> Reprovado</span>

<?php }?>