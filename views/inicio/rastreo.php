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
							<div class="col-4 col-12-medium" id="rastreo-margin">

								<section>
									<h2>búsqueda</h2>
									<p>Ingrese el código de su encomienda para ver sus datos y el estado de la misma.</p>
								</section>								

							</div>
							<div class="col-4 col-12-medium" id="rastreo-margin">
								<h2>rastreo de encomiendas</h2>
									
									<form action="" method="POST">
										<input type="text" name="ingreso" placeholder ="Código Encomienda"/>
										</br></br>
										<button type="submit" class="button" name="buscar"/>Buscar</button>									
									</form>

									<?php print $paquetes->rastreoEncomienda(); ?>
									
							</div>
							
							<div class="col-4 col-12-medium" id="rastreo-margin">

								<section>
									<img src="../../resources/images/lupa2.png" alt="" class="left" />
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