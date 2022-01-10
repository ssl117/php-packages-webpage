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
		$datos = $encomiendas->getEncomiendasAdmin();

		$mensajes = new encomiendas_model();
		$formularios = $mensajes->getMensajesAdmin();

		$usuarios = new encomiendas_model();
		$personas = $usuarios->getUsuarios();
		
		$paginado = new encomiendas_model();

		$mensajesNoLeidos = new encomiendas_model();

		$despachar = new encomiendas_model();
		$despacharEncomienda = $despachar->despacharEncomiendaAdmin();

		$cancelar = new encomiendas_model();
		$cancelarEncomienda = $cancelar->cancelarEncomienda();

		$altaUsuarios = new encomiendas_model();
		$agregarUsuarios = $altaUsuarios->altaUsuarios();

		$modificarUsuarios = new encomiendas_model();
		$permisosUsuarios = $modificarUsuarios->modificarUsuarios();

		$eliminarUsuarios = new encomiendas_model();
		$quitarUsuarios = $eliminarUsuarios->eliminarUsuarios();

		$editarUsuarios = new encomiendas_model();
		$actualizarUsuarios = $editarUsuarios->editarUsuarios();

		$archivarMensajes = new encomiendas_model();
		$modificarMensajes = $archivarMensajes->archivarMensajesAdmin();

		$editarEncomiendas = new encomiendas_model();
		$actualizarEncomiendas = $editarEncomiendas->editarEncomiendas();

		$editarEncomiendasCheck = new encomiendas_model();
		$chequeoEncomiendas = $editarEncomiendasCheck->editarEncomiendasCheck();

		$recepcion = new encomiendas_model();
		$guardarForm = $recepcion->recepcionEncomiendaAdmin();

		$busquedaEncomiendaAdmin = new encomiendas_model();
		$busquedaEncAdmin = $busquedaEncomiendaAdmin->buscarEncomiendasAdmin();

	//Chequeos previos a actualizar campos.	
		
		if(sizeof($encomiendas)==0 || sizeof($mensajes)==0 || sizeof($usuarios)==0){
	    	die("error 404");
		}

		if(sizeof($paginado)==0 || sizeof($mensajesNoLeidos)==0 || sizeof($despachar)==0){
	    	die("error 404");
		}

		if(sizeof($cancelar)==0 || sizeof($altaUsuarios)==0 || sizeof($modificarUsuarios)==0){
	    	die("error 404");
		}

		if(sizeof($eliminarUsuarios)==0 || sizeof($editarUsuarios)==0 || sizeof($archivarMensajes)==0){
	    	die("error 404");
		}

		if(sizeof($editarEncomiendas)==0 || sizeof($editarEncomiendasCheck)==0){
	    	die("error 404");
		}

		if(sizeof($recepcion)==0 || sizeof($busquedaEncomiendaAdmin)==0){
	    	die("error 404");
		}
?>