<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$resposta = $client->request("GET","https://www.alura.com.br/cursos-online-back-end/php", ['verify'=> false]);

$html = $resposta->getBody()->getContents();

$crawler = new Crawler();
$crawler->addHtmlContent($html);

$cursos = $crawler->filter('h3.line-clamp-2');

foreach ($cursos as $curso) {
    echo $curso->textContent . PHP_EOL;
}