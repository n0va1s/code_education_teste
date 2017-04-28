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
        $app['session.test'] = true;
        return $app;
    }

    public function testIndexCategoria()
    {
        $this->client = static::createClient([], [
            'HTTP_HOST'        => 'localhost',
            'HTTP_SERVER_PORT' => '8888',
        ]);
        //$this->client->followRedirects(true);
        $this->crawler = $this->client->request('GET', '/categoria');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        //$this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json');
        //$this->assertCount(1, $this->crawler->filter('p:contains("Módulo Categoria (API)")'));
    }
}
