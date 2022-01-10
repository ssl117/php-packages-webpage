<?php

class encomiendas_model extends Conectar{

	private $db;
	private $encomiendas;
	private $consulta_registros;
	private $total_registros;
	private $cant_reg_paginas;
	private $pagina;
	private $mensajes;
	private $usuarios;

	public function __construct(){
	    $this->db=Conectar::conexion();
	    $this->encomiendas=array();
	    $this->consulta_registros='';
	    $this->total_registros='';
	    $this->cant_reg_paginas=4;	// 4 registros por página.
	    $this->pagina=false;
	    $this->mensajes=array();
	    $this->usuarios=array();
	}

	//ESTABLEZCO VARIABLES QUE SE UTILIZARÁN EN MÁS DE UNA OCASIÓN

	public function getConsultas(){
	  
	    $this->cant_reg_paginas = 4;
	    $this->pagina = false;

	    $this->consulta_registros_EncAdmin=$this->db->query("SELECT * FROM encomiendas;");
	    $this->total_registros_EncAdmin = mysqli_num_rows($this->consulta_registros_EncAdmin);
	    
	    $this->consulta_registros_EncRec=$this->db->query("SELECT * FROM encomiendas WHERE estado_desp='0';");
	    $this->total_registros_EncRec = mysqli_num_rows($this->consulta_registros_EncRec);
	    
	    $this->consulta_registros_mensajesAdmin = $this->db->query("SELECT * FROM mensajes;");
	    $this->total_registros_mensajesAdmin = mysqli_num_rows($this->consulta_registros_mensajesAdmin);

	    $this->consulta_registros_mensajesRec = $this->db->query("SELECT * FROM mensajes WHERE estado='0';");
	    $this->total_registros_mensajesRec = mysqli_num_rows($this->consulta_registros_mensajesRec);
	    
	    $this->consulta_registros_usuarios=$this->db->query("SELECT * FROM usuarios;");
	    $this->total_registros_usuarios = mysqli_num_rows($this->consulta_registros_usuarios);
	}

	// LOGIN DE LOS USUARIOS CON SUS RESPECTIVAS VALIDACIONES

	public function loginUsuarios(){

		if(isset($_POST['login'])){

			$usu = $_POST['usuario'];
			$psw = MD5($_POST['contrasena']); // FALTA ENCRIPTAR!!!
			
			// Evalúo que los campos no queden vacíos...
			if($usu!="" && $psw!=""){
				
				// Consulta almacenada en una variable
				$sql = "SELECT * FROM usuarios WHERE cedula = '$usu' AND clave ='$psw'";
				
				// Almaceno en una variable la cantidad de filas obtenidas
				$login = $this->db->query($sql);

				$numFilas = mysqli_num_rows($login);

				// Consulto la cantidad de filas obtenidas.
				// Al ser una Primary Key no debería de tener mas de un registro con los mismos valores, entonces $numfilas sería 0 sin registros o 1 con registro válido.

				if($numFilas>0){
					while ($usuario = $login -> fetch_assoc()){

						//Chequeo si el usuario está activo o no.
						
						if($usuario['estado'] == 0){
							echo '<script language="javascript">';
							echo 'alert("Usuario no habilitado.\nSolicite permiso de acceso a un Administrador.");';
							echo 'window.location.href = "../inicio/inicio_sesion.php";';
							echo '</script>';					
						}else{
							
							//Recibo las variables con el método POST y las guardo.
							$nomUsuario = $usuario['nombre'];
							$cedulaUsuario = $usuario['cedula'];


							//Inicio sesión y guardo dos variables que voy a usar.
							session_start();
							$_SESSION['nomUsuario'] = $nomUsuario;
							$_SESSION['cedulaUsuario'] = $cedulaUsuario;

							//Si es usuario tipo Admin va a un lugar. 
						
							if($usuario['tipo_usuario'] == "Administrador"){

								header('location:../admin/encomiendas_admin.php');

							//Si es usuario tipo Recepcion va a otro lugar.

							}else if($usuario['tipo_usuario'] == "Recepcion"){

								header('location:../recepcion/encomiendas_rec.php');

							}else{

								// Si no se pudo loguear, muestro mensaje de error.

								echo '<script language="javascript">';
								echo 'alert("Usuario y/o Contraseña incorrectos.");';
								echo 'window.location.href = "../inicio/inicio_sesion.php";';
								echo '</script>';
							}
						}
					}

				// Si no se pudo loguear, muestro mensaje de error.

				}else{
					echo '<script language="javascript">';
					echo 'alert("Usuario y/o Contraseña incorrectos.");';
					echo 'window.location.href = "../inicio/inicio_sesion.php";';
					echo '</script>';
				}
			}
		}
	}

	// Consulto cuántos mensajes nuevos no leídos hay, los cuento y los muestro.

	public function mensajesNoLeidos(){

		$sql = "SELECT * FROM mensajes WHERE estado='0'";
		
		$mensajes = $this->db->query($sql);

		$cantMensajes = mysqli_num_rows($mensajes);
					
		return $cantMensajes;
	}

	//Obtengo el listado de las Encomiendas desde la vista Admin.	
	
