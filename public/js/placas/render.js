function renderProducto(){
 const p=window.PlacaState.datos;
 if(!p) return;
 document.getElementById("nombreProducto").textContent=p.nom_producto??"";
 document.getElementById("claveProducto").textContent=p.clave??"";
 document.getElementById("descripcionProducto").textContent=p.descripcion??"";
}
