<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reloj</title>
    <script>
        async function createWatch(event) {
            event.preventDefault();
            const brand = document.getElementById("brand").value;
            const model = document.getElementById("model").value;
            const price = document.getElementById("price").value;

            const response = await fetch("/api/watches", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ brand, model, price })
            });

            if (response.ok) {
                alert("Reloj agregado");
                window.location.href = "/watches";
            } else {
                alert("Error al agregar reloj");
            }
        }
    </script>
</head>
<body>
    <h2>Agregar Reloj</h2>
    <form onsubmit="createWatch(event)">
        <label>Marca:</label>
        <input type="text" id="brand" required><br>
        <label>Modelo:</label>
        <input type="text" id="model" required><br>
        <label>Precio:</label>
        <input type="number" id="price" required><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
