<?php

namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiReviewControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testGetAverage()
    {
        $this->client->request('GET', '/v1/api/reviews/average?hotelId=1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"score":"6.2500"}', $this->client->getResponse()->getContent());

        $this->client->request('GET', '/v1/api/reviews/average?hotelId=2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"score":"7.5000"}', $this->client->getResponse()->getContent());
    }

    public function testException()
    {
        $this->expectException(\Exception::class);
        $this->client->request('GET', '/v1/api/reviews/average');
    }

    public function testGetReviews()
    {
        $this->client->request('GET', '/v1/api/reviews?hotelId=1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"hotelId":1,"text":"Very nice stay","score":10},{"id":2,"hotelId":1,"text":"Average","score":5},{"id":3,"hotelId":1,"text":"Very nice stay, I enjoyed it a lot.","score":9},{"id":4,"hotelId":1,"text":"Worst experience ever.","score":1}]', $this->client->getResponse()->getContent());

        $this->client->request('GET', '/v1/api/reviews?hotelId=2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":5,"hotelId":2,"text":"The receptionist was not smiling.","score":5},{"id":6,"hotelId":2,"text":"Very nice stay, the reception was really fast.","score":10}]', $this->client->getResponse()->getContent());
    }
}
