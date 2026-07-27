async function cargarProducto(id){
    const r=await fetch(`${config.API_URL}tienda/detalles_producto/${id}`);
    const j=await r.json();
    if(j.Code!==codes.SUCCESS){
        alert(j.Msg);
        return;
    }
    window.PlacaState.datos=j.Producto;
}
