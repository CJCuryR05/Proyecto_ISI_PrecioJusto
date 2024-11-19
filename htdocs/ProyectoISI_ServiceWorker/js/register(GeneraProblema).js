const formRegister = document.querySelector(".form-register");
const inputFirstName = document.querySelector('.form-register input[name="firstName"]');
const inputLastName = document.querySelector('.form-register input[name="secondName"]');
const inputUsername = document.querySelector('.form-register input[name="userName"]');
const inputEmail = document.querySelector('.form-register input[name="userEmail"]');
const inputPassword = document.querySelector('.form-register input[name="userPassword"]');
const alertaError = document.querySelector(".alerta-error");
const alertaExito = document.querySelector(".alerta-exito");

const userNameRegex = /^[a-zA-Z0-9\_\-]{4,16}$/;
const emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
const passwordRegex = /^.{4,12}$/;

const estadoValidacionCampos = {
    firstName: false,
    lastName: false,
    userName: false,
    userEmail: false,
    userPassword: false,
};

document.addEventListener("DOMContentLoaded", () => {
    formRegister.addEventListener("submit", (e) => {
        e.preventDefault();
        enviarFormulario(formRegister, alertaError, alertaExito);
    });

    inputFirstName.addEventListener("input", () => {
        validarCampo(inputFirstName.value.trim() !== "", inputFirstName, "Por favor, ingresa tu primer nombre.");
    });

    inputLastName.addEventListener("input", () => {
        validarCampo(inputLastName.value.trim() !== "", inputLastName, "Por favor, ingresa tu segundo nombre.");
    });

    inputUsername.addEventListener("input", () => {
        validarCampo(userNameRegex.test(inputUsername.value), inputUsername, "El usuario tiene que ser de 4 a 16 dígitos y solo puede contener letras y guión bajo.");
    });

    inputEmail.addEventListener("input", () => {
        validarCampo(emailRegex.test(inputEmail.value), inputEmail, "El correo solo puede contener letras, números, puntos, guiones y guíon bajo.");
    });

    inputPassword.addEventListener("input", () => {
        validarCampo(passwordRegex.test(inputPassword.value), inputPassword, "La contraseña tiene que ser de 4 a 12 dígitos");
    });
});

function validarCampo(valido, campo, mensaje) {
    if (valido) {
        eliminarAlerta(campo.parentElement);
        estadoValidacionCampos[campo.name] = true;
        campo.parentElement.classList.remove("error");
    } else {
        estadoValidacionCampos[campo.name] = false;
        campo.parentElement.classList.add("error");
        mostrarAlerta(campo.parentElement, mensaje);
    }
}

function mostrarAlerta(referencia, mensaje) {
    eliminarAlerta(referencia);
    const alertaDiv = document.createElement("div");
    alertaDiv.classList.add("alerta");
    alertaDiv.textContent = mensaje;
    referencia.appendChild(alertaDiv);
}

function eliminarAlerta(referencia) {
    const alerta = referencia.querySelector(".alerta");
    if (alerta) alerta.remove();
}

function enviarFormulario(form, alertaError, alertaExito) {
    if (Object.values(estadoValidacionCampos).every((campo) => campo)) {
        Object.keys(estadoValidacionCampos).forEach((campo) => estadoValidacionCampos[campo] = false);
        form.reset();
        alertaExito.textContent = "¡Registro exitoso!";
        alertaExito.style.display = "block"; // Mostrar la alerta de éxito
        alertaError.style.display = "none"; // Ocultar la alerta de error
        setTimeout(() => {
            alertaExito.style.display = "none"; // Ocultar la alerta de éxito después de 3 segundos
        }, 3000);
    } else {
        alertaError.textContent = "Por favor, completa todos los campos correctamente.";
        alertaError.style.display = "block"; // Mostrar la alerta de error
        setTimeout(() => {
            alertaError.style.display = "none"; // Ocultar la alerta de error después de 3 segundos
        }, 3000);
    }
}

