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
///////////////////////////////////////////////////////
/////////////////CLIENTES/////////////////////////////
/////////////////////////////////////////////////////
function RegistrarCliente(idcliente, accion){
cedula = document.frmClientes.cedula.value;
nombre = document.frmClientes.nombre.value;
apellido = document.frmClientes.apellido.value;
direccion = document.frmClientes.direccion.value;
telefono = document.frmClientes.telefono.value;
correo = document.frmClientes.correo.value;
tipocliente = document.frmClientes.tipocliente.value;
ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "clases/registrar.php", true);
}else if(accion=='E'){
ajax.open("POST", "clases/actualizar.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('Los datos fueron guardados con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("&idcliente="+idcliente+"&cedula="+cedula+"&nombre="+nombre+"&apellido="+apellido+"&direccion="+direccion+"&telefono="+telefono+"&correo="+correo+"&tipocliente="+tipocliente)
}

function EliminarCliente(idcliente){
if(confirm("En realizad desea eliminar este registro?")){
ajax = objetoAjax();
ajax.open("POST", "clases/eliminar.php", true);
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('El registro fue eliminado con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idcliente="+idcliente)
}else{
  //Sin acciones
}
}

///////////////////////////////////////////////////////
/////////////////PRODUCTO/////////////////////////////
/////////////////////////////////////////////////////

function RegistrarProducto(idproducto, accion){
codproducto = document.frmProducto.codproducto.value;
descripcion = document.frmProducto.descripcion.value;
stock = document.frmProducto.stock.value;
preciocosto = document.frmProducto.preciocosto.value;
preciomayor = document.frmProducto.preciomayor.value;
preciovp = document.frmProducto.preciovp.value;
ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "clases/registrarPro.php", true);
}else if(accion=='E'){
ajax.open("POST", "clases/actualizarPro.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('Los datos fueron guardados con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("&idproducto="+idproducto+"&codproducto="+codproducto+"&descripcion="+descripcion+"&stock="+stock+"&preciocosto="+preciocosto+"&preciomayor="+preciomayor+"&preciovp="+preciovp)
}

function EliminarProducto(idproducto){
if(confirm("En realizad desea eliminar este registro?")){
ajax = objetoAjax();
ajax.open("POST", "clases/eliminarPro.php", true);
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('El registro fue eliminado con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idproducto="+idproducto)
}else{
  //Sin acciones
}
}

////////////////////////////////////////////////////////
/////////////////PROVEEDOR/////////////////////////////
//////////////////////////////////////////////////////

function RegistrarProveedor(idproveedor, accion){
nombres = document.frmProveedor.nombres.value;
descripcion = document.frmProveedor.descripcion.value;
ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "clases/registrarProve.php", true);
}else if(accion=='E'){
ajax.open("POST", "clases/actualizarProve.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('Los datos fueron guardados con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("&idproveedor="+idproveedor+"&nombres="+nombres+"&descripcion="+descripcion)
}

function EliminarProveedor(idproveedor){
if(confirm("En realizad desea eliminar este registro?")){
ajax = objetoAjax();
ajax.open("POST", "clases/eliminarProve.php", true);
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('El registro fue eliminado con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idproveedor="+idproveedor)
}else{
  //Sin acciones
}
}

////////////////////////////////////////////////////////
/////////////////CABEZERA/////////////////////////////
//////////////////////////////////////////////////////

function Cabezera(idproveedor, accion){
nombres = document.frmProveedor.nombres.value;
descripcion = document.frmProveedor.descripcion.value;
ajax = objetoAjax();
if(accion=='N'){
ajax.open("POST", "clases/registrarProve.php", true);
}else if(accion=='E'){
ajax.open("POST", "clases/actualizarProve.php", true);
}
ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			alert('Los datos fueron guardados con exito!');
      window.location.reload(true);
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("&idproveedor="+idproveedor+"&nombres="+nombres+"&descripcion="+descripcion)
}

