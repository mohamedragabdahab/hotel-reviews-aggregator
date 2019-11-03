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
        $this->assertEquals('{"scoreAverage":"6.25"}', $this->client->getResponse()->getContent());

        $this->client->request('GET', '/v1/api/reviews/average?hotelId=2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"scoreAverage":"7.50"}', $this->client->getResponse()->getContent());
    }

    public function testException()
    {
        $this->expectException(\Exception::class);
        $this->client->request('GET', '/v1/api/reviews/average');
    }

    public function testGetReviews()
    {
        $this->client->request('GET', '/v1/api/hotel/reviews?hotelId=1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"hotelId":1,"text":"Very nice stay","score":10,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":2,"hotelId":1,"text":"Average","score":5,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":3,"hotelId":1,"text":"Very nice stay, I enjoyed it a lot.","score":9,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":4,"hotelId":1,"text":"Worst experience ever.","score":1,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}}]', $this->client->getResponse()->getContent());

        $this->client->request('GET', '/v1/api/hotel/reviews?hotelId=2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":5,"hotelId":2,"text":"The receptionist was not smiling.","score":5,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":6,"hotelId":2,"text":"Very nice stay, the reception was really fast.","score":10,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}}]', $this->client->getResponse()->getContent());
    }

    public function testEmptyReviews()
    {
        $this->client->request('GET', '/v1/api/hotel/reviews?hotelId=3');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[]', $this->client->getResponse()->getContent());
    }

    public function testExceptionReviews()
    {
        $this->expectException(\Exception::class);
        $this->client->request('GET', '/v1/api/hotel/reviews?hotelId=invalidId');
    }
}
