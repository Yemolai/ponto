<?php

require_once './database/index.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

function setupAPI(\Slim\App $app, array $options) {
  $timezone = array_key_exists('timezone', $options) ? $options['timezone'] : new DateTimeZone('America/Belem');

  $app->get('/', function (Request $req, Response $res) {
    $data = array('error' => false, 'data' => false);
    $jsonRes = $res->withJson($data);
    return $jsonRes;
  });

  $app->get('/marcacoes', function (Request $req, Response $res) {
    $data = [];
    $marcacoes = MarcacoesQuery::create()->find();
    foreach ($marcacoes as $key => $marcacao) {
      array_push($data, array(
        'nsr'=> $marcacao->getPonto() . '-' . $marcacao->getNsr(),
        'datetime'=> $marcacao->getDatetime()->modify('-3 hours')->format('Y-m-dTH:i:s-03:00'),
      ));
    }
    return $res->withJson($data);
  });

  $app->get('/marcacoes/pis/{pis}', function (Request $req, Response $res, $args) {
    $pis = $args['pis'];
    $marcacoes = MarcacoesQuery::create()
      ->filterByPis($pis)
      ->filterByMonth(null, null, array('tz' => 'America/Belem'))
      ->toDayGroupMatrix(false, -3);
    return $res->withJson($marcacoes);
  });

  $app->get('/marcacoes/pis/{pis}/{month}', function (Request $req, Response $res, $args) {
    $pis = $args['pis'];
    $month = $args['month'];
    $marcacoes = MarcacoesQuery::create()
      ->filterByPis($pis)
      ->filterByMonth($month, null, array('tz' => 'America/Belem'))
      ->toDayGroupMatrix(false, -3);
    return $res->withJson($marcacoes);
  });

  $app->get('/marcacoes/pis/{pis}/{year}/{month}', function (Request $req, Response $res, $args) {
    $pis = $args['pis'];
    $year = $args['year'];
    $month = $args['month'];

    $query = MarcacoesQuery::create();
    $filtered = $query->filterByPis($pis);
    $monthly = $filtered->filterByMonth($month, $year, array('tz' => 'America/Belem'));
    $marcacoes = $monthly->toDayGroupMatrix(false, -3);
    return $res->withJson($marcacoes);
  });

  return $app;
}