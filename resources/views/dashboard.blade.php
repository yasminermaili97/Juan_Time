<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script>
        async function getUser() {
            const token = localStorage.getItem("token");
            if (!token) return window.location.href = "/login";

            const response = await fetch("/api/user", {
                headers: { "Authorization": `Bearer ${token}` }
            });

            const data = await response.json();
            if (response.ok) {
                document.getElementById("username").textContent = data.name;
            } else {
                alert("Sesión expirada, inicie sesión nuevamente.");
                window.location.href = "/login";
            }
        }

        function logout() {
            localStorage.removeItem("token");
            window.location.href = "/login";
        }

        window.onload = getUser;
    </script>
</head>
<body>
    <h2>Bienvenido, <span id="username"></span></h2>
    <a href="/watches">Administrar Relojes</a>
    <button onclick="logout()">Cerrar Sesión</button>
</body>
</html>
