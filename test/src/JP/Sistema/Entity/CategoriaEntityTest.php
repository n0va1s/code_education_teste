<?php

namespace JP\Sistema\Entity;

class CategoriaEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("JP\Sistema\Entity\CategoriaEntity", new \JP\Sistema\Entity\CategoriaEntity());
    }

    public function testVerificaGetSet()
    {
        $categoria = $this->getMockBuilder('\JP\Sistema\Entity\CategoriaEntity')
                          ->getMock();
        $categoria->method('getDescricao')
                  ->willReturn('Descrição do produto 1');

        $this->assertEquals('Descrição do produto 1', $categoria->getDescricao());
    }
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaDescricaoObrigatoria()
    {
        $categoria = $this->getMockBuilder('\JP\Sistema\Entity\CategoriaEntity')
                        ->getMock();
        $categoria->method('setDescricao')
                  ->will($this->throwException(new \InvalidArgumentException));

        $categoria->setDescricao(null);
    }
}
