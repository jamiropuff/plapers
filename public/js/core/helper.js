function getIdProducto(){
 const p=location.pathname.split("/");
 return p[p.length-1];
}
function inicializarEventos(){
 const b=document.getElementById("btnAgregar");
 if(b) b.addEventListener("click",agregarACarrito);
}
