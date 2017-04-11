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
        $cliente = new \JP\Sistema\Entity\ClienteEntity();
        //Nome
        $cliente->setNome("João Paulo Cirino Silva de Novais");
        $this->assertEquals("João Paulo Cirino Silva de Novais", $cliente->getNome());
        //Email
        $cliente->setEmail("jp.trabalho@gmail.com");
        $this->assertEquals("jp.trabalho@gmail.com", $cliente->getEmail());
        //Foto
        // $foto =  new Symfony\Component\HttpFoundation\File\UploadedFile();
        // $cliente->setFoto($foto);
        // $this->assertInstanceOf("Symfony\Component\HttpFoundation\File\UploadedFile", $cliente->getFoto());
        //DataCriacao
        $cliente->setDataCriacao();
        $this->assertEquals(new \DateTime(), $cliente->getDataCriacao());
    }

    /**
    * @expectedException InvalidArgumentException
    */
    public function testVerificaEmailInvalido()
    {
        $cliente = new \JP\Sistema\Entity\ClienteEntity();
        $cliente->setEmail("jp.trabalhogmail.com");
    }
}
