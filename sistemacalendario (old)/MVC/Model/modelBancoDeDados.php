<?php 
	/*try{
		$pdo = new PDO('mysql:host=localhost:3306;dbname=isevenpl_sistemaCalendario','
isevenpl_marcos','@i788721065JE');
	}
	catch(Exception $e){
		echo 'Erro!';
	}*/
	
	try{
		$pdo = new PDO('mysql:host=localhost:3306;dbname=isevenpl_sistemaCalendario','isevenpl_marcos','@i788721065JE');
	}
	catch(Exception $e){
		echo 'Erro!';
	}
?>