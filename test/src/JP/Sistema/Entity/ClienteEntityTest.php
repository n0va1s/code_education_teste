<?php

namespace JP\Sistema\Entity;

class ClienteEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("JP\Sistema\Entity\ClienteEntity", new \JP\Sistema\Entity\ClienteEntity());
    }

    public function testVerificaGetSet()
    {

        $cliente = $this->getMockBuilder('\JP\Sistema\Entity\ClienteEntity')
                          ->getMock();
        $cliente->method('getNome')
                ->willReturn('João Paulo Cirino Silva de Novais');

        $this->assertEquals('João Paulo Cirino Silva de Novais', $cliente->getNome());

        $cliente->method('getEmail')
                ->willReturn('jp.trabalho@gmail.com');

        $this->assertEquals('jp.trabalho@gmail.com', $cliente->getEmail());
        
        $cliente->method('getDataCriacao')
                ->willReturn(new \DateTime());

        $this->assertEquals(new \DateTime(), $cliente->getDataCriacao());
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaEmailInvalido()
    {
        $cliente = $this->getMockBuilder('\JP\Sistema\Entity\ClienteEntity')
                        ->getMock();
        $cliente->method('setEmail')
                ->will($this->throwException(new \InvalidArgumentException));
        $cliente->setEmail("jp.trabalhogmail.com");
    }
}
