<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        async function getUser() {
            const token = localStorage.getItem("token");
            if (!token) return window.location.href = "/login";

            const response = await fetch("/api/user", {
                headers: { "Authorization": `Bearer ${token}` }
            });

            const data = await response.json();
            if (response.ok) {
                document.getElementById("username").textContent = data.user.name;
                loadWatches();
            } else {
                alert("Sesión expirada, inicie sesión nuevamente.");
                window.location.href = "/login";
            }
        }

        async function loadWatches() {
            const token = localStorage.getItem("token");
            const response = await fetch("/api/watches", {
                headers: { "Authorization": `Bearer ${token}` }
            });

            const result = await response.json();
            if (!result.status) {
                alert("Error al cargar los relojes.");
                return;
            }

            const watches = result.data;
            const tbody = document.getElementById("table-body");
            tbody.innerHTML = ""; 

            watches.forEach(watch => {
                let features = watch.feature.length > 0
                    ? watch.feature.map(f => f.name).join(", ")
                    : "Ninguna";

                let row = `<tr>
                    <td>${watch.id}</td>
                    <td>${watch.brand}</td>
                    <td>${watch.model}</td>
                    <td>${watch.year_edition}</td>
                    <td>${watch.price} €</td>
                    <td>${features}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteWatch(${watch.id})">Eliminar</button>
                    </td>
                </tr>`;
                tbody.innerHTML += row;
            });
        }

        async function deleteWatch(id) {
            const token = localStorage.getItem("token");

            const response = await fetch(`/api/watch/${id}`, {
                method: "DELETE",
                headers: { "Authorization": `Bearer ${token}` }
            });

            if (response.ok) {
                loadWatches();
            } else {
                alert("No se pudo eliminar el reloj.");
            }
        }

        function logout() {
            localStorage.removeItem("token");
            window.location.href = "/login";
        }

        window.onload = getUser;
    </script>
</head>
<body class="container mt-4">
    <header class="mb-4 text-center">
        <h1>Juan Time: Aplicación web interna para la gestión de relojes</h1>
    </header>

    <div class="text-end mb-3">
        <strong>Bienvenido, <span id="username"></span></strong>
    </div>

    <div class="mb-3 text-center">
        <button class="btn btn-primary" onclick="window.location.href='/new-watch'">Añadir Nuevo Reloj</button>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Precio</th>
                <th>Características</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="table-body">
           
        </tbody>
    </table>

    <footer class="text-center mt-4">
        <button class="btn btn-secondary" onclick="logout()">Salir</button>
    </footer>
</body>
</html>
