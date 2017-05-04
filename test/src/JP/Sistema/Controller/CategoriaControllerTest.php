<?php

namespace JP\Sistema\Controller;

use Silex\WebTestCase;

class CategoriaControllerTest extends WebTestCase
{
    private $client;
    private $crawler;

    public function createApplication()
    {
        $app = require __DIR__.'/../../../../app.php';
        $app['session.test'] = true;
        return $app;
    }

    public function testIndexCategoria()
    {
        $this->client = $this->createClient();
        $this->client->request('GET', '/categoria/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Módulo Categoria (API)', $this->client->getResponse()->getContent());
    }

    public function testListarCategoriaJson()
    {
        $this->client = $this->createClient();
        $this->client->request('GET', '/categoria/api/listar/json');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }

    public function testListarCategoriaIdJson()
    {
        $this->client = $this->createClient();
        $this->client->request('GET', '/categoria/api/listar/1');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }

    public function testInserirCategoriaJson()
    {
        $this->client = $this->createClient();
        $this->client->request('POST', '/categoria/api/inserir', array('nomCategoria' => 'Categoria 1'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }

    public function testAtualizarCategoriaJson()
    {
        $this->client = $this->createClient();
        $this->client->request('PUT', '/categoria/api/atualizar/1', array('seqCategoria'=>'1', 'nomCategoria'=>'Categoria Nova'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }

    public function testApagarCategoriaJson()
    {
        $this->client = $this->createClient();
        $this->client->request('DELETE', '/categoria/api/apagar/1', array('seqCategoria'=>'1'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }
}
