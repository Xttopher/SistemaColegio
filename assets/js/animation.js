// Seleccionamos el botón por su ID
const boton = document.getElementById('boton-hover');

// Lista de colores para el fondo y el texto
const coloresFondo = [
    '#3498db', '#e74c3c', '#9b59b6', '#f39c12', '#2980b9',
    '#c0392b', '#2ecc71', '#16a085', '#f1c40f', '#8e44ad'
];

const coloresTexto = [
    '#ffffff', '#ecf0f1', '#7f8c8d', '#e74c3c', '#bdc3c7',
    '#2c3e50', '#f39c12', '#f1c40f', '#2ecc71', '#8e44ad'
];

// Añadimos un evento de 'click' al botón
boton.addEventListener('click', function() {
    // Añadimos la clase 'accionado' para activar la animación
    boton.classList.add('accionado');

    // Cambiar el texto a "Increíble!" cuando el botón llega al centro
    setTimeout(function() {
        boton.textContent = "Increíble!"; // Cambiar texto
    }, 3000); // Cambia el texto en el 40% de la animación (aproximadamente 3 segundos)

    // Función para cambiar los colores en ráfaga solo en el medio
    let contador = 0;
    let cambioColores = setInterval(function() {
        if (contador < coloresFondo.length) {
            boton.style.backgroundColor = coloresFondo[contador]; // Cambiar fondo
            boton.style.color = coloresTexto[contador]; // Cambiar color del texto
            contador++;
        } else {
            clearInterval(cambioColores); // Detener la ráfaga de colores
        }
    }, 100); // Cambiar cada 100 ms para lograr el efecto ráfaga rápido

    // Cambiar el texto de vuelta a "¡Haz click aquí!" cuando el botón regresa a su posición
    setTimeout(function() {
        boton.textContent = "¡Haz click aquí!"; // Volver al texto original
    }, 6500); // 6500 ms = 6.5 segundos (aproximadamente el 80% de la animación, justo antes de que termine)

    // Opcional: Si quieres que el botón vuelva a su estado original después de la animación
    setTimeout(function() {
        boton.classList.remove('accionado'); // Finaliza la animación
    }, 7000); // 7000 ms = 7 segundos (duración total de la animación)
});
