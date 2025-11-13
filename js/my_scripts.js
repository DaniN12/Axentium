
document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("toggleFormularios");
    const cerrarBtn = document.getElementById("cerrarFormularios");
    const contenedor = document.getElementById("formulariosContainer");

    // Asegurar que los elementos existan
    if (!toggleBtn || !cerrarBtn || !contenedor) {
        console.error("Error: No se encontraron los elementos necesarios.");
        return;
    }

    // Mostrar los formularios
    toggleBtn.addEventListener("click", () => {
        contenedor.style.display = "block"; // se muestra
        contenedor.classList.add("animate__animated", "animate__fadeIn"); // si usas animate.css
        toggleBtn.classList.add("d-none"); // ocultar botón
    });

    // Cerrar los formularios
    cerrarBtn.addEventListener("click", () => {
        contenedor.style.display = "none"; // se oculta
        toggleBtn.classList.remove("d-none"); // mostrar botón
    });
});

