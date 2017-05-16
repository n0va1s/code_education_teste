<?php

namespace JP\Sistema;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaSeOTipoDaClasseEstaCorreto()
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
    public function testSomar($x, $y, $resultado)
    {
        $m = new \JP\Sistema\Math();
        $calculo = $m->somar($x, $y);
        $this->assertEquals($resultado, $calculo);
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testSomarNumerico()
    {
        $m = new \JP\Sistema\Math();
        $resultado = $m->somar(10, 'ABC');
    }

    public function romanoProvider()
    {
        return [
            ['I', 1],
            ['IV', 4],
            ['V', 5],
            ['VII', 7],
            ['X', 10],
            ['L', 50],
            ['C', 100],
            ['DC', 600],
            ['M', 1000]
        ];
    }

    /**
    * @dataProvider romanoProvider
    */
    public function testArabicoParaRomano($romano, $arabico)
    {
        $m = new \JP\Sistema\Math();
        $resultado = $m->converterRomano($arabico);
        $this->assertEquals($romano, $resultado);
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testArabicoNumerico()
    {
        $m = new \JP\Sistema\Math();
        $resultado = $m->converterRomano('ABC');
    }
}
