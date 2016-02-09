function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function EliminarReserva(idreserva){
if(confirm("Usted esta seguro en eliminar esta reservacion?")){
ajax = objetoAjax();
ajax.open("POST", "Clases/eliminar_reserva.php", true);
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('El registro fue eliminado con exito!');			
      window.location.reload(true);
		}
	}
alert(idreserva);
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idreserva="+idreserva)
}else{
  alert("No se pudo eliminar este registro");
}
}