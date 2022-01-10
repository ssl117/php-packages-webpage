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
									<h1 id="titulo-rec-enc">Formulario de Alta de Usuarios</h1>
									</br>

									<form action="" method="POST" onsubmit="return validarFormAltaUsuario();">
										<p>
					                        <label>Cedula:</label>
					                        <input type="text" id="cedula" name="cedula" autofocus="true" class="form-control" required="true" />
					                    </p>
					                    <p>
					                        <label>Nombre:</label>
					                        <input type="text" id="nombre" name="nombre" autofocus="true" class="form-control" required="true" title="Debe ingresar un nombre." />
					                    </p>
					                    <p>
					                        <label>Apellido:</label>
					                        <input type="text" id="apellido" name="apellido" autofocus="true" class="form-control" required="true" />
					                    </p>
					                    <p>
					                    	<label>Contraseña:</label>
					                        <input type="password" id="clave" name="clave" autofocus="true" class="form-control" autocomplete="new-password" required="true" />
					                    </p>
					                    <p>
					                    	<label>Mail:</label>
					                        <input type="email" id="mail" name="mail" autofocus="true" class="form-control" required="true" />
					                    </p>
					                    <p>
					                    	<label>Tipo de Usuario:</label>
					                        <select type="text" id="tipo_usuario" name="tipo_usuario" class="form-control" required="true" >
												<option value="" selected="selected"> -Seleccione- </option>
												<option value="Recepcion"> Recepción </option>
												<option value="Administrador"> Administrador </option>
											</select>
					                    </p>
						                    <input type="hidden" id="estado" name="estado" value="0" />
						                    
					                    	<button  type="submit" name="altaUsuario" class="button">Guardar</button>
					                     
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