	public function getEncomiendasAdmin(){
	    
		// realizo consulta y obtengo los registros de la BD
	    $this->consulta_registros=$this->db->query("SELECT * FROM encomiendas;");
	    
	    //creo una variable donde guardo la cantidad de registros de la consulta
	    $this->total_registros = mysqli_num_rows($this->consulta_registros);
	    
	    // si hay registros...
	    if ($this->total_registros > 0) {

	        // Examino la página a mostrar y el inicio del registro a mostrar
	        if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    //Realizo la consulta nuevamente y la almaceno en un array.

	    $consulta = "SELECT * FROM encomiendas ORDER BY fecha_rec DESC LIMIT ".$inicio."," . $this->cant_reg_paginas;
	    $rs = $this->db->query($consulta);


	    while($filas=$rs->fetch_assoc()){   

	        $this->encomiendas[]=$filas;
	    }
	            
	    return $this->encomiendas;

	    }
	}

	//Obtengo el listado de las Encomiendas desde la vista Recepcion.

	public function getEncomiendasRec(){
	    
		// realizo consulta y obtengo los registros de la BD
	    $this->consulta_registros=$this->db->query("SELECT * FROM encomiendas WHERE estado_desp='0';");
	    
	    //creo una variable donde guardo la cantidad de registros de la consulta
	    $this->total_registros = mysqli_num_rows($this->consulta_registros);
	    
	    // si hay registros...
	    if ($this->total_registros > 0) {

	        // Examino la página a mostrar y el inicio del registro a mostrar
	        if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	   	//Realizo la consulta nuevamente y la almaceno en un array.
	   	//Se limita la consulta a 4 registros por página y se ordenan por fecha.

	    $consulta = "SELECT * FROM encomiendas WHERE estado_desp='0' ORDER BY fecha_rec DESC LIMIT ".$inicio."," . $this->cant_reg_paginas;
	    $rs = $this->db->query($consulta);


	    while($filas=$rs->fetch_assoc()){

	        $this->encomiendas[]=$filas;
	    }
	            
	    return $this->encomiendas;

	    }
	}

	//Obtengo los mensajes recibidos para los usuarios Admin.

