function validar() {
	var nombre, apellidos, correo, usuario, clave, telefono, expresion;
	nombre = document.getElementById("nombre").value;
	apellidos = document.getElementById("apellidos").value;
	correo = document.getElementById("correo").value;
	mascota = document.getElementById("mascota").value;
	contanos = document.getElementById("contanos").value;
	telefono = document.getElementById("telefono").value;

	expresion = /\w+@\w+\.+[a-z]/;

	if (nombre === "" || apellidos === ""  || correo === "" || mascota === "" || contanos === "" || telefono === ""){
		alert("Todos los campos son obligatorios");
		return false;
	}
	else if (nombre.length>30){
		alert("El nombre es muy largo");
		return false;
	}
	else if (apellidos.length>80){
		alert("Los apellidos son muy largos");
		return false;
	}
	else if (correo.length>100){
		alert("El correo es muy largo");
		return false;
	}
	else if (!expresion.test(correo)){
		alert("El correo no es válido");
		return false;
	}
	else if (telefono.length>15){
		alert("El teléfono es muy largo");
		return false;
	}
	else if (isNaN(telefono)){
		alert("El teléfono ingresado no es de tipo numerico");
		return false;
	}
}