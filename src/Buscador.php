<?php

namespace louigio04\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    /**
     * @var ClientInterface
     */
    private $httpClient;
    /**
     * @var Crawler
     */
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url, string $filtroCrawler): array
    {
        $resposta = $this->httpClient->request("GET", $url, ['verify' => false]);

        $html = $resposta->getBody()->getContents();
        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter($filtroCrawler);
        $cursos = [];

        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }
}
