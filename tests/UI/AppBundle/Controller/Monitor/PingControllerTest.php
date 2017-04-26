<?php

namespace Tests\AppBundle\Controller\Monitor;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PingControllerTest
 * @package Tests\AppBundle\Controller\Monitor
 */
class PingControllerTest extends WebTestCase
{
    /**
     * @group unit
     */
    public function testPing()
    {
        $client = self::createClient();

        $client->request('GET', '/ping');

        $this->assertContains("pong", $client->getResponse()->getContent());

        $this->assertEquals("application/json", $client->getResponse()->headers->get('Content-Type'));
    }
}
