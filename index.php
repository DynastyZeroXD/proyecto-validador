<?php
// index.php

// Inclusión del Autocargador (Debe ser la primera línea ejecutada)
require_once __DIR__ . '/vendor/autoload.php';
use App\Validador; 

$resultados = [
    'contrasena' => '', 
    'email' => '', 
    'username' => ''
];
$inputs = [
    'password' => '', 
    'email' => '', 
    'username' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validador = new Validador();

    // 1. Obtener y sanear todos los inputs
    // --- CORRECCIÓN CLAVE: Se añade '?? '' ' para convertir cualquier NULL a cadena vacía. ---
    $inputs['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $inputs['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
    $inputs['username'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    // -----------------------------------------------------------------------------------------

    // 2. Procesar Caso de Uso 1: Contraseña
    $esValida = $validador->validarContrasena($inputs['password']);
    $claseC = $esValida ? 'success' : 'error';
    $textoC = $esValida 
        ? '✅ Contraseña Válida' 
        : '❌ Inválida (Mín. 8, Mayús, Número)';
    $resultados['contrasena'] = "<div class='result $claseC'>$textoC</div>";

    // 3. Procesar Caso de Uso 2: Email
    $esEmailValido = $validador->validarEmail($inputs['email']);
    $claseE = $esEmailValido ? 'success' : 'error';
    $textoE = $esEmailValido ? '✅ Email Válido' : '❌ Formato de Email Inválido';
    $resultados['email'] = "<div class='result $claseE'>$textoE</div>";

    // 4. Procesar Caso de Uso 3: Nombre de Usuario
    $esUsernameValido = $validador->validarUsername($inputs['username']);
    $claseU = $esUsernameValido ? 'success' : 'error';
    $textoU = $esUsernameValido 
        ? '✅ Usuario Válido' 
        : '❌ Inválido (5-15, solo letras y números)';
    $resultados['username'] = "<div class='result $claseU'>$textoU</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto Semestral: Validador (3 C.U.)</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .container { background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 450px; }
        h1 { color: #333; text-align: center; margin-bottom: 25px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #28a745; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; transition: background-color 0.3s; }
        button:hover { background-color: #218838; }
        .result { padding: 10px; margin-top: 15px; border-radius: 4px; font-weight: bold; text-align: center; border: 1px solid; }
        .success { background-color: #d4edda; color: #155724; border-color: #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔑 Validador de Registro (3 C.U.)</h1>
        
        <form method="POST">
            <label for="password">Contraseña (C.U. 1):</label>
            <input type="password" id="password" name="password" 
                   value="<?php echo htmlspecialchars($inputs['password']); ?>" required>
            <?php echo $resultados['contrasena']; ?>

            <label for="email">Correo Electrónico (C.U. 2):</label>
            <input type="email" id="email" name="email" 
                   value="<?php echo htmlspecialchars($inputs['email']); ?>" required>
            <?php echo $resultados['email']; ?>

            <label for="username">Nombre de Usuario (C.U. 3):</label>
            <input type="text" id="username" name="username" 
                   value="<?php echo htmlspecialchars($inputs['username']); ?>" required>
            <?php echo $resultados['username']; ?>
            
            <button type="submit">Validar Todo</button>
        </form>

    </div>
</body>
</html>