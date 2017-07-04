<?php

namespace Ko\ProjectBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectAffichageControllerTest extends WebTestCase
{
    public function testListe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/liste');
    }

}
