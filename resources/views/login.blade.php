<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace al archivo CSS de Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login - Juan Time</title>
    <script>
        async function login(event) {
            event.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            const response = await fetch("/api/login", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();
            if (response.ok) {
                localStorage.setItem("token", data.access_token);
                window.location.href = "/resources/views/dashboard.blade.php";
            } else {
                alert(data.message);
            }
        }
    </script>
</head>
<body>
    <div class="container">
    <h2 class="mb-3 text-center text-black dark:text-white">Iniciar Sesión</h2>
    <form onsubmit="login(event)" action="/api/login" method="POST" class="mb-3 w-50">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" required class="form-control"><br>
        <label>Contraseña:</label>
        <input type="password" id="password" required class="form-control"><br>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
    </div>
    <!-- Enlace a los archivos JavaScript de Bootstrap 5 y Popper en un solo archivo (bootstrap.bundle.min.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
