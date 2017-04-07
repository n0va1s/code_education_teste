<?php

namespace JP\Sistema;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public function testeVerificaSeOTipoDaClasseEstaCorreto()
    {
        $this->assertInstanceOf("JP\Sistema\Math", new \JP\Sistema\Math());
    }

    public function somaProvider()
    {
        return [
            [2,2,4],
            [5,5,10],
            [12,20,32],
            [50,-100,-50],
            [0,2,2],
        ];
    }

    /**
    * @dataProvider somaProvider
    */
    public function testeSomar($x, $y, $resultado)
    {
        $m = new \JP\Sistema\Math();
        $calculo = $m->somar($x, $y);
        $this->assertEquals($resultado, $calculo);
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testeNumerico()
    {
        $m = new \JP\Sistema\Math();
        $resultado = $m->somar(10, 'ABC');
    }
}
