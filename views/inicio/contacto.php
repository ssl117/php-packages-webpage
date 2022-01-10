<?php
	include "llamada_metodos.php";
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
				include "nav_pannel.php";
				?>

			<!-- Main -->
				<div id="main">
					<div class="container">
						<div class="row main-row">
							
							<div class="col-4 col-12-medium">

								<section>
									<h2>contacto</h2>
									<p>Gracias por contactarse con nosotros. </br>Recibirá una respuesta dentro de las próximas 24 horas.</p>
								</section>

							</div>

							<div class="col-4 col-12-medium">

								<h2>formulario de consulta</h2>

								<form action="" onsubmit="return validarFormContacto();" method="POST" >
		
									<p>
					                   <label>NOMBRE COMPLETO:</label>
					                   <input type="text" id="nombre" name="nombre" autofocus="true" class="form-control" required="true" />
					                </p>
					                <p>
					                   <label>E-MAIL:</label>
					                   <input type="email" id="mail" name="mail" autofocus="true" class="form-control" required="true" />
					                </p>
					                <p>
					                   <label>TELEFONO:</label>
					                   <input type="text" id="telefono" name="telefono" autofocus="true" class="form-control" required="true" />
					                </p>
					                <p>
					                   <label>ASUNTO:</label>
					                   <input type="text" id="asunto" name="asunto" autofocus="true" class="form-control" required="true" />
					                </p>

										<textarea rows="8" cols="35" id="consulta" name="consulta" class="form-control" required="true" ></textarea>

									<input type="hidden" name="estado" value="0" />

									<br/><br/>
									
									<input type="submit" name="envioConsulta" class="button" value="Enviar">

								</form>

							</div>

							<div class="col-4 col-12-medium">

								<section>
									<img src="../../resources/images/contacto.png" alt="" class="left" />
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