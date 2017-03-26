<?php

namespace JP\Sistema;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public function testeVerificaSeOTipoDaClasseEstaCorreto()
    {
        $this->assertInstanceOf("JP\Sistema\Math", new \JP\Sistema\Math());
    }

    public function testeSomar()
    {
        $m = new \JP\Sistema\Math();
        $resultado = $m->somar(10, 10);
        $this->assertEquals(20, $resultado);

        $resultado = $m->somar(5, 5);
        $this->assertEquals(10, $resultado);
    }
}
