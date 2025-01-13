// Función para imprimir el reporte
function imprimirReporte() {
    var ventana = window.open('', '', 'width=800,height=600');  // Abre una nueva ventana
    var contenido = document.getElementById('ReporteMantenimiento').innerHTML;  // Obtiene el contenido del modal

    // Crear un documento HTML para la nueva ventana
    ventana.document.write('<html><head><title>Reporte de Mantenimiento</title>');
    ventana.document.write('<link rel="stylesheet" href="assets/css/impresion.css">');  // Vincula el CSS de impresión
    ventana.document.write('</head><body>');
    ventana.document.write(contenido);  // Inserta el contenido del modal
    ventana.document.write('</body></html>');
    
    // Cierra el documento y lo prepara para la impresión
    ventana.document.close();
    ventana.print();  // Inicia la impresión
}
