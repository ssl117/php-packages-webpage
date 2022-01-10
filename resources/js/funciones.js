document.addEventListener('DOMContentLoaded', function() {

}, false);

// VALIDACIÓN FORMULARIO DE ALTA DE USUARIO

function validarFormAltaUsuario(){	

	// 1er. CHEQUEO CEDULA

	var cedula = document.getElementById("cedula").value;	//OBTENGO LA CEDULA

	if (cedula == "" || isNaN(cedula) == true || cedula.length < 7 || cedula.length > 8){

		alert("Debe ingresar un número de 7-8 dígitos.");
		return false;

	}else{

		var cedula = document.getElementById("cedula").value;	//OBTENGO LA CEDULA
		var arr = cedula.toString().split('');	//CREO UN ARRAY

		for (i=0; i < arr.length; i++){
			arr[i] = +arr[i]|0;
		}
		
		for (i=0; i < arr.length; i++){	//REALIZO LAS MULTIPLICACIONES DE CADA DÍGITO
			num2 = arr[0] * 2;
			num9 = arr[1] * 9;
			num8 = arr[2] * 8;
			num7 = arr[3] * 7;
			num6 = arr[4] * 6;
			num3 = arr[5] * 3;
			num4 = arr[6] * 4;
		}
		
		var sumaCedula = num2+num9+num8+num7+num6+num3+num4;
		var arr2 = sumaCedula.toString().split('');
		var cedulaBien = arr[0]+"."+arr[1]+arr[2]+arr[3]+"."+arr[4]+arr[5]+arr[6]+"-"+arr[7];
		
		for (i=0; i < arr2.length; i++){
			arr2[i] = +arr2[i]|0;
		}
		
		if (isNaN(10 - arr2[(arr2.length-1)]) == false){
			var digitoVer = 10 - arr2[(arr2.length-1)];		//CALCULO EL DÍGITO VERIFICADOR
		
			if (digitoVer == arr[7]){

				var nombre = document.getElementById("nombre").value;
				var letras = /^[a-zA-Z]+$/;
				
				if(nombre != "" && nombre.match(letras)){

					var apellido = document.getElementById("apellido").value;
					var letras = /^[a-zA-Z]+$/;

					if(apellido != "" && apellido.match(letras)){

						var clave = document.getElementById("clave").value;

						if(clave != "" && clave.length > 4 && clave.length < 15){

							var mail = document.getElementById("mail").value;

							if (mail != "" && /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){

						    	var tipoUsuario = document.getElementById("tipo_usuario").value;

								if (tipoUsuario == ""){

									alert("Debe seleccionar un tipo de Usuario.");
									return false;

								}else{
									
									if(window.confirm('¿Está seguro que desea dar de alta este Usuario?')){
									return true;
									
									}
								}

						  	}else{
								
								alert("Debe ingresar un mail válido.");
								return false;	
							}

						}else{
							
							alert("Debe ingresar una clave mayor a 5 dígitos y menor a 15 dígitos.");
							return false;
						}

					}else{
	
						alert("Debe ingresar un apellido válido (solo letras).");
						return false;
					}

				}else{

					alert("Debe ingresar un nombre válido (solo letras).");
					return false;
				}
				
			}else{

				alert("Debe ingresar una CI válida.");
				return false;
			}
		}
	}
}

//VALIDACION FORMULARIO DE CONSULTA

function validarFormContacto(){	

	// VALIDO NOMBRE

	var nombre = document.getElementById("nombre").value;
	var letras = /^[a-zA-Z\s-, ]+$/;
	
	if(nombre != "" && nombre.match(letras)){

		var mail = document.getElementById("mail").value;

		if (mail != "" && /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){

	    	var telefono = document.getElementById("telefono").value;

			if (telefono != "" && isNaN(telefono) == false && telefono.length > 7 && telefono.length < 10 ){

		    	var asunto = document.getElementById("asunto").value;

				if (asunto == ""){	

					alert("Debe ingresar un asunto.");
					return false;

				}else{
					
					var consulta = document.getElementById("consulta").value;

					if (consulta == ""){	

						alert("Debe ingresar su consulta.");
						return false;

					}else{
						
						return window.confirm('¿Está seguro que desea enviar esta Consulta?');
						
					}
					
				}

		  	}else{
				
				alert("Debe ingresar un teléfono válido.");
				return false;	
			}

	  	}else{
		
		alert("Debe ingresar un mail válido.");
		return false;

		}

	}else{

		alert("Debe ingresar un nombre válido (solo letras).");
		return false;
	}
}



