
<!DOCTYPE html>
<html>
<head>
    <title>Principal</title>
    <style>
    body {
        color: /* Color de la fuente */ ;
    }
    </style>
</head>
<body>
    <h1>Bienvenido, <!-- IMPRIME AQUI EL NOMBRE DE LA PERSONA LOGUEADA --></h1>
    <form method="POST">
        <button name="irNotas">Ir a Notas</button>

        <label for="color">Color del tema:</label>
        <select name="color" id="color">
            <option value="black">Negro</option>
            <option value="green">Verde</option>
            <option value="blue">Azul</option>
            <option value="red">Rojo</option>
        </select>

        <button name="colorear">Seleccionar color</button>
        <button name="cerrar_sesion">Cerrar sesión</button>
    </form>
</body>
</html>
