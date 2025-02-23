<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reloj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script>
        async function createWatch(event) {
            event.preventDefault();

            const brand = document.getElementById("brand").value.trim();
            const model = document.getElementById("model").value.trim();
            const price = parseFloat(document.getElementById("price").value);
            const ean = document.getElementById("ean").value.trim();
            const year_edition = document.getElementById("year_edition").value;
        

            if (!brand || !model || !ean || !year_edition || !type_id || !strap_id) {
                alert("Todos los campos son obligatorios");
                return;
            }
            if (price <= 0) {
                alert("El precio debe ser mayor a 0");
                return;
            }

            const token = localStorage.getItem("token");
            const response = await fetch("/api/watch", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify({ brand, model, price, ean, year_edition})
            });

            const data = await response.json();

            if (response.ok) {
                alert("Reloj agregado con éxito");
                window.location.href = "/dashboard";
            } else {
                alert(` Error: ${data.message || "No se pudo agregar el reloj"}`);
            }
        }


        window.onload = loadOptions;
    </script>
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">Agregar Reloj</h2>
    
    <form onsubmit="createWatch(event)" class="card p-4 shadow">
        <div class="mb-3">
            <label class="form-label">Marca:</label>
            <input type="text" id="brand" class="form-control" placeholder="Ej. Casio" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Modelo:</label>
            <input type="text" id="model" class="form-control" placeholder="Ej. G-Shock" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio:</label>
            <input type="number" id="price" class="form-control" step="0.01" min="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">EAN:</label>
            <input type="text" id="ean" class="form-control" placeholder="Ej. 193456789" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Año de Edición:</label>
            <input type="number" id="year_edition" class="form-control" placeholder="Ej. 2025" required>
        </div>
       
        <div class="text-center">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="/dashboard" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</body>
</html>
