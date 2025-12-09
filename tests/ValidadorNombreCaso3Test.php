<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../ValidadorNombre.php';

class ValidadorNombreCaso3Test extends TestCase
{
    private ValidadorNombre $validador;

    protected function setUp(): void
    {
        // configuración base para las pruebas
        $this->validador = new ValidadorNombre([
            'min_length' => 3,
            'max_length' => 20,
            'allow_hyphen' => true,
            'allow_unicode' => false,
            'max_digits' => 4,
            'max_repeated_chars' => 3,
            'banned' => ['root', 'admin', 'test'],
            'no_start_with_digit' => true,
            'no_end_with_separator' => true,
        ]);
    }

    /** -----------------------------------------
     *  PRUEBAS DE LONGITUD
     * ----------------------------------------- */

    public function testNombreMuyCorto()
    {
        $errores = $this->validador->validarConErrores("ab");
        $this->assertContains("El nombre debe tener al menos 3 caracteres.", $errores);
    }

    public function testNombreMuyLargo()
    {
        $errores = $this->validador->validarConErrores("abcdefghijklmnopqrstu");
        $this->assertContains("El nombre no puede tener más de 20 caracteres.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBAS DE CARACTERES PERMITIDOS
     * ----------------------------------------- */

    public function testNombreConEspacios()
    {
        $errores = $this->validador->validarConErrores("juan perez");
        $this->assertContains("El nombre no puede contener espacios.", $errores);
    }

    public function testCaracteresInvalidos()
    {
        $errores = $this->validador->validarConErrores("juan$%");
        $this->assertContains(
            "El nombre contiene caracteres inválidos. Solo se permiten letras, números y los separadores configurados.",
            $errores
        );
    }

    /** -----------------------------------------
     *  PRUEBA: NO INICIAR CON NÚMERO
     * ----------------------------------------- */

    public function testNoDebeIniciarConNumero()
    {
        $errores = $this->validador->validarConErrores("1juan");
        $this->assertContains("El nombre no puede comenzar con un número.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBA: NO TERMINAR CON SEPARADOR
     * ----------------------------------------- */

    public function testNoDebeTerminarConSeparador()
    {
        $errores = $this->validador->validarConErrores("juan_");
        $this->assertContains("El nombre no puede terminar con un carácter separador.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBA: NO SEPARADORES CONSECUTIVOS
     * ----------------------------------------- */

    public function testSeparadoresConsecutivos()
    {
        $errores = $this->validador->validarConErrores("juan__perez");
        $this->assertContains("El nombre no puede contener '__' consecutivos.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBA: LIMITE DE DIGITOS
     * ----------------------------------------- */

    public function testExcesoDeDigitos()
    {
        $errores = $this->validador->validarConErrores("user12345");
        $this->assertContains("El nombre no puede contener más de 4 dígitos.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBA: CARACTERES REPETIDOS
     * ----------------------------------------- */

    public function testCaracteresRepetidos()
    {
        $errores = $this->validador->validarConErrores("jaaaan");
        $this->assertContains("El nombre no puede contener el mismo carácter repetido más de 3 veces seguidas.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBA: PALABRAS PROHIBIDAS
     * ----------------------------------------- */

    public function testPalabrasProhibidas()
    {
        $errores = $this->validador->validarConErrores("myadminuser");
        $this->assertContains("El nombre contiene una palabra prohibida: 'admin'.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBA: UNICIDAD (Callback)
     * ----------------------------------------- */

    public function testNombreNoDisponible()
    {
        $validador = new ValidadorNombre([
            'uniqueness_callback' => function($nombre) {
                return false; // simula que el nombre ya existe
            }
        ]);

        $errores = $validador->validarConErrores("usuario");
        $this->assertContains("El nombre ya está en uso.", $errores);
    }

    /** -----------------------------------------
     *  PRUEBA DE NOMBRE VÁLIDO
     * ----------------------------------------- */

    public function testNombreValido()
    {
        $this->assertTrue($this->validador->validar("juan_perez123"));
    }
}
