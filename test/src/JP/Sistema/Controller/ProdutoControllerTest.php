<?php

namespace JP\Sistema\Controller;

use Silex\WebTestCase;

class ProdutoControllerTest extends WebTestCase
{
    private $client;
    
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

    public function testIndexProdutoAPP()
    {
        $this->client->request('GET', '/produto/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Módulo Produto (API)', $this->client->getResponse()->getContent());
    }

    public function testIncluirProdutoAPP()
    {
        $this->client->request('GET', '/produto/incluir');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Informe', $this->client->getResponse()->getContent());
    }

    public function testGravarProdutoAPP()
    {
        $this->client->request('POST', '/produto/gravar', array('nomProduto'=>'Nome do Produto 1',
            'desProduto'=>'Descrição do Produto 1',
            'valProduto'=>'100',
            'seqCategoria'=>'56',
            'seqTag'=>'18'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $dados['id']);
        return $dados['id'];
    }
    /**
     * @depends testGravarProdutoAPP
     */
    public function testAlterarProdutoAPP(int $id)
    {
        $this->client->request('GET', '/produto/alterar/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        //O valor nao e alterado ainda, apenas monstrado na tela para alteracao
        $this->assertContains('Descrição do Produto 1', $dados['descricao']);
        $this->assertArrayHasKey('id', $dados);
    }
    /**
     * @depends testGravarProdutoAPP
     */
    public function testExcluirProdutoAPP(int $id)
    {
        $this->client->request('GET', '/produto/excluir/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function testListarProdutoAPP()
    {
        $this->client->request('GET', '/produto/listar/html');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertContains('Novo produto (+)', $this->client->getResponse()->getContent());
    }

    public function testInserirProdutoAPI()
    {
        $this->client->request('POST', '/produto/api/inserir', array('nomProduto'=>'Nome do Produto 1',
            'desProduto'=>'Descrição do Produto 1',
            'valProduto'=>'100'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertGreaterThan(0, $dados['id']);
        return $dados['id'];
    }
    /**
     * @depends testInserirProdutoAPI
     */
    public function testAtualizarProdutoAPI(int $id)
    {
        $this->client->request('PUT', '/produto/api/atualizar/'.$id, array('nomProduto'=>'Nome do Produto 1',
            'desProduto'=>'Descrição do Produto 1',
            'valProduto'=>'100'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1, count($dados['id']));
        $this->assertContains('Descrição do Produto 1', $dados['descricao']);
    }
    /**
     * @depends testInserirProdutoAPI
     */
    public function testListarProdutoIdAPI(int $id)
    {
        $this->client->request('GET', '/produto/api/listar/'.$id);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $dados = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(4, count($dados)); //retornam 4 campos no array
        $this->assertArrayHasKey('id', $dados);
        $this->assertArrayHasKey('descricao', $dados);
    }

    public function testListarProdutoPaginadoAPI()
    {
        $this->client->request('GET', '/produto/api/listar/paginado/1');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }

    /**
     * @depends testInserirProdutoAPI
     */
    public function testApagarProdutoAPI(int $id)
    {
        $this->client->request('DELETE', '/produto/api/apagar/'.$id, array('seqProduto'=>$id));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertTrue((boolean)$this->client->getResponse()->getContent());
    }

    public function testListarProdutoAPI()
    {
        $this->client->request('GET', '/produto/api/listar/json');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "HTTP status code nao confere");
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $c = count(json_decode($this->client->getResponse()->getContent(), true));
        if ($c > 0) {
            $this->assertArrayHasKey('id', json_decode($this->client->getResponse()->getContent(), true)[$c-1]);
            $this->assertArrayHasKey('descricao', json_decode($this->client->getResponse()->getContent(), true)[$c-1]);
        }
    }

    public function tearDown()
    {
        unset($this->client);
    }
}
