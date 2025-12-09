<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Validador; // Importa la clase del Sistema Bajo Prueba (SUT)

/**
 * Clase de Pruebas para el Caso de Uso 1: Validar Contraseña
 * Contiene 10 escenarios de prueba unitaria.
 */
class ValidadorTest extends TestCase
{
    private Validador $validador;

    // Método que se ejecuta antes de cada prueba (Configuración - Arrange)
    protected function setUp(): void
    {
        $this->validador = new Validador();
    }
    
    // =========================================================================
    // ESCENARIOS DE ÉXITO (APROBADO)
    // =========================================================================

    /**
     * CU1-01: Caso Base - Funcionalidad principal.
     */
    public function testContrasenaCumpleTodosRequisitos()
    {
        // Dato de Prueba: ContrasenaSegura1
        $contrasena = "ContrasenaSegura1"; 
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarContrasena($contrasena), 
            "CU1-01 Falló: La contraseña DEBERÍA ser válida al cumplir todas las reglas."
        );
    }

    /**
     * CU1-02: Valor Límite - Longitud (Límite Mínimo exacto: 8 caracteres).
     */
    public function testContrasenaPasaEnLimiteMinimo()
    {
        // Dato de Prueba: LargoA12
        $contrasena = "LargoA12"; 
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarContrasena($contrasena), 
            "CU1-02 Falló: La contraseña de 8 caracteres DEBERÍA ser válida."
        );
    }

    /**
     * CU1-08: Caso Especial - Contiene Símbolos.
     */
    public function testContrasenaAceptaSimbolosSiCumpleReglas()
    {
        // Dato de Prueba: Contra@123_
        $contrasena = "Contra@123_"; 
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarContrasena($contrasena), 
            "CU1-08 Falló: La contraseña con símbolos DEBERÍA ser válida."
        );
    }

    /**
     * CU1-09: Combinación - Mínimo absoluto (8 caracteres con 1 mayúscula y 1 número).
     */
    public function testContrasenaPasaConRequisitosMinimos()
    {
        // Dato de Prueba: A1234567
        $contrasena = "A1234567"; 
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarContrasena($contrasena), 
            "CU1-09 Falló: La contraseña más corta y con reglas DEBERÍA ser válida."
        );
    }

    /**
     * CU1-10: Valor Límite - Longitud (Límite Superior: muy larga).
     */
    public function testContrasenaPasaConLongitudLarga()
    {
        // Dato de Prueba: 21 caracteres, cumple reglas.
        $contrasena = "A12345678901234567890"; 
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarContrasena($contrasena), 
            "CU1-10 Falló: La contraseña larga DEBERÍA ser válida."
        );
    }

    // =========================================================================
    // ESCENARIOS DE FRACASO (NO APROBADO)
    // =========================================================================

    /**
     * CU1-03: Valor Límite - Longitud (Justo debajo del límite: 7 caracteres).
     */
    public function testContrasenaFallaPorLongitudCorta()
    {
        // Dato de Prueba: CortA1
        $contrasena = "CortA1"; 
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarContrasena($contrasena), 
            "CU1-03 Falló: La contraseña de 7 caracteres DEBERÍA ser inválida."
        );
    }

    /**
     * CU1-04: Combinación - Falla por falta de Mayúscula.
     */
    public function testContrasenaFallaPorFaltaDeMayuscula()
    {
        // Dato de Prueba: sinmayuscula123
        $contrasena = "sinmayuscula123"; 
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarContrasena($contrasena), 
            "CU1-04 Falló: La contraseña sin mayúscula DEBERÍA ser inválida."
        );
    }

    /**
     * CU1-05: Combinación - Falla por falta de Número.
     */
    public function testContrasenaFallaPorFaltaDeNumero()
    {
        // Dato de Prueba: ContrasenaLarga
        $contrasena = "ContrasenaLarga"; 
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarContrasena($contrasena), 
            "CU1-05 Falló: La contraseña sin número DEBERÍA ser inválida."
        );
    }

    /**
     * CU1-06: Combinación - Falla Longitud y Mayúscula.
     */
    public function testContrasenaFallaPorMultiplesReglas()
    {
        // Dato de Prueba: corta1
        $contrasena = "corta1"; 
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarContrasena($contrasena), 
            "CU1-06 Falló: La contraseña que falla múltiples reglas DEBERÍA ser inválida."
        );
    }

    /**
     * CU1-07: Caso Negativo - Cadena Vacía / Nulo.
     */
    public function testContrasenaFallaConCadenaVacia()
    {
        // Dato de Prueba: ""
        $contrasena = ""; 
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarContrasena($contrasena), 
            "CU1-07 Falló: La cadena vacía DEBERÍA ser inválida."
        );
    }
}