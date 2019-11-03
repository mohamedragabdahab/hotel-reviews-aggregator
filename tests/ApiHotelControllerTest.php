<?php

namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiHotelControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testGetHotels()
    {
        $this->client->request('GET', '/v1/api/hotels');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin","rooms":150},{"id":2,"name":"Hotel Alexanderplatz-2","address":"Alexanderplatz 2, 10409, Berlin","rooms":150},{"id":3,"name":"Hotel Alexanderplatz-3","address":"Alexanderplatz 3, 10409, Berlin","rooms":150},{"id":4,"name":"Hotel Alexanderplatz-4","address":"Alexanderplatz 4, 10409, Berlin","rooms":150},{"id":5,"name":"Hotel Alexanderplatz-5","address":"Alexanderplatz 5, 10409, Berlin","rooms":150}]', $this->client->getResponse()->getContent());
    }

    public function testAssignParent()
    {
        $this->client->request('POST', '/v1/api/hotel/parent/assign?hotelId=2&parentId=1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testListChain()
    {
        $this->client->request('GET', '/v1/api/hotel/chain/list?parentId=1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":2,"name":"Hotel Alexanderplatz-2","address":"Alexanderplatz 2, 10409, Berlin","rooms":150},{"id":3,"name":"Hotel Alexanderplatz-3","address":"Alexanderplatz 3, 10409, Berlin","rooms":150},{"id":4,"name":"Hotel Alexanderplatz-4","address":"Alexanderplatz 4, 10409, Berlin","rooms":150},{"id":5,"name":"Hotel Alexanderplatz-5","address":"Alexanderplatz 5, 10409, Berlin","rooms":150}]', $this->client->getResponse()->getContent());
    }

    public function testNoListChain()
    {
        $this->client->request('GET', '/v1/api/hotel/chain/list?parentId=2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[]', $this->client->getResponse()->getContent());
    }

    public function testListChainException()
    {
        $this->expectException(\Exception::class);
        $this->client->request('GET', '/v1/api/hotel/chain/list?parentId=invalidValue');
    }
}
