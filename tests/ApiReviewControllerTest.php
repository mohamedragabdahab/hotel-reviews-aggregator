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

    /**
     * @dataProvider getReviewAverageDataProvider
     */
    public function testGetAverage($url, $expected)
    {
        $this->client->request('GET', $url);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($expected, $this->client->getResponse()->getContent());
    }

    public function getReviewAverageDataProvider()
    {
        return [
            ['/v1/api/reviews/average?hotelId=1', '{"scoreAverage":"6.25"}'],
            ['/v1/api/reviews/average?hotelId=2', '{"scoreAverage":"7.50"}']
        ];
    }

    public function testGetAverageBetween()
    {
        $this->client->request('GET', '/v1/api/reviews/average/between?hotelId=1&fromDate=2018-01-01&toDate=2020-01-01');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"scoreAverage":"6"}', $this->client->getResponse()->getContent());
    }

    public function testException()
    {
        $this->expectException(\Exception::class);
        $this->client->request('GET', '/v1/api/reviews/average');
    }

    /**
     * @dataProvider getReviewDataProvider
     */
    public function testGetReviews($url, $extected)
    {
        $this->client->request('GET', $url);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($extected, $this->client->getResponse()->getContent());
    }

    public function getReviewDataProvider()
    {
        return [
            ['/v1/api/hotel/reviews?hotelId=1', '[{"id":1,"hotelId":1,"text":"Very nice stay","score":10,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":2,"hotelId":1,"text":"Average","score":5,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":3,"hotelId":1,"text":"Very nice stay, I enjoyed it a lot.","score":9,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":4,"hotelId":1,"text":"Worst experience ever.","score":1,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}}]'],
            ['/v1/api/hotel/reviews?hotelId=2', '[{"id":5,"hotelId":2,"text":"The receptionist was not smiling.","score":5,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}},{"id":6,"hotelId":2,"text":"Very nice stay, the reception was really fast.","score":10,"createdAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"updatedAt":{"date":"2019-11-03 19:02:04.000000","timezone_type":3,"timezone":"Europe\/Berlin"}}]'],
            ['/v1/api/hotel/reviews?hotelId=3', '[]'],
        ];
    }

    public function testExceptionReviews()
    {
        $this->expectException(\Exception::class);
        $this->client->request('GET', '/v1/api/hotel/reviews?hotelId=invalidId');
    }
}
