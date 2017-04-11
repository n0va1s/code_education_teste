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
        $categoria = new \JP\Sistema\Entity\CategoriaEntity();
        //Descricao
        $categoria->setDescricao("Descrição do produto 1");
        $this->assertEquals("Descrição do produto 1", $categoria->getDescricao());
    }
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaDescricaoObrigatoria()
    {
        $produto = new \JP\Sistema\Entity\CategoriaEntity();
        $produto->setDescricao(null);
    }
}
