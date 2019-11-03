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

        $hotels = $hotelRepository->listAll();

        return new JsonResponse($hotels);
    }

    /**
     * @Route("/api/hotel/parent/assign", name="hotel_parent_assing")
     */
    public function assignParent(Request $request)
    {
        $hotelId = $request->get('hotelId');
        $parentId = $request->get('parentId');

        $hotelRepository = $this->getDoctrine()->getRepository('App:Hotel');

        $hotels = $hotelRepository->assignParent($hotelId, $parentId);

        return new JsonResponse($hotels);
    }

    /**
     * @Route("/api/hotel/chain/list", name="hotel_parent_assing")
     */
    public function listChain(Request $request)
    {
        $parentId = $request->get('parentId');

        if (!is_numeric($parentId)) {
            throw new \Exception('Invalid parentId.');
        }

        $hotelRepository = $this->getDoctrine()->getRepository('App:Hotel');

        $chainedHotels = $hotelRepository->listChain($parentId);

        return new JsonResponse($chainedHotels);
    }
}
