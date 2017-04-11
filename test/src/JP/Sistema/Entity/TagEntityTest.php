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
        $tag = new \JP\Sistema\Entity\TagEntity();
        //Descricao
        $tag->setDescricao("Descrição do produto 1");
        $this->assertEquals("Descrição do produto 1", $tag->getDescricao());
    }
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaDescricaoObrigatoria()
    {
        $produto = new \JP\Sistema\Entity\TagEntity();
        $produto->setDescricao(null);
    }
}
