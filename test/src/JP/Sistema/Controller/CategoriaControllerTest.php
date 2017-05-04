<?php

namespace JP\Sistema\Controller;

use Silex\WebTestCase;

class CategoriaControllerTest extends WebTestCase
{
    private $client;
    private $crawler;
    private $id;

    public function createApplication()
    {
        $app = require __DIR__.'/../../../../app.php';
        $app['session.test'] = true;
        return $app;
    }

    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    public function testIndexCategoria()
    {
        $this->client->request('GET', '/categoria/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Módulo Categoria (API)', $this->client->getResponse()->getContent());
    }

    public function testInserirCategoriaJson()
    {
        $this->client->request('POST', '/categoria/api/inserir', array('nomCategoria' => 'Categoria 1'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertGreaterThan(0, $this->client->getResponse()->getContent());
        $this->id = $this->client->getResponse()->getContent();
    }
/*
    public function testAtualizarCategoriaJson()
    {
        $this->client->request('PUT', '/categoria/api/atualizar/'.$this->id, array('seqCategoria'=>$this->id, 'nomCategoria'=>'Categoria Nova'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertGreaterThan($this->id, $this->client->getResponse()->getContent());
    }
*/
    public function testListarCategoriaJson()
    {
        $this->client->request('GET', '/categoria/api/listar/json');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $c = count(json_decode($this->client->getResponse()->getContent(), true));
        $this->assertGreaterThan(0, $c);
        $this->assertArrayHasKey('id', json_decode($this->client->getResponse()->getContent(), true)[$c-1]);
    }
/*
    public function testListarCategoriaIdJson()
    {
        $this->client->request('GET', '/categoria/api/listar/'$this-id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $c = count(json_decode($this->client->getResponse()->getContent(), true));
        $this->assertEquals(1, $c);
        $this->assertArrayHasKey('id', json_decode($this->client->getResponse()->getContent(), true)[0]);
    }

    public function testApagarCategoriaJson()
    {
        $this->client->request('DELETE', '/categoria/api/apagar/'.$this->id, array('seqCategoria'=>$this->id));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertTrue($this->client->getResponse()->getContent());
    }
*/
    public function tearDown()
    {
        unset($this->client);
        unset($this->id);
    }
}
