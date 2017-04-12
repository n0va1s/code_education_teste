<?php

namespace JP\Sistema\Entity;

class TagEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("JP\Sistema\Entity\TagEntity", new \JP\Sistema\Entity\TagEntity());
    }

    public function testVerificaGetSet()
    {
        $tag = $this->getMockBuilder('\JP\Sistema\Entity\TagEntity')
                    ->getMock();
        $tag->method('getDescricao')
            ->willReturn('Descrição da tag 1');
        $this->assertEquals("Descrição da tag 1", $tag->getDescricao());
    }
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaDescricaoObrigatoria()
    {
        $tag = $this->getMockBuilder('\JP\Sistema\Entity\TagEntity')
                    ->getMock();
        $tag->method('setDescricao')
            ->will($this->throwException(new \InvalidArgumentException));

        $tag->setDescricao(null);
    }
}
