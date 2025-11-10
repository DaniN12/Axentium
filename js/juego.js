document.addEventListener("DOMContentLoaded", () => {
  if (!window.preguntas || !document.getElementById("temporizador")) return;

  const preguntas = window.preguntas;
  const baseUrl = window.baseUrl;

  const textoPregunta = document.getElementById("texto-pregunta");
  const imagenContainer = document.getElementById("imagen-container");
  const imagenPregunta = document.getElementById("imagen-pregunta");
  const botones = document.querySelectorAll(".boton-respuesta");
  const barraProgreso = document.getElementById("barra-progreso");
  const textoProgreso = document.getElementById("texto-progreso");
  const mostrarTiempo = document.getElementById("temporizador");
  const contenedorJuego = document.getElementById("juego-container");

  let preguntaActual = 0;
  let tiempoRestante = 60;
  let respuestasCorrectas = 0;
  let cuentaAtras;
  let respuestasUsuario = [];

  function iniciarJuego() {
    mostrarPregunta(preguntaActual);
    iniciarTemporizador();
    actualizarProgreso();
  }

  function mostrarPregunta(indice) {
    const p = preguntas[indice];

    // Transición de salida
    textoPregunta.classList.add("fade-out");
    imagenContainer.classList.add("fade-out");
    document.getElementById("respuestas").classList.add("fade-out");

    setTimeout(() => {
      textoPregunta.textContent = p.pregunta;
      textoPregunta.classList.remove("fade-out");
      textoPregunta.classList.add("pregunta-animada", "fade-in");

      if (p.imagen) {
        imagenPregunta.src = p.imagen;
        imagenPregunta.style.display = "block";
      } else {
        imagenPregunta.style.display = "none";
      }
      imagenContainer.classList.remove("fade-out");
      imagenContainer.classList.add("fade-in");

      botones.forEach((btn, i) => {
        btn.textContent = p.respuestas[i];
        btn.className = "btn btn-outline-primary boton-respuesta";
        btn.disabled = false;
        btn.onclick = () => seleccionarRespuesta(i, p.correcta);
      });

      const contRes = document.getElementById("respuestas");
      contRes.classList.remove("fade-out");
      contRes.classList.add("fade-in", "pregunta-animada");
    }, 300);
  }

  function seleccionarRespuesta(elegida, correcta, preguntaId) {
    botones.forEach((boton, i) => {
      boton.disabled = true;
      if (i === correcta) {
        boton.classList.add("btn-success");
        boton.classList.remove("btn-outline-primary");
      }
      if (i === elegida && i !== correcta) {
        boton.classList.add("btn-danger");
        boton.classList.remove("btn-outline-primary");
      }
    });

    if (elegida === correcta) respuestasCorrectas++;
    respuestasUsuario.push({preguntaId, respuesta: elegida});

    setTimeout(() => siguientePregunta(), 1500);
  }

  function siguientePregunta() {
    preguntaActual++;
    actualizarProgreso();

    if (preguntaActual < preguntas.length) {
      mostrarPregunta(preguntaActual);
    } else {
      finalizarJuego();
    }
  }

  function actualizarProgreso() {
    const porcentaje = (preguntaActual / preguntas.length) * 100;
    barraProgreso.style.width = `${porcentaje}%`;
    textoProgreso.textContent = `Pregunta ${preguntaActual + 1}/${
      preguntas.length
    }`;
  }

  function iniciarTemporizador() {
    cuentaAtras = setInterval(() => {
      tiempoRestante--;
      mostrarTiempo.textContent = `⏱ ${tiempoRestante}`;
      if (tiempoRestante <= 0) {
        clearInterval(cuentaAtras);
        finalizarJuego();
      }
    }, 1000);
  }

  function finalizarJuego() {
    clearInterval(cuentaAtras);

    const tiempoUsado = 60 - tiempoRestante;
    const k = 5;
    const penalizacion = (tiempoUsado / preguntas.length) * k;
    const puntuacion = Math.max(
      Math.round(
        (respuestasCorrectas / preguntas.length) * 1000 - penalizacion
      ),
      0
    );

    const input = document.getElementById("input-puntuacion");
    input.value = puntuacion;
    document.getElementById("input-respuestas").value = JSON.stringify(respuestasUsuario);

    document.getElementById("form-puntuacion").submit();
  }

  iniciarJuego();
});
