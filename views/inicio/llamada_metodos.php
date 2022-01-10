<?php

	//Llamada a la base de datos.
		require_once("../../db/db.php");
		
	//Llamada al modelo.
		require_once("../../models/encomiendas_model.php");

	//Llamada a métodos y chequeos previos a actualizar campos.	

		$paquetes = new encomiendas_model();

		if(sizeof($paquetes)==0){
	    	die("error 404");
		}

		$login = new encomiendas_model();
		$usuario = $login->loginUsuarios();

		if(sizeof($login)==0){
	    	die("error 404");
		}

		$envioConsulta = new encomiendas_model();
		$contacto = $envioConsulta->envioConsulta();

		if(sizeof($envioConsulta)==0){
	    	die("error 404");
		}

?>