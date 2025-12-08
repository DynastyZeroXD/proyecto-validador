<?php
namespace App;

// src/Validador.php

class Validador
{
    /**
     * CASO DE USO 1: Validar Contraseña (Usa 4-5 escenarios de prueba).
     * Reglas: Mín. 8 caracteres, al menos 1 número, al menos 1 mayúscula.
     * @param string $password
     * @return bool
     */
    public function validarContrasena(string $password): bool
    {
        // 1. Longitud mínima de 8
        if (strlen($password) < 8) {
            return false;
        }
        // 2. Contiene al menos un número
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }
        // 3. Contiene al menos una mayúscula
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }
        return true;
    }

    /**
     * CASO DE USO 2: Validar Correo Electrónico (Usa 2-3 escenarios de prueba).
     * Regla: Debe tener un formato de email válido.
     * @param string $email
     * @return bool
     */
    public function validarEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * CASO DE USO 3: Validar Nombre de Usuario (Usa 2-3 escenarios de prueba).
     * Reglas: Mín. 5 caracteres, Máx. 15, solo letras y números.
     * @param string $username
     * @return bool
     */
    public function validarUsername(string $username): bool
    {
        // 1. Longitud (5 a 15 caracteres)
        $len = strlen($username);
        if ($len < 5 || $len > 15) {
            return false;
        }
        // 2. Solo letras (a-z, A-Z) y números (0-9)
        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return false;
        }
        return true;
    }
}