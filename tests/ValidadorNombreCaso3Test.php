<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Validador;

class ValidadorNombreCaso3Test extends TestCase
{
    private Validador $validador;

    protected function setUp(): void
    {
        $this->validador = new Validador();
    }

    // =========================================================================
    // ESCENARIOS DE ÉXITO (APROBADO)
    // =========================================================================

    /**
     * CU3-01: Caso Base - Funcionalidad principal.
     * Nombre válido que cumple todas las reglas.
     */
    public function testNombreCumpleTodosRequisitos()
    {
        // Dato de Prueba: juan123 (5-15 caracteres, solo letras y números)
        $username = "juan123";
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarUsername($username), 
            "CU3-01 Falló: El nombre DEBERÍA ser válido al cumplir todas las reglas."
        );
    }

    /**
     * CU3-02: Valor Límite - Longitud mínima exacta (5 caracteres).
     */
    public function testNombrePasaEnLimiteMinimo()
    {
        // Dato de Prueba: abcde (exactamente 5 caracteres)
        $username = "abcde";
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarUsername($username), 
            "CU3-02 Falló: El nombre de 5 caracteres DEBERÍA ser válido."
        );
    }

    /**
     * CU3-03: Valor Límite - Longitud máxima exacta (15 caracteres).
     */
    public function testNombrePasaEnLimiteMaximo()
    {
        // Dato de Prueba: abcdefghijklmno (exactamente 15 caracteres)
        $username = "abcdefghijklmno";
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarUsername($username), 
            "CU3-03 Falló: El nombre de 15 caracteres DEBERÍA ser válido."
        );
    }

    /**
     * CU3-04: Caso Especial - Solo letras.
     */
    public function testNombreSoloLetras()
    {
        // Dato de Prueba: usuario (solo letras, dentro del rango)
        $username = "usuario";
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarUsername($username), 
            "CU3-04 Falló: El nombre con solo letras DEBERÍA ser válido."
        );
    }

    /**
     * CU3-05: Caso Especial - Solo números (dentro del rango permitido).
     */
    public function testNombreSoloNumeros()
    {
        // Dato de Prueba: 12345 (exactamente 5 caracteres, solo números)
        $username = "12345";
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarUsername($username), 
            "CU3-05 Falló: El nombre con solo números DEBERÍA ser válido (si cumple longitud)."
        );
    }

    /**
     * CU3-06: Caso Especial - Mezcla de mayúsculas y minúsculas.
     */
    public function testNombreConMayusculasMinusculas()
    {
        // Dato de Prueba: Usuario123
        $username = "Usuario123";
        
        // Resultado Esperado: APROBADO
        $this->assertTrue(
            $this->validador->validarUsername($username), 
            "CU3-06 Falló: El nombre con mayúsculas y minúsculas DEBERÍA ser válido."
        );
    }

    // =========================================================================
    // ESCENARIOS DE FRACASO (NO APROBADO)
    // =========================================================================

    /**
     * CU3-07: Valor Límite - Longitud (Justo debajo del límite: 4 caracteres).
     */
    public function testNombreFallaPorLongitudCorta()
    {
        // Dato de Prueba: abcd (4 caracteres)
        $username = "abcd";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-07 Falló: El nombre de 4 caracteres DEBERÍA ser inválido."
        );
    }

    /**
     * CU3-08: Valor Límite - Longitud (Justo encima del límite: 16 caracteres).
     */
    public function testNombreFallaPorLongitudLarga()
    {
        // Dato de Prueba: abcdefghijklmnop (16 caracteres)
        $username = "abcdefghijklmnop";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-08 Falló: El nombre de 16 caracteres DEBERÍA ser inválido."
        );
    }

    /**
     * CU3-09: Caracteres Inválidos - Guión bajo.
     */
    public function testNombreFallaPorCaracteresInvalidosGuion()
    {
        // Dato de Prueba: juan_perez (contiene guión bajo)
        $username = "juan_perez";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-09 Falló: El nombre con guión bajo DEBERÍA ser inválido."
        );
    }

    /**
     * CU3-10: Caracteres Inválidos - Espacios.
     */
    public function testNombreFallaPorCaracteresInvalidosEspacio()
    {
        // Dato de Prueba: juan perez (contiene espacio)
        $username = "juan perez";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-10 Falló: El nombre con espacios DEBERÍA ser inválido."
        );
    }

    /**
     * CU3-11: Caracteres Inválidos - Símbolos especiales.
     */
    public function testNombreFallaPorCaracteresInvalidosSimbolos()
    {
        // Dato de Prueba: juan@correo (contiene @)
        $username = "juan@correo";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-11 Falló: El nombre con símbolos especiales DEBERÍA ser inválido."
        );
    }

    /**
     * CU3-12: Caracteres Inválidos - Carácter Unicode.
     */
    public function testNombreFallaPorCaracteresInvalidosUnicode()
    {
        // Dato de Prueba: juán123 (contiene acento)
        $username = "juán123";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-12 Falló: El nombre con caracteres Unicode DEBERÍA ser inválido."
        );
    }

    /**
     * CU3-13: Caso Negativo - Cadena Vacía.
     */
    public function testNombreFallaConCadenaVacia()
    {
        // Dato de Prueba: ""
        $username = "";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-13 Falló: La cadena vacía DEBERÍA ser inválida."
        );
    }

    /**
     * CU3-14: Caso Especial - Solo un carácter.
     */
    public function testNombreFallaConUnSoloCaracter()
    {
        // Dato de Prueba: a
        $username = "a";
        
        // Resultado Esperado: NO APROBADO
        $this->assertFalse(
            $this->validador->validarUsername($username), 
            "CU3-14 Falló: El nombre con un solo carácter DEBERÍA ser inválido."
        );
    }
}
