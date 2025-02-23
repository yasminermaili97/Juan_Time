<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Relojes</title>
    <script>
        async function fetchWatches() {
            const response = await fetch("/api/watches");
            const watches = await response.json();
            let tableContent = "";

            watches.forEach(watch => {
                tableContent += `<tr>
                    <td>${watch.brand}</td>
                    <td>${watch.model}</td>
                    <td>${watch.price}</td>
                    <td>
                        <button onclick="editWatch(${watch.id})">Editar</button>
                        <button onclick="deleteWatch(${watch.id})">Eliminar</button>
                    </td>
                </tr>`;
            });

            document.getElementById("watchesTable").innerHTML = tableContent;
        }

        async function deleteWatch(id) {
            if (!confirm("¿Seguro que deseas eliminar este reloj?")) return;
            await fetch(`/api/watches/${id}`, { method: "DELETE" });
            fetchWatches();
        }

        window.onload = fetchWatches;
    </script>
</head>
<body>
    <h2>Lista de Relojes</h2>
    <a href="/watches/create">Agregar Reloj</a>
    <table border="1">
        <thead>
            <tr><th>Marca</th><th>Modelo</th><th>Precio</th><th>Acciones</th></tr>
        </thead>
        <tbody id="watchesTable"></tbody>
    </table>
</body>
</html>
