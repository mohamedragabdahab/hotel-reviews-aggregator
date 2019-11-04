<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiReviewController extends AbstractController
{
    /**
     * @Route("/api/reviews/average", name="reviews_average")
     */
    public function getAverageAction(Request $request): JsonResponse
    {
        $hotelId = $request->get('hotelId');

        if (!is_numeric($hotelId)) {
            throw new \Exception('Hotel not found.');
        }

        $average = $this->getDoctrine()
            ->getRepository('App:Review')
            ->getScoreAverage($hotelId, 2);

        return new JsonResponse($average);
    }

    /**
     * @Route("/api/reviews/average/between", name="reviews_average_between")
     */
    public function getAverageBetweenAction(Request $request): JsonResponse
    {
        $hotelId = $request->get('hotelId');
        $fromDate = \DateTime::createFromFormat('Y-m-d', $request->get('fromDate'));
        $toDate = \DateTime::createFromFormat('Y-m-d', $request->get('toDate'));

        if ($fromDate == false || $toDate == false) {
            throw new \Exception('Invalid datetime format, must be (Y-m-d)');
        }

        if (!is_numeric($hotelId)) {
            throw new \Exception('Hotel not found.');
        }

        $average = $this->getDoctrine()
            ->getRepository('App:Review')
            ->getScoreAverageBetween($hotelId, $fromDate, $toDate);

        return new JsonResponse($average);
    }

    /**
     * @Route("/api/hotel/reviews", name="hotel_reviews")
     */
    public function getReviewsAction(Request $request): JsonResponse
    {
        $hotelId = $request->get('hotelId');

        if (!is_numeric($hotelId)) {
            throw new \Exception('Hotel not found.');
        }

        $reviewRepository = $this->getDoctrine()->getRepository('App:Review');

        $reviews = $reviewRepository->getReviewByHotelId($hotelId);

        return new JsonResponse($reviews);
    }
}
