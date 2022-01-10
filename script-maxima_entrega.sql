CREATE DATABASE maxima_entrega;
USE maxima_entrega;

CREATE TABLE encomiendas(
	fecha_rec DATE NOT NULL,
	hora_rec VARCHAR(5) NOT NULL,
	ciudad_origen VARCHAR(50) NOT NULL,
	ciudad_destino VARCHAR(50) NOT NULL,
	tipo_paquete VARCHAR(50) NOT NULL,
	direccion_destino VARCHAR(200) NOT NULL,
	nombre_dest VARCHAR(50) NOT NULL,
	tel_dest INT(10),
	nombre_remit VARCHAR(50) NOT NULL,
	tel_remit INT(10),
	codigo VARCHAR(13) PRIMARY KEY,
	observaciones VARCHAR(1000) NOT NULL,
	estado_desp INT(1),
	estado_cancel INT(1)
);

INSERT INTO encomiendas(fecha_rec, hora_rec, ciudad_origen,	ciudad_destino,	tipo_paquete, direccion_destino, 
	nombre_dest, tel_dest, nombre_remit, tel_remit, codigo, observaciones, estado_desp, estado_cancel) VALUES

("2018-01-15","10","Montevideo","Canelones", "grande","Av. Artigas 1569","Julio Lagos","43736980","Cecilia Milane","27101562","CEMI15012018","tabla surf","0","0"),
("2018-02-04","9","Montevideo","Maldonado", "grande","Roosvelt 2663","Zelmar Anselmi","42236718","Jose Diaz","29126784","JODI04022018","","0","0"),
("2018-02-20","16","Montevideo","Montevideo", "chico","Millan 1223","Joaquin Chaco","25319966","Pedro Changazzi","24015252","PECH20022018","","0","0"),
("2018-03-04","15","Montevideo","Canelones", "chico","25 de Agosto Nro. 8","Lorena Barrate","43736962","Alonso Maceta","24082486","LOBA04032018","","0","0"),
("2018-03-12","11","Montevideo","Salto", "grande","Gral. Rivera 1572","Victoria Castro","47340028","Florencia Pilar","26003287","VICA12032018","pelota rugby","0","0"),
("2018-04-04","10","Montevideo","Montevideo", "grande","San José 1489","Laura Brios","22105687","Agustina Zanazzi","22015478","LABR04042018","","0","0"),
("2018-04-13","8","Montevideo","Canelones", "chico","Grito de Ascencio 19","Santiago Carroza","43735589","Rodrigo Mendez","23201872","SACA13042018","","0","0"),
("2018-04-28","14","Montevideo","Montevideo", "grande","Ellauri 1245","Miguel Bermudez","27124249","Hernan Champi","27096235","MIBE28042018","rueda","0","0"),
("2018-05-16","15","Montevideo","Artigas", "chico","Tomas Berreta 640","Sofia Lanza","47727132","Daniel Galeno","24810480","SOLA16052018","pokemon","0","0"),
("2018-06-08","17","Montevideo","Montevideo", "grande","Nicaragua 2311","Agustin Sosa","24875874","Fernando Fila","26091547","AGSO08062018","","0","0")
;

CREATE TABLE usuarios(
	cedula INT (8) PRIMARY KEY,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	clave VARCHAR(32) NOT NULL,
	mail VARCHAR(100) NOT NULL,
	tipo_usuario VARCHAR(20) NOT NULL,
	estado INT (8)
);

INSERT INTO usuarios(cedula, nombre, apellido, clave, mail, tipo_usuario, estado) VALUES 
	("46595469","Sebastian","Silva","wifipro2018","seba.silva.17@gmail.com","Administrador","1"),
	("22222222","Valentina","Ferreyra","ezequiel2109","vfroig@gmail.com","Administrador","1"),
	("14033019","Hector","Magnone","emma1901","hmagnone@gmail.com","Recepcion","1"),
	("11111111","Juan","Perez","password","jpalonso@hotmail.com","Recepcion","1")
	;

CREATE TABLE mensajes(
	id INT (11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100) NOT NULL,
	mail VARCHAR(100) NOT NULL,
	telefono VARCHAR(10) NOT NULL,
	asunto VARCHAR(200) NOT NULL,
	consulta VARCHAR(1000) NOT NULL,
	estado VARCHAR(2) NOT NULL
);

INSERT INTO mensajes(nombre, mail, telefono, asunto, consulta, estado) VALUES 
	("Juan Andres","jaan1988@hotmail.com","12345678","entrega salto","buenas tardes, quisiera saber si realizan entregas en salto, muchas gracias!","0"),
	("Pedro Pintos","pp6677@gmail.com","75698451","demora entrega","que tal, cuanto demoran en entregar un paquete a rocha? gracias","0"),
	("Susana Rojas","lasusi09@hotmail.com","95624781","entrega en puerta","buenas noches, ustedes entregan los paquetes en la puerta de la casa?","0"),
	("Javier Infante","javi2311@gmail.com","78654125","tabla surf","buenas, cual es el costo por enviar una tabla de surf a maldonado?","0"),
	("Leo Acosta","leo5544@hotmail.com","85669191","animales","quisera saber si transportan animales, gracias","0"),
	("Luciana Saro","lusa88@gmail.com","77441236","prendas de vestir","hola!!! quería saber si realizan transporte de prendas delicadas, gracias!!","0")
	;
