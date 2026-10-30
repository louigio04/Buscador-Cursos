#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use louigio04\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-back-end/php', 'h3.line-clamp-2');

foreach ($cursos as $curso) {
    echo $curso . PHP_EOL;
}