// VALIDACIÓN FORMULARIO DE RECEPCIÓN DE ENCOMIENDAS


function validarRecepcionEnc(){

	var fecha_rec = document.getElementById("fecha_rec").value;

	if (fecha_rec == ""){	

		alert("Debe seleccionar una fecha de recepción de la encomienda.");
		return false;

	}else{
		
		var hora_rec = document.getElementById("hora_rec").value;

		if (hora_rec == ""){	

			alert("Debe seleccionar una hora de recepción de la encomienda.");
			return false;

		}else{
			
			var ciudad_origen = document.getElementById("ciudad_origen").value;

			if (ciudad_origen == ""){	

				alert("Debe seleccionar una ciudad de origen.");
				return false;

			}else{
				
				var ciudad_destino = document.getElementById("ciudad_destino").value;

				if (ciudad_destino == ""){	

					alert("Debe seleccionar una ciudad de destino.");
					return false;

				}else{
					
					var tipo_paquete = document.getElementById("tipo_paquete").value;

					if (tipo_paquete == ""){	

						alert("Debe seleccionar un tipo de paquete.");
						return false;

					}else{
						
						var direccion_destino = document.getElementById("direccion_destino").value;

						if (direccion_destino == ""){	

							alert("Debe seleccionar una dirección de destino.");
							return false;

						}else{
							
							var nombre_dest = document.getElementById("nombre_dest").value;
							var letras = /^[a-zA-Z\s-, ]+$/;
								
							if(nombre_dest != "" && nombre_dest.match(letras)){

								var tel_dest = document.getElementById("tel_dest").value;

								if (tel_dest != "" && isNaN(tel_dest) == false && tel_dest.length > 7 && tel_dest.length < 10 ){

							    	var nombre_remit = document.getElementById("nombre_remit").value;
									var letras2 = /^[a-zA-Z\s-, ]+$/;
									
									if(nombre_remit != "" && nombre_remit.match(letras2)){

										var tel_remit = document.getElementById("tel_remit").value;

										if (tel_remit != "" && isNaN(tel_remit) == false && tel_remit.length > 7 && tel_remit.length < 10 ){

									    	var codigo = document.getElementById("codigo").value;

											if (codigo == "" ){

										    	alert("El campo código no puede estar vacío.");
												return false;

											}else{

												var codigo = document.getElementById("codigo").value;

												if (!(codigo.length == 12) == true){

													alert("Debe ingresar un código de encomienda válido.\n"
														+ "Este debe estar compuesto por las dos primeras letras del nombre y del apellido, "
														+ "y debe tener los 8 dígitos de la fecha del día.\n"
														+ "Debe tener en total 12 dígitos alfanuméricos.");
													return false;
												
												}else{

													if(window.confirm('¿Está seguro que desea guardar esta Encomienda?')){
													return true;

													}
												}
											}

									  	}else{
											
											alert("Debe ingresar un teléfono de remitente válido.\n"
													+ "Debe tener 8 o 9 dígitos.");
											return false;	
										}

									}else{

										alert("Debe ingresar un nombre de remitente válido (solo letras).");
										return false;
									}

							  	}else{
									
									alert("Debe ingresar un teléfono de destinatario válido.\n"
											+ "Debe tener 8 o 9 dígitos.");
									return false;	
								}

							}else{

								alert("Debe ingresar un nombre de destinatario válido (solo letras).");
								return false;
							}
						}
					}
				}
			}
		}
	}
}