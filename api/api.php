<?php

require_once './database/index.php';

use \Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

function setupAPI(\Slim\App $app, array $options) {
  $timezone = array_key_exists('timezone', $options) ? $options['timezone'] : new DateTimeZone('America/Belem');

  $app->get('/', function (Request $req, Response $res) {
    $data = array('error' => false, 'data' => false);
    $jsonRes = $res->withJson($data);
    return $jsonRes;
  });

  $app->get('/auth', function (Request $req, Response $res) {
    $ad = new \Adldap\Adldap();
    $hosts = ['abacate','abacate.seop.local','10.40.2.1'];
    $dn = 'DC=SEOP,DC=LOCAL';
    if (!$req->hasHeader('Authorization') || !$req->hasHeader('Domain')) {
      return $res->withJson(['error' => true, 'message' => 'missing header'], 400);
    }
    $domain = $req->getHeader('Domain')[0];
    $auth = $req->getHeader('Authorization');
    $validAuthorizationHeader = preg_match('/^Basic\s(.+)$/', $auth[0], $matches) && count($matches) == 2;
    if (!$validAuthorizationHeader) {
      return $res->withJson(['error' => true, 'message' => 'invalid header'], 400);
    }
    try {
      $credentials = base64_decode($matches[1]);
      $credentialsParts = explode(':', $credentials);
    } catch (Exception $e) {
      return $res->withJson(['error' => true, 'message' => 'malformed authorization header'], 400);
    }
    if (count($credentialsParts) != 2) {
      return $res->withJson(['error' => true, 'message' => 'malformed auth header'], 400);
    }
    $usr = $credentialsParts[0];
    $pass = $credentialsParts[1];
    $ad->addProvider([
      'hosts' => $hosts,
      'base_dn' => $dn,
      'username' => $usr . '@' . $domain,
      'password' => $pass
    ]);
    try {
      $provider = $ad->connect();
      $account = $ad->search()
        ->findBy('samaccountname', $usr);
      $key = 'donttellanyoneaboutthis';
      $token = [
        'iss' => 'http://devserver/ponto',
        'aud' => 'http://devserver/',
        'iat' => (new DateTime())->getTimestamp(),
        'nbf' => (new DateTime())->getTimestamp(),
        'name' => $account->getDisplayName(),
        'email' => $account->getEmail(),
        'user' => $account->getUserPrincipalName()
      ];
      $jwt = JWT::encode($token, $key, 'HS256'); // TODO: change to private key with RS256
      return $res->withJson(['error' => false, 'data' => $jwt], 200);
    } catch (\Adldap\Auth\BindException $e) {
      return $res->withJson(['error'=> true, 'message'=> 'wrong credentials'], 401);
    } catch (\Adldap\Models\ModelNotFoundException $e) {
      return $res->withJson(['error' => true, 'message' => 'profile not found'], 404);
    }
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
