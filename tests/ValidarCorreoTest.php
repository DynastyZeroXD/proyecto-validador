<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Validador;

class ValidarCorreoTest extends TestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = new Validador();
    }

    // Método helper
    private function assertCorreo(string $email, bool $expected, string $testNum): void
    {
        $this->assertEquals(
            $expected,
            $this->validator->validarEmail($email),
            "Test {$testNum} falló para: {$email}"
        );
    }

    // 60 correos válidos según validación estricta
    public function testCorreo01() { $this->assertCorreo('persona@mail.com', true, '01'); }
    public function testCorreo02() { $this->assertCorreo('contacto.emp@empresa.org', true, '02'); }
    public function testCorreo03() { $this->assertCorreo('alpha.beta@dominio.net', true, '03'); }
    public function testCorreo04() { $this->assertCorreo('user123@site.io', true, '04'); }
    public function testCorreo05() { $this->assertCorreo('correo.valido@academia.edu', true, '05'); }
    public function testCorreo06() { $this->assertCorreo('normal_123@info.tech', true, '06'); }
    public function testCorreo07() { $this->assertCorreo('soporte@empresa.lat', true, '07'); }
    public function testCorreo08() { $this->assertCorreo('app.mail@service.ai', true, '08'); }
    public function testCorreo09() { $this->assertCorreo('client.service@banco.org', true, '09'); }
    public function testCorreo10() { $this->assertCorreo('ventas@online.store', true, '10'); }
    public function testCorreo11() { $this->assertCorreo('productos@market.shop', true, '11'); }
    public function testCorreo12() { $this->assertCorreo('beta_user@cloud.dev', true, '12'); }
    public function testCorreo13() { $this->assertCorreo('team.support@system.gov', true, '13'); }
    public function testCorreo14() { $this->assertCorreo('live.support@hosting.net', true, '14'); }
    public function testCorreo15() { $this->assertCorreo('correo_simple@node.app', true, '15'); }
    public function testCorreo16() { $this->assertCorreo('user.name+tag@gmail.com', true, '16'); }
    public function testCorreo17() { $this->assertCorreo('my_mail123@yahoo.co.uk', true, '17'); }
    public function testCorreo18() { $this->assertCorreo('contact@sub.domain.com', true, '18'); }
    public function testCorreo19() { $this->assertCorreo('info@company.io', true, '19'); }
    public function testCorreo20() { $this->assertCorreo('nombre.apellido@correo.com', true, '20'); }
    public function testCorreo21() { $this->assertCorreo('email_user@domain.org', true, '21'); }
    public function testCorreo22() { $this->assertCorreo('support@website.net', true, '22'); }
    public function testCorreo23() { $this->assertCorreo('hello.world@service.ai', true, '23'); }
    public function testCorreo24() { $this->assertCorreo('first.last@provider.edu', true, '24'); }
    public function testCorreo25() { $this->assertCorreo('my.account@company.co', true, '25'); }
    public function testCorreo26() { $this->assertCorreo('user_test@domain.info', true, '26'); }
    public function testCorreo27() { $this->assertCorreo('contact123@site.biz', true, '27'); }
    public function testCorreo28() { $this->assertCorreo('name_surname@school.edu', true, '28'); }
    public function testCorreo29() { $this->assertCorreo('team_lead@startup.io', true, '29'); }
    public function testCorreo30() { $this->assertCorreo('marketing@company.store', true, '30'); }
    public function testCorreo31() { $this->assertCorreo('valid.user@domain.com', true, '31'); }
    public function testCorreo32() { $this->assertCorreo('user.name@sub.domain.org', true, '32'); }
    public function testCorreo33() { $this->assertCorreo('contact.mail@provider.net', true, '33'); }
    public function testCorreo34() { $this->assertCorreo('first.last@company.co', true, '34'); }
    public function testCorreo35() { $this->assertCorreo('my_email@domain.io', true, '35'); }
    public function testCorreo36() { $this->assertCorreo('user_test@service.app', true, '36'); }
    public function testCorreo37() { $this->assertCorreo('support.team@startup.biz', true, '37'); }
    public function testCorreo38() { $this->assertCorreo('hello_user@company.edu', true, '38'); }
    public function testCorreo39() { $this->assertCorreo('name.surname@domain.tech', true, '39'); }
    public function testCorreo40() { $this->assertCorreo('email123@provider.info', true, '40'); }
    public function testCorreo41() { $this->assertCorreo('contact_user@subdomain.net', true, '41'); }
    public function testCorreo42() { $this->assertCorreo('first_last@company.org', true, '42'); }
    public function testCorreo43() { $this->assertCorreo('hello.world@service.io', true, '43'); }
    public function testCorreo44() { $this->assertCorreo('team.member@startup.co', true, '44'); }
    public function testCorreo45() { $this->assertCorreo('user.name@company.app', true, '45'); }
    public function testCorreo46() { $this->assertCorreo('contact@domain.biz', true, '46'); }
    public function testCorreo47() { $this->assertCorreo('my.user@provider.edu', true, '47'); }
    public function testCorreo48() { $this->assertCorreo('alpha.beta@company.io', true, '48'); }
    public function testCorreo49() { $this->assertCorreo('team_lead@service.net', true, '49'); }
    public function testCorreo50() { $this->assertCorreo('user_test@domain.org', true, '50'); }
    public function testCorreo51() { $this->assertCorreo('support_user@company.com', true, '51'); }
    public function testCorreo52() { $this->assertCorreo('first.last@provider.biz', true, '52'); }
    public function testCorreo53() { $this->assertCorreo('contact.email@domain.io', true, '53'); }
    public function testCorreo54() { $this->assertCorreo('user_name@company.co', true, '54'); }
    public function testCorreo55() { $this->assertCorreo('hello.world@service.org', true, '55'); }
    public function testCorreo56() { $this->assertCorreo('team.member@domain.app', true, '56'); }
    public function testCorreo57() { $this->assertCorreo('user123@provider.net', true, '57'); }
    public function testCorreo58() { $this->assertCorreo('name.surname@company.edu', true, '58'); }
    public function testCorreo59() { $this->assertCorreo('contact_user@service.tech', true, '59'); }
    public function testCorreo60() { $this->assertCorreo('first.last@startup.info', true, '60'); }
}
