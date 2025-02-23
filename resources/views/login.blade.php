<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                window.location.href = "/dashboard";
            } else {
                alert(data.message);
            }
        }
    </script>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form onsubmit="login(event)">
        <label>Email:</label>
        <input type="email" id="email" required><br>
        <label>Contraseña:</label>
        <input type="password" id="password" required><br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
