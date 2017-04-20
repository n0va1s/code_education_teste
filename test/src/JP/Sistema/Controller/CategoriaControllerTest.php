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
         $app['debug'] = true;
         unset($app['exception_handler']);
         return $app;
    }

    public function setUp()
    {
        parent::setUp();
        $app['session.test'] = true;
        //$this->headers = array('CONTENT_TYPE' => 'application/json',);
        $this->client = self::createClient();
        //$this->client = self::createClient(array('SERVER_NAME'=>'127.0.0.1', 'SERVER_PORT'=>'8888'));
        //var_dump($this->client);
    }

    public function testIndexCategoria()
    {
        $this->crawler = $this->client->request('GET', 'Categoria');
        $this->assertTrue($this->client->getResponse()->isOk());
        //$this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json');
        //$this->assertCount(1, $this->crawler->filter('p:contains("Módulo Categoria (API)")'));
    }
}
