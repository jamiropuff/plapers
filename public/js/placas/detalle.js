document.addEventListener("DOMContentLoaded",async()=>{
    const id=getIdProducto();
    if(!id) return;
    await cargarProducto(id);
    renderProducto();
    inicializarEventos();
});
