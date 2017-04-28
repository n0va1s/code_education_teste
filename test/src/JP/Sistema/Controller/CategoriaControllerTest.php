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
        $this->client = static::createClient([], ['HTTP_HOST'=>'localhost:8888']);
        //$this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/categoria');
        //$this->crawler = $this->client->request('GET', 'http://localhost:8888/categoria');
        /*
        if (!$this->client->getResponse()->isOk()) {
            $block = $this->crawler->filter('div.text-exception > h1');
            $error = $block->text();
            var_dump($error);
        }
        */
        //$this->client->followRedirects(true);
        //$this->assertTrue($this->client->getResponse()->isRedirect('/categoria/'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        //$this->assertContains('Módulo Categoria (API)',$this->client->getResponse()->getContent());
        //$this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json');
        //$this->assertCount(1, $this->crawler->filter('p:contains("Módulo Categoria (API)")'));
    }
}
