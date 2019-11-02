<?php

namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetAverage()
    {
        $client = static::createClient();

        $client->request('GET', '/v1/api/average?hotelId=1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"score":"6.2500"}', $client->getResponse()->getContent());

        $client->request('GET', '/v1/api/average?hotelId=2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"score":"7.5000"}', $client->getResponse()->getContent());
    }

    public function testException()
    {
        $this->expectException(\Exception::class);
        $client = static::createClient();
        $client->request('GET', '/v1/api/average');
    }


    public function testGetReviews()
    {
        $client = static::createClient();

        $client->request('GET', '/v1/api/reviews?hotelId=1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"hotelId":1,"text":"Very nice stay","score":10},{"id":2,"hotelId":1,"text":"Average","score":5},{"id":3,"hotelId":1,"text":"Very nice stay, I enjoyed it a lot.","score":9},{"id":4,"hotelId":1,"text":"Worst experience ever.","score":1}]', $client->getResponse()->getContent());

        $client->request('GET', '/v1/api/reviews?hotelId=2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":5,"hotelId":2,"text":"The receptionist was not smiling.","score":5},{"id":6,"hotelId":2,"text":"Very nice stay, the reception was really fast.","score":10}]', $client->getResponse()->getContent());
    }

    public function testGetHotels()
    {
        $client = static::createClient();

        $client->request('GET', '/v1/api/hotels');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":2,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":3,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":4,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":5,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150}]', $client->getResponse()->getContent());
    }
}
