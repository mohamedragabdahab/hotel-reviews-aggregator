<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiHotelController extends AbstractController
{
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
