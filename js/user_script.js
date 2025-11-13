/******** Registro: cargar ciclos by centro *******/
const centroSelect = document.getElementById('centro');
const cicloSelect  = document.getElementById('ciclo');

centroSelect.addEventListener('change', async () => {
  const centroId = centroSelect.value;
  cicloSelect.innerHTML = '<option disabled selected>Cargando...</option>';
  cicloSelect.disabled = true;

  if (!centroId) return;

  try {
    const response = await fetch(`./control/ciclosByCentro_controller.php?centroId=${centroId}`);
    const data = await response.json();

    cicloSelect.innerHTML = '<option value="" disabled selected> -- Selecciona un ciclo -- </option>';

    if (data.ciclos && data.ciclos.length > 0) {
      data.ciclos.forEach(c => {
        const opt = document.createElement('option');
        opt.value = c.id;
        opt.textContent = c.nombre;
        cicloSelect.appendChild(opt);
      });
      cicloSelect.disabled = false;
    } else {
      const opt = document.createElement('option');
      opt.textContent = 'No hay ciclos disponibles para este centro';
      cicloSelect.appendChild(opt);
      cicloSelect.disabled = true;
    }

  } catch (error) {
    console.error('Error cargando ciclos:', error);
    cicloSelect.innerHTML = '<option>Error al cargar</option>';
    cicloSelect.disabled = true;
  }
});

/************ Registro: mostrar/oculta contraseña **************/
document.querySelectorAll('.toggle-pass').forEach(btn => {
  btn.addEventListener('click', () => {
    const inputId = btn.dataset.target;
    const input = document.getElementById(inputId);
    const icon  = btn.querySelector('i');

    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
      btn.setAttribute('aria-label', 'Ocultar contraseña');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
      btn.setAttribute('aria-label', 'Mostrar contraseña');
    }
  });
});


/*** Registro: validar campos onblur ***/
const username = document.getElementById('username');
const email    = document.getElementById('email');
const pass     = document.getElementById('pass');
const pass2    = document.getElementById('pass2');

function mostrarError(campo, mensaje) {
  const errorElem = document.getElementById(`error-${campo.id}`);
  campo.classList.add('is-invalid');
  errorElem.textContent = mensaje;
  errorElem.classList.remove('d-none');
}

function limpiarError(campo) {
  const errorElem = document.getElementById(`error-${campo.id}`);
  campo.classList.remove('is-invalid');
  errorElem.classList.add('d-none');
  errorElem.textContent = '';
}

function validarUsername() {
  if (username.value.trim().length < 3) {
    mostrarError(username, 'El nombre de usuario debe tener al menos 3 caracteres.');
  } else {
    limpiarError(username);
  }
}

function validarEmail() {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!regex.test(email.value.trim())) {
    mostrarError(email, 'Introduce un email válido.');
  } else {
    limpiarError(email);
  }
}

function validarPass() {
  if (pass.value.trim().length < 4) {
    mostrarError(pass, 'La contraseña debe tener al menos 4 caracteres.');
  } else {
    limpiarError(pass);
  }
}

function validarPass2() {
  if (pass2.value !== pass.value) {
    mostrarError(pass2, 'Las contraseñas no coinciden.');
  } else {
    limpiarError(pass2);
  }
}

// Asociamos las validaciones al evento blur
username.addEventListener('blur', validarUsername);
email.addEventListener('blur', validarEmail);
pass.addEventListener('blur', validarPass);
pass2.addEventListener('blur', validarPass2);

// Opcional: también validar al enviar el formulario
document.querySelector('form').addEventListener('submit', e => {
  validarUsername();
  validarEmail();
  validarPass();
  validarPass2();
  if (document.querySelectorAll('.is-invalid').length > 0) {
    e.preventDefault(); // Evita enviar si hay errores
  }
});