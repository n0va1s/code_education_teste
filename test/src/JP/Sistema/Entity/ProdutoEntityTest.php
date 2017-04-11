<?php

namespace JP\Sistema\Entity;

class ProdutoEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaTipoClasse()
    {
        $this->assertInstanceOf("JP\Sistema\Entity\ProdutoEntity", new \JP\Sistema\Entity\ProdutoEntity());
    }

    public function testVerificaGetSet()
    {
        $produto = new \JP\Sistema\Entity\ProdutoEntity();
        //Nome
        $produto->setNome("Produto 1");
        $this->assertEquals("Produto 1", $produto->getNome());
        //Descricao
        $produto->setDescricao("Descrição do produto 1");
        $this->assertEquals("Descrição do produto 1", $produto->getDescricao());
        //Valor
        $produto->setValor(100.00);
        $this->assertEquals(100.00, $produto->getValor());
        //Categoria
        $produto->setCategoria(1);
        $this->assertEquals(1, $produto->getCategoria());
    }
    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaValorInvalido()
    {
        $produto = new \JP\Sistema\Entity\ProdutoEntity();
        $produto->setValor("ABC");
    }
}
