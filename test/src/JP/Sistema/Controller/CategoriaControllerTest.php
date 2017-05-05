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
        return $this->client->getResponse()->getContent();
    }
    /**
     * @depends testInserirCategoriaJson
     */
    public function testAtualizarCategoriaJson(string $id)
    {
        $this->client->request('PUT', '/categoria/api/atualizar/'.$id, array('seqCategoria'=>$id, 'nomCategoria'=>'Categoria Nova'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertGreaterThanOrEqual($id, $this->client->getResponse()->getContent());
    }
    /**
     * @depends testInserirCategoriaJson
     */
    public function testListarCategoriaIdJson(string $id)
    {
        $this->client->request('GET', '/categoria/api/listar/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $c = count(json_decode($this->client->getResponse()->getContent(), true));
        $this->assertEquals(1, $c);
        $this->assertArrayHasKey('id', json_decode($this->client->getResponse()->getContent(), true)[0]);
    }
    /**
     * @depends testInserirCategoriaJson
     */
    public function testApagarCategoriaJson(string $id)
    {
        $this->client->request('DELETE', '/categoria/api/apagar/'.$id, array('seqCategoria'=>$id));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function testListarCategoriaJson()
    {
        $this->client->request('GET', '/categoria/api/listar/json');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $c = count(json_decode($this->client->getResponse()->getContent(), true));
        $this->assertGreaterThan(0, $c);
        $this->assertArrayHasKey('id', json_decode($this->client->getResponse()->getContent(), true)[$c-1]);
    }

    public function tearDown()
    {
        unset($this->client);
    }
}
