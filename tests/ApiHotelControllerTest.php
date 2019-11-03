<?php

namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiHotelControllerTest extends WebTestCase
{
    public function testGetHotels()
    {
        $client = static::createClient();

        $client->request('GET', '/v1/api/hotels');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":2,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":3,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":4,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":5,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150}]', $client->getResponse()->getContent());
    }
}
