<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\{Url, Statistic};
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(
            1,
            $crawler->filter('body #main #url_initialUrl')->count(),
            'The homepage displays url form'
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        //TODO: implement tests
    }

    public function testCreateUrl()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $urlData = ['initialUrl' => 'http://google.com', 'urlExpireDate' =>'2028-05-26'];
        $form = $crawler->selectButton('Short url')->form([
            'category[initialUrl]' => $urlData['initialUrl'],
            'category[url]' => $urlData['urlExpireDate'],
        ]);
        $client->submit($form);

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('body #main .alert-success')->count(),
            'The url has been shortened successfully'
        );

        $url = $client->getContainer()->get('doctrine')->getRepository(Url::class)->findOneBy(['id' => 1]);
        $this->assertNotNull($url);
        $this->assertSame($urlData['initialUrl'], $url->getInitialUrl());
    }

    /**
     * @depends testCreateUrl
     */
    public function testRedirect()
    {
        $client = static::createClient();

        $doctrine = $client->getContainer()->get('doctrine');
        $url = $doctrine->getRepository(Url::class)->findOneBy(['id' => 1]);
        $client->request('GET', '/' .  $url->getShortUrl());

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
        $statistic = $doctrine->getRepository(Statistic::class)->findOneBy(['id' => 1]);
        $this->assertNotNull($statistic);
    }

    /**
     * @depends testRedirect
     */
    public function testShowStatistic()
    {
        $client = static::createClient();

        $url = $client->getContainer()->get('doctrine')->getRepository(Url::class)->findOneBy(['id' => 1]);
        $crawler = $client->request('GET', '/' . $url->getShortUrl() . '/info/' );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('body #main .url-statistics')->count(),
            'The url statistic has been created'
        );

    }
}
