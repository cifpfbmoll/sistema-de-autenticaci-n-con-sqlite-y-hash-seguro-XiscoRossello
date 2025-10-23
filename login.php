
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <style>
        body { background: #f4f6fb; font-family: 'Segoe UI', Arial, sans-serif; }
        .container { max-width: 400px; margin: 60px auto; background: #fff; padding: 32px 28px; border-radius: 10px; box-shadow: 0 4px 16px #d1d9e6; }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 24px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; color: #34495e; font-weight: 500; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #bfc9d4; border-radius: 6px; font-size: 16px; }
        button { width: 100%; padding: 12px; background: #007bff; color: #fff; border: none; border-radius: 6px; font-size: 17px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        button:hover { background: #0056b3; }
        .msg { text-align: center; margin-bottom: 18px; font-size: 15px; color: #27ae60; }
        .error { color: #e74c3c; }
        .back { text-align: center; margin-top: 18px; }
        .back a { color: #007bff; text-decoration: none; font-weight: 500; }
        .back a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inicio de sesión</h2>
        <?php
        include('conexion.php');
        $msg = "";
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario = $_POST["usuario"];
            $clave = $_POST["clave"];
            $db = conectar();
            $stmt = $db->prepare("SELECT password FROM usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify($clave, $row["password"])) {
                $msg = '<span class="msg">Inicio de sesión correcto.</span>';
            } else {
                $msg = '<span class="msg error">Usuario o contraseña incorrectos.</span>';
            }
        }
        echo $msg;
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave" required>
            </div>
            <button type="submit">Ingresar</button>
        </form>
        <div class="back">
            <a href="index.php">Volver al inicio</a>
        </div>
    </div>
</body>
</html>