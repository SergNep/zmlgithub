<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// подключаем автозагрузчик composer-а
require __DIR__ . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

class Somm
{
    public $info = 1;
}

$obj = new Somm;

if (isset($obj->info22)) {
    echo $obj->info22;
}


die;

// создаём клиент библиотеки elasticsearch для выполнения запросов
$client = ClientBuilder::create()
    ->setHosts(['localhost:9200']) // указываем, в виде массива, хост и порт сервера elasticsearch
    ->build();



$params = array();
$params['body']  = array(
  'name' => 'Misty',
  'age' => 13,
  'badges' => 0,
  'pokemon' => array(
    'psyduck' => array(
      'type' => 'water',
      'moves' => array(
        'Water Gun' => array(
          'pp' => 6611,
          'power' => 6611
        )
      )
    )
  )
);

$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';
$params['id']  = 'ababagalamaga';
$result = $client->index($params);



//echo "<pre>";
//var_dump($result);
//echo "</pre>";


//die;

///////////////////////////////////////

//$params = array();
//$params['index'] = 'pokemon';
//$params['type'] = 'pokemon_trainer';
//$params['id'] = 'aqjwpG8Btu0cSusLUdLu';
//
//$result = $client->get($params);
//
//
//echo '<pre>', print_r($result, true), '</pre>'; die;

///////////////////////////////////////


$data = $client->search([
    'index' => 'pokemon',
    'type' => 'pokemon_trainer',
    'size' => '50',
    'body' => [
        'query' => [
            'match' => [
                'name' => 'Misty'
            ]
        ]
    ]
]);

echo '<pre>', print_r($data, true), '</pre>';




