<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3 id="form-title">Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <form id="auth-form">
                            <div class="mb-3">
                                <label for="name" class="form-label d-none" id="name-label">Nombre</label>
                                <input type="text" id="name" class="form-control d-none" placeholder="Nombre">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" id="email" class="form-control" required placeholder="correo@ejemplo.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" class="form-control" required placeholder="••••••••">
                            </div>
                            <div class="mb-3 d-none" id="confirm-password-group">
                                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                <input type="password" id="password-confirm" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100" id="submit-btn">Ingresar</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p id="toggle-text">¿No tienes cuenta? <a href="#" id="toggle-form">Regístrate</a></p>
                        </div>
                        <div id="error-message" class="alert alert-danger d-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById("auth-form");
        const nameInput = document.getElementById("name");
        const nameLabel = document.getElementById("name-label");
        const confirmPasswordGroup = document.getElementById("confirm-password-group");
        const passwordConfirm = document.getElementById("password-confirm");
        const submitBtn = document.getElementById("submit-btn");
        const formTitle = document.getElementById("form-title");
        const toggleText = document.getElementById("toggle-text");
        const toggleFormLink = document.getElementById("toggle-form");
        const errorMessage = document.getElementById("error-message");

        let isRegistering = false;

        toggleFormLink.addEventListener("click", (e) => {
            e.preventDefault();
            isRegistering = !isRegistering;
            if (isRegistering) {
                formTitle.textContent = "Registro";
                submitBtn.textContent = "Registrarse";
                toggleText.innerHTML = '¿Ya tienes cuenta? <a href="#" id="toggle-form">Inicia Sesión</a>';
                nameInput.classList.remove("d-none");
                nameLabel.classList.remove("d-none");
                confirmPasswordGroup.classList.remove("d-none");
            } else {
                formTitle.textContent = "Iniciar Sesión";
                submitBtn.textContent = "Ingresar";
                toggleText.innerHTML = '¿No tienes cuenta? <a href="#" id="toggle-form">Regístrate</a>';
                nameInput.classList.add("d-none");
                nameLabel.classList.add("d-none");
                confirmPasswordGroup.classList.add("d-none");
            }
        });

        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const name = nameInput.value;
            const passwordConfirmation = passwordConfirm.value;

            errorMessage.classList.add("d-none");

            const url = isRegistering ? "/api/register" : "/api/login";
            const body = isRegistering
                ? JSON.stringify({ name, email, password, password_confirmation: passwordConfirmation })
                : JSON.stringify({ email, password });

            const response = await fetch(url, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body
            });

            const data = await response.json();

            if (!response.ok) {
                errorMessage.textContent = data.error || "Ocurrió un error";
                errorMessage.classList.remove("d-none");
                return;
            }

            localStorage.setItem("token", data.token);
            window.location.href = "/dashboard";
        });
    </script>
</body>
</html>
