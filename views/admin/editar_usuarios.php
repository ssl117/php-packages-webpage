<?php
	include "llamada_metodos_admin.php";
?>

<!DOCTYPE HTML>
<!--
	Minimaxing by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

	<!-- Header -->
		<?php
		include "../header.php";
		?>
	
	<body>
		
		<div id="page-wrapper">

			<!-- Nav -->
				<?php
				include "nav_pannel_admin.php";
				?>

			<!-- Main -->
				<div id="main">
					<div class="container">
						<div class="row main-row">
							<div class="col-4 col-12-medium">

								<section>
									<img src="../../resources/images/usuario.png" >
								</section>

							</div>	
							<div class="col-4 col-12-medium">
								<section>
									<h1 id="titulo-rec-enc">Edición de Usuarios</h1>
									</br>
										<form onsubmit="return validarFormAltaUsuario();" method="POST" >
										<p>
					                        <label>Cedula:</label>
					                        <input type="text" id="cedula" name="cedula" autofocus="true" class="form-control" required="true" value="<?php echo $_POST["cedula"]; ?>" readonly />
					                    </p>
					                    <p>
					                        <label>Nombre:</label>
					                        <input type="text" id="nombre" name="nombre" autofocus="true" class="form-control" required="true" value="<?php echo $_POST["nombre"]; ?>" />
					                    </p>
					                    <p>
					                        <label>Apellido:</label>
					                        <input type="text" id="apellido" name="apellido" autofocus="true" class="form-control" required="true" value="<?php echo $_POST["apellido"]; ?>" />
					                    </p>
					                    <p>
					                    	<label>Contraseña:</label>
					                        <input type="password" id="clave" name="clave" autofocus="true" class="form-control" required="true" autocomplete="new-password" value="" />
					                    </p>
					                    <p>
					                    	<label>Mail:</label>
					                        <input type="email" id="mail" name="mail" class="form-control" required="true" value="<?php echo $_POST["mail"]; ?>" />
					                    </p>
					                    <p>
					                    	<label>Tipo de Usuario:</label>
					                        <select type="text" id="tipo_usuario" name="tipo_usuario" class="form-control" required="true">
												<option value="<?php echo $_POST["tipo_usuario"]; ?>" selected="selected"><?php echo $_POST["tipo_usuario"]; ?></option>
												<option value="Recepcion"> Recepcion </option>
												<option value="Administrador"> Administrador </option>
											</select>
					                    </p>
						                    <input type="hidden" id="estado" name="estado" value="<?php echo $_POST["estado"]; ?>" />
						                    
					                    	<button  type="submit" name="editarUsuarios" class="button">Actualizar</button>
					                     
					                	</form>
					               
								</section>
							</div>
							<div class="col-4 col-12-medium">

								<section>
									
								</section>

							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<?php
				include "../footer.php";
				?>

		</div>

	</body>
</html>