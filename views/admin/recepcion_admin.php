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
									<img src="../../resources/images/stackbox-rec.jpg" >
								</section>

							</div>	
							<div class="col-4 col-12-medium">
								<section>
									<h1 id="titulo-rec-enc">Formulario de Recepción de Encomienda</h1>
									</br>
									<form action="" onsubmit="return validarRecepcionEnc();" method="POST">
										<p>
					                        <label>Fecha:</label>
					                        <input type="date" id="fecha_rec" name="fecha_rec" autofocus="true" class="form-control" required="true" />
					                    </p>
					                    <p>
					                        <label>Hora:</label>
					                        <select type="text" id="hora_rec" name="hora_rec" class="form-control" required="true">
												<option value="09" selected="selected"> 9.00 hrs </option>
												<option value="10"> 10.00 hrs </option>
												<option value="11"> 11.00 hrs </option>
												<option value="12"> 12.00 hrs </option>
												<option value="13"> 13.00 hrs </option>
												<option value="14"> 14.00 hrs </option>
												<option value="15"> 15.00 hrs </option>
												<option value="16"> 16.00 hrs </option>
												<option value="17"> 17.00 hrs </option>
												<option value="18"> 18.00 hrs </option>
											</select>
					                    </p>
					                    <p>
					                    	<label>Ciudad Origen:</label>
					                    	<select type="text" id="ciudad_origen" name="ciudad_origen" class="form-control" required="true">
												<option value="Montevideo" selected="selected">Montevideo</option>
												<option value="Artigas">Artigas</option>
												<option value="Canelones">Canelones</option>
												<option value="Cerro Largo">Cerro Largo</option>
												<option value="Colonia">Colonia</option>
												<option value="Durazno">Durazno</option>
												<option value="Flores">Flores</option>
												<option value="Florida">Florida</option>
												<option value="Lavalleja">Lavalleja</option>
												<option value="Maldonado">Maldonado</option>
												<option value="Paysandu">Paysandú</option>
												<option value="Rio Negro">Río Negro</option>
												<option value="Rivera">Rivera</option>
												<option value="Rocha">Rocha</option>
												<option value="Salto">Salto</option>
												<option value="San Jose">San José</option>
												<option value="Soriano">Soriano</option>
												<option value="Tacuarembo">Tacuarembó</option>
											</select>
					                    </p>
					                    <p>
					                    	<label>Ciudad Destino:</label>
					                    	<select type="text" id="ciudad_destino" name="ciudad_destino" class="form-control" required="true">
												<option value="Montevideo" selected="selected">Montevideo</option>
												<option value="Artigas">Artigas</option>
												<option value="Canelones">Canelones</option>
												<option value="Cerro Largo">Cerro Largo</option>
												<option value="Colonia">Colonia</option>
												<option value="Durazno">Durazno</option>
												<option value="Flores">Flores</option>
												<option value="Florida">Florida</option>
												<option value="Lavalleja">Lavalleja</option>
												<option value="Maldonado">Maldonado</option>
												<option value="Paysandu">Paysandú</option>
												<option value="Rio Negro">Río Negro</option>
												<option value="Rivera">Rivera</option>
												<option value="Rocha">Rocha</option>
												<option value="Salto">Salto</option>
												<option value="San Jose">San José</option>
												<option value="Soriano">Soriano</option>
												<option value="Tacuarembo">Tacuarembó</option>
											</select>
					                    </p>
					                    <p>
					                    	<label>Tipo de Paquete:</label>
					                    	<select type="text" id="tipo_paquete" name="tipo_paquete" class="form-control" required="true">
												<option value="" selected="selected"></option>
												<option value="grande"> Paquete Grande </option>
												<option value="chico"> Paquete Chico </option>
											</select>
					                    </p>
					                    <p>
					                        <label>Dirección Destino:</label>
					                        <input type="text" id="direccion_destino" name="direccion_destino" autofocus="true" class="form-control" required="true" />
					                    </p>
					                    <p>
					                        <label>Nombre Destinatario:</label>
					                        <input type="text" id="nombre_dest" name="nombre_dest" class="form-control" required="true" />
					                    </p>
					                    <p>
					                    	<label>Teléfono Destinatario:</label>
					                        <input type="text" id="tel_dest" name="tel_dest" class="form-control" required="true" />
					                    </p>
					                    <p>
					                        <label>Nombre Remitente:</label>
					                        <input type="text" id="nombre_remit" name="nombre_remit" class="form-control" required="true" />
					                    </p>
					                    <p>
					                    	<label>Teléfono Remitente:</label>
					                        <input type="text" id="tel_remit" name="tel_remit" class="form-control" required="true" />
					                    </p>
					                    <p>
					                    	<label>Código Encomienda:</label>
					                        <input type="text" id="codigo" name="codigo" class="form-control" required="true" />
					                    </p>
					                    <p>
					                    	<label>Observaciones:</label>
					                        <input type="text" id="observaciones" name="observaciones" class="form-control" />
					                    </p>

						                    <input type="hidden" name="estado_desp" value="0" />
						                   
						                    <input type="hidden" name="estado_cancel" value="0" />
						                    
					                    	<button  type="submit" name="guardarAdmin" class="button">Guardar</button>
					                     
					                </form>
					               
								</section>
							</div>
							<div class="col-4 col-12-medium">

								<section>
									<img src="../../resources/images/bigbox-rec.jpg" >
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