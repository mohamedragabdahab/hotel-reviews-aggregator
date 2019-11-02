<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends Controller
{
    /**
     * @Route("/api/average", name="average")
     */
    public function getAverage(Request $request)
    {
        $hotelId = $request->get('hotelId');

        if (is_null($hotelId)) {
            throw new \Exception('Hotel not found.');
        }

        $average = $this->getDoctrine()
            ->getRepository('App:Review')
            ->getScoreAverage($hotelId);

        return new Response($average['score']);
    }

    /**
     * @Route("/api/reviews", name="review_list")
     */
    public function getReviews(Request $request)
    {
        $hotelId = $request->get('hotelId');

        $reviewRepository = $this->getDoctrine()->getRepository('App:Review');

        if ($hotelId === null) {
            $reviews = $reviewRepository->findAll();
        } else {
            $reviews = $reviewRepository->findByHotelId($hotelId);
        }

        return new Response(json_encode($reviews));
    }

    /**
     * @Route("/api/hotels", name="hotel_list")
     */
    public function getHotels(Request $request)
    {
        $hotelRepository = $this->getDoctrine()->getRepository('App:Hotel');

        $hotels = $hotelRepository->findAll();

        return new Response(json_encode($hotels));
    }
}
