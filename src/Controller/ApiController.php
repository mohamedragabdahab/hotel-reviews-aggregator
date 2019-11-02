<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends Controller
{
    /**
     * @Route("/api/average", name="average")
     */
    public function getAverage(Request $request): JsonResponse
    {
        $hotelId = $request->get('hotelId');

        if (is_null($hotelId)) {
            throw new \Exception('Hotel not found.');
        }

        $average = $this->getDoctrine()
            ->getRepository('App:Review')
            ->getScoreAverage($hotelId);

        return new JsonResponse($average);
    }

    /**
     * @Route("/api/reviews", name="review_list")
     */
    public function getReviews(Request $request): JsonResponse
    {
        $hotelId = $request->get('hotelId');

        $reviewRepository = $this->getDoctrine()->getRepository('App:Review');

        if ($hotelId === null) {
            $reviews = $reviewRepository->listAllReviews();
        } else {
            $reviews = $reviewRepository->getReviewByHotelId($hotelId);
        }

        return new JsonResponse($reviews);
    }

    /**
     * @Route("/api/hotels", name="hotel_list")
     */
    public function getHotels(Request $request): JsonResponse
    {
        $hotelRepository = $this->getDoctrine()->getRepository('App:Hotel');

        $hotels = $hotelRepository->listAllHotels();

        return new JsonResponse($hotels);
    }
}
