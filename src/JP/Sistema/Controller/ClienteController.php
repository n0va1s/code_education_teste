<?php

namespace JP\Sistema\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use JP\Sistema\Service\ClienteService;
use JP\Sistema\Service\ArquivoService;

class ClienteController implements ControllerProviderInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function connect(Application $app)
    {
        $ctrl = $app['controllers_factory'];

        $app['cliente_service'] = function () {
            return new \JP\Sistema\Service\ClienteService($this->em);
        };
        //aplicacao
        $ctrl->get('/', function () use ($app) {
            return $app['twig']->render('cliente_inicio.twig');
        })->bind('indexCliente');

        $ctrl->get('/incluir', function () use ($app) {
            return $app['twig']->render('cliente_cadastro.twig', array('cliente'=>null));
        })->bind('incluirCliente');

        $ctrl->get('/alterar/{id}', function ($id) use ($app) {
            $cliente = $app['cliente_service']->findById($id);
            return $app['twig']->render('cliente_cadastro.twig', array('cliente'=>$cliente));
        })->bind('alterarCliente')
        ->assert('id', '\d+');

        $ctrl->post('/gravar', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $foto = $req->files->get('imgCliente');
            $resultado = $app['cliente_service']->save($dados, $foto);
            return $app['twig']->render('cliente_lista.twig', ['clientes'=>$app['cliente_service']->fetchall()]);
        })->bind('gravarCliente');

        $ctrl->get('/excluir/{id}', function ($id) use ($app) {
            $resultado = $app['cliente_service']->delete($id);
            return $app['twig']->render('cliente_lista.twig', ['clientes'=>$app['cliente_service']->fetchall()]);
        })->bind('excluirCliente')
        ->assert('id', '\d+');

        $ctrl->get('/listar/html', function () use ($app) {
            return $app['twig']->render('cliente_lista.twig', ['clientes'=>$app['cliente_service']->fetchall()]);
        })->bind('listarClienteHtml');

        $ctrl->get('/listar/paginado/{qtd}', function ($qtd) use ($app) {
            $clientes = $app['cliente_service']->fetchLimit($qtd);
            return $app->json($clientes);
        })->bind('listarClientePaginado')
        ->assert('id', '\d+')
        ->value('qtd', 5); //limite padrao;

        //api
        $ctrl->get('/api/listar/json', function () use ($app) {
            $clientes = $app['cliente_service']->fetchall();
            return $app->json($clientes);
        })->bind('listarClienteJson');

        $ctrl->get('/api/listar/{id}', function ($id) use ($app) {
            $clientes = $app['cliente_service']->findById($id);
            return $app->json($clientes);
        })->bind('listarClienteIdJson')
        ->assert('id', '\d+');

        $ctrl->post('/api/inserir', function (Request $req) use ($app) {
            $dados = $req->request->all();
            $clientes = $app['cliente_service']->save($dados);
            return $app->json($clientes);
        })->bind('inserirClienteJson');

        $ctrl->put('/api/atualizar/{id}', function (Request $req, $id) use ($app) {
            $dados = $req->request->all();
            $clientes = $app['cliente_service']->save($dados);
            return $app->json($clientes[$chave]);
        })->bind('atualizarClienteJson')
        ->assert('id', '\d+');

        $ctrl->delete('/api/apagar/{id}', function ($id) use ($app) {
            $clientes = $app['cliente_service']->delete($id);
            return $app->json($clientes[$id]);
        })->bind('apagarClienteJson')
        ->assert('id', '\d+');

        return $ctrl;
    }
}
