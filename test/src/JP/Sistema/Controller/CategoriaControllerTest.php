<?php

namespace JP\Sistema\Controller;

use Silex\WebTestCase;

class CategoriaControllerTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__.'../../../../../bootstrap.php';
    }

    public function indexCategoria()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('p:contains("Módulo Categoria (API)")'));
        $this->assertCount(1, $crawler->filter('form'));
    }
}
