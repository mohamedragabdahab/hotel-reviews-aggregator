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
            ->getScoreAverage($hotelId);

        return new JsonResponse($average);
    }

    /**
     * @Route("/api/reviews", name="review_list")
     */
    public function listAction(Request $request): JsonResponse
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
}
