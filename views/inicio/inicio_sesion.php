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
							<div class="col-4 col-12-medium" id="sesion-margin">

								<section>
									<img src="../../resources/images/usuario.png" >
								</section>								

							</div>
							<div class="col-4 col-12-medium" id="sesion-margin">
								<h2>ingreso de usuarios</h2>
									<form action="" method="POST">

										<h3>Nombre de Usuario</h3>
										<input type="text" name="usuario" placeholder="cedula" /> 
										</br></br>
										
										<h3>Contraseña</h3>
										<input type="password" name="contrasena" placeholder="contraseña" />
										</br></br>
																		
										<button type="submit" class="button" name="login"/>Ingresar</button>
									
									</form>

							</div>
							
							<div class="col-4 col-12-medium" id="sesion-margin">

								<section>
									<h2>problemas para ingresar?</h2>
									<ul class="small-image-list">
										<li>
											<img src="../../resources/images/phone.jpg" alt="" class="left" />
											<h3>Teléfono</h3>
											<p>Llame al 2400-2020. </p>
										</li>
										<li>
											<img src="../../resources/images/mail.jpg" alt="" class="left" />
											<h3>Mail</h3>
											<p>Contáctenos en </br>info@maximaentrega.com</p>
										</li>
									</ul>
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