	public function getMensajesAdmin(){

	// realizo consulta y obtengo los registros de la BD
	$this->consulta_registros=$this->db->query("SELECT * FROM mensajes;");

    // Creamos una variable donde guardamos la cantidad de registros obtenido en la consulta
    $this->total_registros = mysqli_num_rows($this->consulta_registros);
    
    // Si hay registros
	    if ($this->total_registros > 0) {

	        // Examino la página a mostrar y el inicio del registro a mostrar
	        if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    	}

	    	//Realizo la consulta nuevamente y la almaceno en un array.
	    	//Se limita la consulta a 4 registros por página.

		    $consulta = "SELECT * FROM mensajes LIMIT ".$inicio."," . $this->cant_reg_paginas;
		    $rs = $this->db->query($consulta);

		    while($filas=$rs->fetch_array()){

		        $this->mensajes[]=$filas;
		    }
		            
		    return $this->mensajes;

		}
	}

	//Obtengo los mensajes recibidos para los usuarios Recepcion.

	public function getMensajesRec(){

		// realizo consulta y obtengo los registros de la BD
		$this->consulta_registros=$this->db->query("SELECT * FROM mensajes WHERE estado='0';");

	    // Creamos una variable donde guardamos la cantidad de registros obtenido en la consulta
	    $this->total_registros = mysqli_num_rows($this->consulta_registros);
	    
	    // Si hay registros
	    if ($this->total_registros > 0) {

	        // Examinamos la página a mostrar y el inicio del registro a mostrar
	        if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    //Realizo la consulta nuevamente y la almaceno en un array.
	    //Se limita la consulta a 4 registros por página.
	    //Obtengo únicamente los mensajes no leídos (estado=0).

	    $consulta = "SELECT * FROM mensajes WHERE estado='0' LIMIT ".$inicio."," . $this->cant_reg_paginas;
	    $rs = $this->db->query($consulta);

	    while($filas=$rs->fetch_array()){

	        $this->mensajes[]=$filas;
	    }
	            
	    return $this->mensajes;

	    }
	}

	// Obtengo todos los usuarios registrados.

	public function getUsuarios(){

		// realizo consulta y obtengo los registros de la BD.
	    $this->consulta_registros=$this->db->query("SELECT * FROM usuarios;");
	    
	    // Creamos una variable donde guardamos la cantidad de registros obtenido en la consulta
	    $this->total_registros = mysqli_num_rows($this->consulta_registros);
	    
	    // Si hay registros
	    if ($this->total_registros > 0) {

	        // Examinamos la página a mostrar y el inicio del registro a mostrar
	        if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    //Realizo la consulta nuevamente y la almaceno en un array.
	    //Se limita la consulta a 4 registros por página.

	    $consulta = "SELECT * FROM usuarios LIMIT ".$inicio."," . $this->cant_reg_paginas;
	    $rs = $this->db->query($consulta);

	    while($filas=$rs->fetch_array()){

	        $this->usuarios[]=$filas;
	    }
	            
	    return $this->usuarios;

	    }
	}

	//Despacho la encomienda desde el usuario de Recepcion.

	public function despacharEncomiendaRec(){

		if(isset($_POST['despachar'])){

			//Cambio el estado de la encomienda a despachada (estado=1).

			$sql="UPDATE encomiendas SET estado_desp='1' WHERE codigo='".$_POST["clave"]."'";

			$this->db->query($sql);

			echo '<script language="javascript">';
			echo 'alert("Encomienda despachada exitosamente.");';
			echo 'window.location.href = "../recepcion/encomiendas_rec.php";';
			echo '</script>';
	    }
	}

	//Despacho-Modifico el estado de la encomienda desde el usuario Admin.

	public function despacharEncomiendaAdmin(){

		if(isset($_POST['despachar'])){

			$estadoEnc = $_POST["estado_desp"];

			//Si no está despachada, la despacho.
			
			if($estadoEnc == 0){

				$sql="UPDATE encomiendas SET estado_desp='1' WHERE codigo='".$_POST["clave"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Encomienda despachada exitosamente.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';

		    }else{

		    	//Si está despachada, cambio su estado a no despachada.

		    	$sql="UPDATE encomiendas SET estado_desp='0' WHERE codigo='".$_POST["clave"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Encomienda modificada exitosamente.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';
		    }
		}
	}

	//Cancelo-Modifico la encomienda desde el usuario Admin.

	public function cancelarEncomienda(){

		if(isset($_POST['cancelar'])){

			$estadoEnc = $_POST["estado_cancel"];
			
			if($estadoEnc == 0){

				//Si no está cancelada, la cancelo.

				$sql="UPDATE encomiendas SET estado_cancel='1' WHERE codigo='".$_POST["clave"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Encomienda cancelada exitosamente.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';

		    }else{

		    	//Si está cancelada, cambio su estado a no cancelada.

		    	$sql="UPDATE encomiendas SET estado_cancel='0' WHERE codigo='".$_POST["clave"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Encomienda modificada exitosamente.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';
		    }
		}
	}

	//Realizo el alta de un nuevo usuario.

	public function altaUsuarios(){

		if(isset($_POST['altaUsuario'])){

			// realizo consulta y obtengo los registros de la BD con la cedula ingresada.
		    $this->consulta_registros=$this->db->query("SELECT * FROM usuarios WHERE cedula='".$_POST["cedula"]."'");
		    
		    //creo una variable donde guardo la cantidad de registros de la consulta
		    $this->total_registros = mysqli_num_rows($this->consulta_registros);
		    
		    // si hay registros...
		    if ($this->total_registros > 0) {

		    	//No puede haber dos usuarios con la misma cedula (clave primaria).

				echo '<script language="javascript">';
				echo 'alert("Existe un Usuario registrado con esta CI.")';
				echo '</script>';
				return false;	// NO VUELVE AL FORM COMPLETO, SE SALE!!!!!!!!!!

		    }else{

		    	//Si no existe un usuario con esa cedula, se lo ingresa al sistema.

		    	$password = MD5($_POST["clave"]);

				$sql = "INSERT INTO usuarios VALUES ('".$_POST["cedula"]."','".$_POST["nombre"]."','".$_POST["apellido"]."','.$password.','".$_POST["mail"]."','".$_POST["tipo_usuario"]."','".$_POST["estado"]."');";

			 	$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("El Usuario fue dado de alta exitosamente.");';
				echo 'window.location.href = "../admin/usuarios.php";';
				echo '</script>';
			
			}
		}
	}

	//Modificar permisos de los usuarios registrados (activo o inactivo).

	public function modificarUsuarios(){

		if(isset($_POST['modificar'])){

			$estadoUsuario = $_POST["estado"];
			$cedulaUsuario = $_POST["cedula"];
			$cedulaUsuarioLog = $_SESSION['cedulaUsuario'];

			if($cedulaUsuario == $cedulaUsuarioLog){

				//Comparo el usuario a modificar contra el usuario logueado.
				//Si es el mismo, no puede cambiar sus permisos.

				echo '<script language="javascript">';
				echo 'alert("El usuario no puede modificar sus propios permisos.");';
				echo 'window.location.href = "../admin/usuarios.php";';
				echo '</script>';
			
			}else{

				if($estadoUsuario == 0){

					$sql="UPDATE usuarios SET estado='1' WHERE cedula='".$_POST["cedula"]."'";

					$this->db->query($sql);

					echo '<script language="javascript">';
					echo 'alert("Los permisos del Usuario fueron modificados.");';
					echo 'window.location.href = "../admin/usuarios.php";';
					echo '</script>';

				}else{

			    	$sql="UPDATE usuarios SET estado='0' WHERE cedula='".$_POST["cedula"]."'";

					$this->db->query($sql);

					echo '<script language="javascript">';
					echo 'alert("Los permisos del Usuario fueron modificados.");';
					echo 'window.location.href = "../admin/usuarios.php";';
					echo '</script>';
				}
			}
		}
	}

	//Eliminar usuarios registrados.

	public function eliminarUsuarios(){

		if(isset($_POST['eliminar'])){

			$estadoUsuario = $_POST["estado"];
			$cedulaUsuario = $_POST["cedula"];
			$cedulaUsuarioLog = $_SESSION['cedulaUsuario'];

			if($cedulaUsuario == $cedulaUsuarioLog){

				//Comparo el usuario a eliminar contra el usuario logueado.
				//Si es el mismo, no puede cambiar sus permisos.

				echo '<script language="javascript">';
				echo 'alert("El usuario no puede eliminarse a sí mismo.");';
				echo 'window.location.href = "../admin/usuarios.php";';
				echo '</script>';

			}else{

				//Si el usuario está inactivo, procedo a eliminarlo.
			
				if($estadoUsuario == 0){

					$sql="DELETE FROM usuarios WHERE cedula='".$_POST["cedula"]."'";

					$this->db->query($sql);

					echo '<script language="javascript">';
			    	echo 'alert("El usuario fue eliminado exitosamente.");';
			    	echo 'window.location.href = "../admin/usuarios.php";';
					echo '</script>';

			    }else{

			    	//Si el usuario no está inactivo, debo cambiarlo antes de eliminarlo.

			    	echo '<script language="javascript">';
			    	echo 'alert("El Usuario debe estar Inactivo para poder eliminarlo.");';
			    	echo 'window.location.href = "../admin/usuarios.php";';
					echo '</script>';
			    }
			}
		}
	}

	//Editar los datos de los usuarios registrados.

	public function editarUsuarios(){

		if(isset($_POST['editarUsuarios'])){

			//Encripto la nueva clave.

			$password = MD5($_POST["clave"]);

			//Realizo la consulta de actualización.
		
			$sql="UPDATE usuarios SET 
				cedula='".$_POST["cedula"]."', 
				nombre='".$_POST["nombre"]."', 
				apellido='".$_POST["apellido"]."', 
				clave='".$password."', 
				mail='".$_POST["mail"]."', 
				tipo_usuario='".$_POST["tipo_usuario"]."', 
				estado='".$_POST["estado"]."' 
				WHERE cedula='".$_POST["cedula"]."'";

			$this->db->query($sql);

			echo '<script language="javascript">';
		    echo 'alert("Los datos del Usuario fueron actualizados exitosamente.");';
		    echo 'window.location.href = "../admin/usuarios.php";';
			echo '</script>';
		
		}
	}

	public function editarEncomiendasCheck(){

		if(isset($_POST['chequeoEditar'])){

			$estadoEncomienda = $_POST["estado_desp"];

			if($estadoEncomienda == 1){

				//Comparo el usuario a eliminar contra el usuario logueado.
				//Si es el mismo, no puede cambiar sus permisos.

				echo '<script language="javascript">';
				echo 'alert("La encomineda ya fue despachada y no puede editarse.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';

			}else{

				return true;

			}
		}
	}	

	//Editar los datos de las encomiendas.

	public function editarEncomiendas(){

		if(isset($_POST['editarEncomiendas'])){

			$observaciones = $_POST["observaciones"];

			if($observaciones == ""){

				$sql = "UPDATE encomiendas SET 
				fecha_rec='".$_POST["fecha_rec"]."',
				hora_rec='".$_POST["hora_rec"]."',
				ciudad_origen='".$_POST["ciudad_origen"]."',
				ciudad_destino='".$_POST["ciudad_destino"]."',
				tipo_paquete='".$_POST["tipo_paquete"]."',
				direccion_destino='".$_POST["direccion_destino"]."',
				nombre_dest='".$_POST["nombre_dest"]."',
				tel_dest='".$_POST["tel_dest"]."',
				nombre_remit='".$_POST["nombre_remit"]."',
				tel_remit='".$_POST["tel_remit"]."',
				codigo='".$_POST["codigo"]."',
				observaciones='',
				estado_desp='".$_POST["estado_desp"]."',
				estado_cancel='".$_POST["estado_cancel"]."'
				WHERE codigo='".$_POST["codigo"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Encomienda actualizada exitosamente.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';
			

			}else{

				$sql = "UPDATE encomiendas SET 
				fecha_rec='".$_POST["fecha_rec"]."',
				hora_rec='".$_POST["hora_rec"]."',
				ciudad_origen='".$_POST["ciudad_origen"]."',
				ciudad_destino='".$_POST["ciudad_destino"]."',
				tipo_paquete='".$_POST["tipo_paquete"]."',
				direccion_destino='".$_POST["direccion_destino"]."',
				nombre_dest='".$_POST["nombre_dest"]."',
				tel_dest='".$_POST["tel_dest"]."',
				nombre_remit='".$_POST["nombre_remit"]."',
				tel_remit='".$_POST["tel_remit"]."',
				codigo='".$_POST["codigo"]."',
				observaciones='".$_POST["observaciones"]."',
				estado_desp='".$_POST["estado_desp"]."',
				estado_cancel='".$_POST["estado_cancel"]."'
				WHERE codigo='".$_POST["codigo"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Encomienda actualizada exitosamente.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';

			}
		}
	}

	//Enviar el formulario de consulta.

	public function envioConsulta(){

		if(isset($_POST['envioConsulta'])){

			$sql = "INSERT INTO mensajes VALUES ('"."''"."','".$_POST["nombre"]."','".$_POST["mail"]."','".$_POST["telefono"]."','".$_POST["asunto"]."','".$_POST["consulta"]."','".$_POST["estado"]."');";

		 	$this->db->query($sql);

			echo '<script language="javascript">';
			echo 'alert("La consulta fue enviada.\nNos pondremos en contacto con usted en las próximas 24 horas.");';
			echo 'window.location.href = "../inicio/inicio.php";';
			echo '</script>';
		
		}
	}

	//Modificar el estado de los mensajes-consultas recibidas.

	public function archivarMensajesAdmin(){

		if(isset($_POST['archivar'])){

			$estadoMensaje = $_POST["estado"];
			
			if($estadoMensaje == 0){

				//Cambio su estado a respondido.

				$sql="UPDATE mensajes SET estado='1' WHERE id='".$_POST["id"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Este Mensaje fue marcado como Leído.");';
				echo 'window.location.href = "../admin/mensajes_admin.php";';
				echo '</script>';

		    }else{

		    	//Cambio su estado a no respondido.

		    	$sql="UPDATE mensajes SET estado='0' WHERE id='".$_POST["id"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Este Mensaje fue marcado como No Leído.");';
				echo 'window.location.href = "../admin/mensajes_admin.php";';
				echo '</script>';
		    }
		}
	}

	//Desde Recepcion, marco los mensajes como leídos.

	public function archivarMensajesRec(){

		if(isset($_POST['responder'])){

				$sql="UPDATE mensajes SET estado='1' WHERE id='".$_POST["id"]."'";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Este Mensaje fue marcado como Leído.");';
				echo 'window.location.href = "../recepcion/mensajes_rec.php";';
				echo '</script>';
		}
	}

	//Construyo el paginado de las encomiendas de Admin.

	public function getPaginadoEncomiendasAdmin(){

		//Llamo a las variables definidas al comienzo.
	    $this->getConsultas();

	    // Calculo el total de páginas.
	    // Funcion ceil(): redondea fracciones hacia arriba.
	    $total_paginas = ceil($this->total_registros_EncAdmin / $this->cant_reg_paginas);
	    $url = "encomiendas_admin.php";

	    if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    // Muestro información de cantidad de registros, páginas, etc.
	    echo '<p>Cantidad total de registros: '.$this->total_registros_EncAdmin .'<br>';
	    echo 'Cantidad de registros por página: '.$this->cant_reg_paginas.'<br>';
	    echo 'Mostrando la página '.$this->pagina.' de ' .$total_paginas.' paginas.</p>';
	    echo '<p>';
	        if ($total_paginas > 1) {
	            if ($this->pagina != 1)
	                echo '<a href="'.$url.'?pagina='.($this->pagina-1).'"> < </a>';
	                for ($i=1;$i<=$total_paginas;$i++) {
	                    if ($this->pagina == $i){
	                        // Si se muestra el índice de la página actual, no se coloca enlace.
	                        echo $this->pagina;
	                    }else{
	                        // Si el índice no corresponde con la página mostrada actualmente, 
	                        // se coloca el enlace para ir a esa página.
	                        echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
	                    }
	                }
	            if ($this->pagina != $total_paginas)
	                echo '<a href="'.$url.'?pagina='.($this->pagina+1).'"> > </a>';
	        }
	    echo '</p>';
	}

	public function getPaginadoEncomiendasRec(){

		//Llamo a las variables definidas al comienzo.
	    $this->getConsultas();

	    // Calculo el total de páginas.
	    // Funcion ceil(): redondea fracciones hacia arriba.
	    $total_paginas = ceil($this->total_registros_EncRec / $this->cant_reg_paginas);
	    $url = "encomiendas_rec.php";

	    if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    // Muestro información de cantidad de registros, páginas, etc.
	    echo '<p>Cantidad total de registros: '.$this->total_registros_EncRec .'<br>';
	    echo 'Cantidad de registros por página: '.$this->cant_reg_paginas.'<br>';
	    echo 'Mostrando la página '.$this->pagina.' de ' .$total_paginas.' paginas.</p>';
	    echo '<p>';
	        if ($total_paginas > 1) {
	            if ($this->pagina != 1)
	                echo '<a href="'.$url.'?pagina='.($this->pagina-1).'"> < </a>';
	                for ($i=1;$i<=$total_paginas;$i++) {
	                    if ($this->pagina == $i){
	                        // Si se muestra el índice de la página actual, no se coloca enlace.
	                        echo $this->pagina;
	                    }else{
	                        // Si el índice no corresponde con la página mostrada actualmente, 
	                        // se coloca el enlace para ir a esa página.
	                        echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
	                    }
	                }
	            if ($this->pagina != $total_paginas)
	                echo '<a href="'.$url.'?pagina='.($this->pagina+1).'"> > </a>';
	        }
	    echo '</p>';
	}

	public function getPaginadoEncomiendasDespacho(){

		//Llamo a las variables definidas al comienzo.
	    $this->getConsultas();

	    // Calculo el total de páginas.
	    // Funcion ceil(): redondea fracciones hacia arriba.
	    $total_paginas = ceil($this->total_registros_EncRec / $this->cant_reg_paginas);
	    $url = "despacho.php";

	    if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    // Muestro información de cantidad de registros, páginas, etc.
	    echo '<p>Cantidad total de registros: '.$this->total_registros_EncRec .'<br>';
	    echo 'Cantidad de registros por página: '.$this->cant_reg_paginas.'<br>';
	    echo 'Mostrando la página '.$this->pagina.' de ' .$total_paginas.' paginas.</p>';
	    echo '<p>';
	        if ($total_paginas > 1) {
	            if ($this->pagina != 1)
	                echo '<a href="'.$url.'?pagina='.($this->pagina-1).'"> < </a>';
	                for ($i=1;$i<=$total_paginas;$i++) {
	                    if ($this->pagina == $i){
	                        // Si se muestra el índice de la página actual, no se coloca enlace.
	                        echo $this->pagina;
	                    }else{
	                        // Si el índice no corresponde con la página mostrada actualmente, 
	                        // se coloca el enlace para ir a esa página.
	                        echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
	                    }
	                }
	            if ($this->pagina != $total_paginas)
	                echo '<a href="'.$url.'?pagina='.($this->pagina+1).'"> > </a>';
	        }
	    echo '</p>';
	}

	public function getPaginadoMensajesAdmin(){

		//Llamo a las variables definidas al comienzo.
	    $this->getConsultas();

	    // Calculo el total de páginas.
	    // Funcion ceil(): redondea fracciones hacia arriba.
	    $total_paginas = ceil($this->total_registros_mensajesAdmin / $this->cant_reg_paginas);
	    $url = "mensajes_admin.php";

	    if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    // Muestro información de cantidad de registros, páginas, etc.
	    echo '<p>Cantidad total de registros: '.$this->total_registros_mensajesAdmin .'<br>';
	    echo 'Cantidad de registros por página: '.$this->cant_reg_paginas.'<br>';
	    echo 'Mostrando la página '.$this->pagina.' de ' .$total_paginas.' paginas.</p>';
	    echo '<p>';
	        if ($total_paginas > 1) {
	            if ($this->pagina != 1)
	                echo '<a href="'.$url.'?pagina='.($this->pagina-1).'"> < </a>';
	                for ($i=1;$i<=$total_paginas;$i++) {
	                    if ($this->pagina == $i){
	                        // Si se muestra el índice de la página actual, no se coloca enlace.
	                        echo $this->pagina;
	                    }else{
	                        // Si el índice no corresponde con la página mostrada actualmente, 
	                        // se coloca el enlace para ir a esa página.
	                        echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
	                    }
	                }
	            if ($this->pagina != $total_paginas)
	                echo '<a href="'.$url.'?pagina='.($this->pagina+1).'"> > </a>';
	        }
	    echo '</p>';
	}

	public function getPaginadoMensajesRec(){

		//Llamo a las variables definidas al comienzo.
	    $this->getConsultas();

	    // Calculo el total de páginas.
	    // Funcion ceil(): redondea fracciones hacia arriba.
	    $total_paginas = ceil($this->total_registros_mensajesRec / $this->cant_reg_paginas);
	    $url = "mensajes_rec.php";

	    if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    // Muestro información de cantidad de registros, páginas, etc.
	    echo '<p>Cantidad total de registros: '.$this->total_registros_mensajesRec .'<br>';
	    echo 'Cantidad de registros por página: '.$this->cant_reg_paginas.'<br>';
	    echo 'Mostrando la página '.$this->pagina.' de ' .$total_paginas.' paginas.</p>';
	    echo '<p>';
	        if ($total_paginas > 1) {
	            if ($this->pagina != 1)
	                echo '<a href="'.$url.'?pagina='.($this->pagina-1).'"> < </a>';
	                for ($i=1;$i<=$total_paginas;$i++) {
	                    if ($this->pagina == $i){
	                        // Si se muestra el índice de la página actual, no se coloca enlace.
	                        echo $this->pagina;
	                    }else{
	                        // Si el índice no corresponde con la página mostrada actualmente, 
	                        // se coloca el enlace para ir a esa página.
	                        echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
	                    }
	                }
	            if ($this->pagina != $total_paginas)
	                echo '<a href="'.$url.'?pagina='.($this->pagina+1).'"> > </a>';
	        }
	    echo '</p>';
	}

	public function getPaginadoUsuarios(){

		//Llamo a las variables definidas al comienzo.
	    $this->getConsultas();

	    // Calculo el total de páginas.
	    // Funcion ceil(): redondea fracciones hacia arriba.
	    $total_paginas = ceil($this->total_registros_usuarios / $this->cant_reg_paginas);
	    $url = "usuarios.php";

	    if (isset($_GET["pagina"])){
	            $this->pagina = $_GET["pagina"];
	        }
	        
	        // Si la variable pagina no tiene valor
	        if (!$this->pagina){
	            $inicio = 0;
	            $this->pagina = 1;
	        }else{
	            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
	    }

	    // Muestro información de cantidad de registros, páginas, etc.
	    echo '<p>Cantidad total de registros: '.$this->total_registros_usuarios .'<br>';
	    echo 'Cantidad de registros por página: '.$this->cant_reg_paginas.'<br>';
	    echo 'Mostrando la página '.$this->pagina.' de ' .$total_paginas.' paginas.</p>';
	    echo '<p>';
	        if ($total_paginas > 1) {
	            if ($this->pagina != 1)
	                echo '<a href="'.$url.'?pagina='.($this->pagina-1).'"> < </a>';
	                for ($i=1;$i<=$total_paginas;$i++) {
	                    if ($this->pagina == $i){
	                        // Si se muestra el índice de la página actual, no se coloca enlace.
	                        echo $this->pagina;
	                    }else{
	                        // Si el índice no corresponde con la página mostrada actualmente, 
	                        // se coloca el enlace para ir a esa página.
	                        echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
	                    }
	                }
	            if ($this->pagina != $total_paginas)
	                echo '<a href="'.$url.'?pagina='.($this->pagina+1).'"> > </a>';
	        }
	    echo '</p>';
	}

	//Busco las encomiendas, desde la página principal como un cliente,
	//con su número de encomienda.

	public function rastreoEncomienda(){

	    if(isset($_POST['buscar'])){

	        // Declaro una variable para almacenar el valor ingresado en la caja de texto
	        if($_POST['ingreso'] == null){
	            echo "Debe ingresar un código de rastreo.";
	        }else{

	            $busqueda = $_POST['ingreso'];  
	                                            
	            // Guardo en una variable la consulta SQL para realizar la busqueda.
	            // Utilizo LIKE para el campo código que tiene la tabla, también se utilizan
	            // comodines ya que no sabemos en que lugar del valor de los campos se encuentra la cadena ingresada por el usuario.
	            $consulta = "SELECT * FROM encomiendas WHERE codigo LIKE '%$busqueda%'";
	            $rastreo = $this->db->query($consulta);
	            
	            // Almacenamos en una variable la cantidad de filas de registros 
	            // que se encuentra en la consulta de SQL
	            $numfilas = mysqli_num_rows($rastreo);
	            
	            echo "<br>Cantidad de registros encontrados: ".$numfilas."<br><br>";
	            
	            // Si se encuentran registros para la consulta los mostramos
	            if($numfilas>0){
	                while ($encontrado = $rastreo -> fetch_assoc()){

	                    echo 'Paquete '.$encontrado['codigo'].'<br>'.'<br>';
	                    if ($encontrado['estado_desp'] == 0){
	                    	echo 'La encomienda aún no fue entregada.'.'<br>';
	                    	echo 'Enviado por '.$encontrado['nombre_remit'].' a '.$encontrado['nombre_dest'].'<br>';
	                    	echo 'Enviado desde '.$encontrado['ciudad_origen'].'<br>';
	                    	echo 'Enviado a '.$encontrado['ciudad_destino'].' - '.$encontrado['direccion_destino'].'<br>';
	                    }else{
	                    	echo 'La encomienda ya fue entregada.'.'<br>'.'<br>';
	                    	echo 'Enviado por '.$encontrado['nombre_remit'].' a '.$encontrado['nombre_dest'].'<br>';
	                    	echo 'Enviado desde '.$encontrado['ciudad_origen'].'<br>';
	                    	echo 'Enviado a '.$encontrado['ciudad_destino'].' - '.$encontrado['direccion_destino'].'<br>';
	                    };
	                    
	                }
	            }else{
	                echo ("No se encontraron registros para la busqueda.");
	            }
	        
	        }
	    }
	}

	//Recepción de encomiendas desde los usuarios de Recepción.

	public function recepcionEncomiendaRec(){

		if(isset($_POST['guardarRec'])){

			// realizo consulta y obtengo los registros de la BD con la cedula ingresada.
		    $this->consulta_registros=$this->db->query("SELECT * FROM encomiendas WHERE codigo='".$_POST["codigo"]."'");
		    
		    //creo una variable donde guardo la cantidad de registros de la consulta
		    $this->total_registros = mysqli_num_rows($this->consulta_registros);

		    echo("$this->total_registros");
		    
		    // si hay registros...
		    if ($this->total_registros > 0) {

		    //No puede haber dos encomiendas con el mismo código (clave primaria).

				echo '<script language="javascript">';
				echo 'alert("Existe una encomienda con este código.\nDebe utilizar uno distinto.");';
				echo '</script>';
			//	exit();
			//	return false;	// NO VUELVE AL FORM COMPLETO, SE SALE!!!!!!!!!!

		    }else{

	    	$sql = "INSERT INTO encomiendas VALUES (
	    		'".$_POST["fecha_rec"]."',
	    		'".$_POST["hora_rec"]."',
	    		'".$_POST["ciudad_origen"]."',
	    		'".$_POST["ciudad_destino"]."',
	    		'".$_POST["tipo_paquete"]."',
	    		'".$_POST["direccion_destino"]."',
	    		'".$_POST["nombre_dest"]."',
	    		'".$_POST["tel_dest"]."',
	    		'".$_POST["nombre_remit"]."',
	    		'".$_POST["tel_remit"]."',
	    		'".$_POST["codigo"]."',
	    		'".$_POST["observaciones"]."',
	    		'".$_POST["estado_desp"]."',
	    		'".$_POST["estado_cancel"]."');";

			$this->db->query($sql);

			echo '<script language="javascript">';
			echo 'alert("Encomienda recibida exitosamente.");';
			echo 'window.location.href = "../recepcion/encomiendas_rec.php";';
			echo '</script>';
			}
		}
	}

	//Recepción de encomiendas desde los usuarios de Admin.

	public function recepcionEncomiendaAdmin(){

		if(isset($_POST['guardarAdmin'])){

			// realizo consulta y obtengo los registros de la BD con la cedula ingresada.
		    $this->consulta_registros=$this->db->query("SELECT * FROM encomiendas WHERE codigo='".$_POST["codigo"]."'");
		    
		    //creo una variable donde guardo la cantidad de registros de la consulta
		    $this->total_registros = mysqli_num_rows($this->consulta_registros);

		    echo("$this->total_registros");
		    
		    // si hay registros...
		    if ($this->total_registros > 0) {

		    //No puede haber dos encomiendas con el mismo código (clave primaria).

				echo '<script language="javascript">';
				echo 'alert("Existe una encomienda con este código.\nDebe utilizar uno distinto.");';
				echo '</script>';
			//	return true;
			//	exit();
			//	return false;	// NO VUELVE AL FORM COMPLETO, SE SALE!!!!!!!!!!

		    }else{

		    	$sql = "INSERT INTO encomiendas VALUES (
		    	'".$_POST["fecha_rec"]."',
		    	'".$_POST["hora_rec"]."',
		    	'".$_POST["ciudad_origen"]."',
		    	'".$_POST["ciudad_destino"]."',
		    	'".$_POST["tipo_paquete"]."',
		    	'".$_POST["direccion_destino"]."',
		    	'".$_POST["nombre_dest"]."',
		    	'".$_POST["tel_dest"]."',
		    	'".$_POST["nombre_remit"]."',
		    	'".$_POST["tel_remit"]."',
		    	'".$_POST["codigo"]."',
		    	'".$_POST["observaciones"]."',
		    	'".$_POST["estado_desp"]."',
		    	'".$_POST["estado_cancel"]."');";

				$this->db->query($sql);

				echo '<script language="javascript">';
				echo 'alert("Encomienda recibida exitosamente.");';
				echo 'window.location.href = "../admin/encomiendas_admin.php";';
				echo '</script>';
			}
		}
	}

	//Buscar encomiendas desde Recepción, con su código o nombre de remitente.

	public function buscarEncomiendasRec(){
	    
	    if(isset($_POST['buscarEncRec'])){

	        // Declaro una variable para almacenar el valor ingresado en la caja de texto
	        if($_POST['codigoNomRem'] == null){

	            echo "Debe ingresar un código de rastreo.";

	        }else{

	            $busqueda = $_POST['codigoNomRem'];

	            //Busco en el campo codigo y en el de nombre de remitente, usando comodines.  
	                                            
	            $consulta = "SELECT * FROM encomiendas WHERE codigo LIKE '%$busqueda%' OR nombre_remit LIKE '%$busqueda%' AND estado_desp='0'";

				// realizo consulta y obtengo los registros de la BD
			    $this->consulta_registros=$this->db->query($consulta);
			    
			    //creo una variable donde guardo la cantidad de registros de la consulta
			    $this->total_registros = mysqli_num_rows($this->consulta_registros);
			    
			    // si hay registros...
			    if ($this->total_registros > 0) {

			        // Examinamos la página a mostrar y el inicio del registro a mostrar
			        if (isset($_GET["pagina"])){
			            $this->pagina = $_GET["pagina"];
			        }
			        
			        // Si la variable pagina no tiene valor
			        if (!$this->pagina){
			            $inicio = 0;
			            $this->pagina = 1;
			        }else{
			            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
			    }

			    $consulta = "SELECT * FROM encomiendas WHERE codigo LIKE '%$busqueda%' OR nombre_remit LIKE '%$busqueda%' AND estado_desp='0' ORDER BY fecha_rec";
		    	
		    	$rs = $this->db->query($consulta);

			    while($filas=$rs->fetch_assoc()){
			        $this->encomiendas[]=$filas;
			    }
			            
			    return $this->encomiendas;

			    }else{
			    	header("location:encomiendas_rec_buscar_sr.php");
			    }

			}
		}
	}

	//Buscar encomiendas desde Admin, con su código o nombre de remitente.

	public function buscarEncomiendasAdmin(){
	    
	    if(isset($_POST['buscarEncAdmin'])){

	        // Declaro una variable para almacenar el valor ingresado en la caja de texto
	        if($_POST['codigoNomRem'] == null){

	            echo "Debe ingresar un código de rastreo.";

	        }else{

	            $busqueda = $_POST['codigoNomRem'];

	            //Busco en el campo codigo y en el de nombre de remitente, usando comodines.   
	                                            
	            $consulta = "SELECT * FROM encomiendas WHERE codigo LIKE '%$busqueda%' OR nombre_remit LIKE '%$busqueda%'";

				// realizo consulta y obtengo los registros de la BD
			    $this->consulta_registros=$this->db->query($consulta);
			    
			    //creo una variable donde guardo la cantidad de registros de la consulta
			    $this->total_registros = mysqli_num_rows($this->consulta_registros);
			    
			    // si hay registros...
			    if ($this->total_registros > 0) {

			        // Examinamos la página a mostrar y el inicio del registro a mostrar
			        if (isset($_GET["pagina"])){
			            $this->pagina = $_GET["pagina"];
			        }
			        
			        // Si la variable pagina no tiene valor
			        if (!$this->pagina){
			            $inicio = 0;
			            $this->pagina = 1;
			        }else{
			            $inicio = ($this->pagina - 1) * $this->cant_reg_paginas;
			    }

			    $consulta = "SELECT * FROM encomiendas WHERE codigo LIKE '%$busqueda%' OR nombre_remit LIKE '%$busqueda%' ORDER BY fecha_rec";
		    	
		    	$rs = $this->db->query($consulta);

			    while($filas=$rs->fetch_assoc()){
			        $this->encomiendas[]=$filas;
			    }
			            
			    return $this->encomiendas;

			    }else{
			    	header("location:encomiendas_admin_buscar_sr.php");
			    }

			}
		}
	}

}	// ÚLTIMO CIERRE DE LLAVE

?>