<?php
class Conectar{
	
	//Declarar propiedades o métodos de clases como estáticos 
	//los hacen accesibles sin la necesidad de instanciar la clase.
    public static function conexion(){
        $conexion = new mysqli("localhost", "root", "", "maxima_entrega");
        if ($conexion->connect_errno) {
	    // La conexión falló.
	    // No se debe revelar información delicada pero si mostrar un mensaje al usuario:
	    echo "Lo sentimos, este sitio web está experimentando problemas.<br>";
	    echo "Error: Fallo al conectarse a MySQL debido a: <br>";
	    echo "Error Nro: " . $conexion->connect_errno . "<br>";
	    echo "Error: " . $conexion->connect_error . "<br>";
		//'connect_error': Devuelve una cadena con la descripción del último error de conexión
	    
	    // Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
	    exit;
		}

	/*	$consultatabla = "SELECT * FROM encomiendas";

		// Mediante $resultConsultaListado podremos crear el Array con los registros para luego mostrarlos
		if (!$resultConsultaEncomiendas = $conexion->query($consultatabla)) {
		    echo "Lo sentimos, no se pudo listar los datos de la tabla.";
		    exit;
		}
	*/
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
	
}

?>