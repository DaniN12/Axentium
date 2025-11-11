
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

document.addEventListener("DOMContentLoaded", function() {
  const btnTop = document.getElementById("btnTop");
  const alphabetNav = document.querySelector(".alphabet-nav");

  window.addEventListener("scroll", () => {
    // Verifica la posición de la barra alfabética
    if (alphabetNav) {
      const rect = alphabetNav.getBoundingClientRect();
      if (rect.bottom < 0) {
        btnTop.classList.add("show");
      } else {
        btnTop.classList.remove("show");
      }
    } else {
      // Si no hay barra, simplemente muestra el botón tras cierto scroll
      if (window.scrollY > 200) {
        btnTop.classList.add("show");
      } else {
        btnTop.classList.remove("show");
      }
    }
  });

  // Acción del botón: volver arriba
  btnTop.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});