<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Test extends WebTestCase
{
    public function testView()
    {
        $client = self::createClient();

        $client->request('GET', '/');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSubmit()
    {
        $client = self::createClient();

        $client->request('POST', '/', [
            'main_form' => [
                'company' => 'AAPL',
                'startDate' => '2020-11-01',
                'endDate' => '2020-11-02',
                'email' => 'email@example.net',
            ],
        ]);

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
