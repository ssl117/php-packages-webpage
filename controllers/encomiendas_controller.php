<?php

	//Llamada al modelo
	    require_once("/models/encomiendas_model.php");
	    $encomiendas = new encomiendas_model();
	//    $datos = $encomiendas->getEncomiendas();
         
    //Llamada a la vista
    	require_once("/views/inicio/index.php");
    //	header('Location: C:\wamp\www\Maxima_Entrega\views\inicio\inicio.php');
		
?>	