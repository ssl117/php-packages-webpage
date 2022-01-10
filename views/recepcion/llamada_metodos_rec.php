<?php

	// Inicio de Sesión
	if(!isset($_SESSION)) 
    	{ 
        	session_start(); 
    	}
	
	// Consulto si la variable de sesion esta vacía
	if(empty($_SESSION['nomUsuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='../inicio/inicio_sesion.php';</script>");
	}

	//Llamada a la base de datos
		require_once("../../db/db.php");
		
	//Llamada al modelo
		require_once("../../models/encomiendas_model.php");

	//Llamada a métodos.
		
		$encomiendas = new encomiendas_model();
		$datos = $encomiendas->getEncomiendasRec();

		$mensajes = new encomiendas_model();
		$formularios = $mensajes->getMensajesRec();
				
		$paginado = new encomiendas_model();
		
		$mensajesNoLeidos = new encomiendas_model();

		$recepcion = new encomiendas_model();
		$guardarForm = $recepcion->recepcionEncomiendaRec();

		$despachar = new encomiendas_model();
		$despacharEncomienda = $despachar->despacharEncomiendaRec();

		$archivarMensajesRec = new encomiendas_model();
		$modificarMensajesRec = $archivarMensajesRec->archivarMensajesRec();

		$busquedaEncomiendaRec = new encomiendas_model();
		$busquedaEncRec = $busquedaEncomiendaRec->buscarEncomiendasRec();

	//Chequeos previos a actualizar campos.

		if(sizeof($encomiendas)==0 || sizeof($mensajes)==0 || sizeof($paginado)==0){
	    	die("error 404");
		}

		if(sizeof($mensajesNoLeidos)==0 || sizeof($recepcion)==0 || sizeof($despachar)==0){
	    	die("error 404");
		}

		if(sizeof($archivarMensajesRec)==0 || sizeof($busquedaEncomiendaRec)==0){
	    	die("error 404");
		}
		
?>