<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ReviewRepository extends EntityRepository
{
    public function getScoreAverage($hotelId)
    {
        return $this->createQueryBuilder('review')
            ->select('avg(review.score) as score')
            ->where('review.hotelId = :hotelId')
            ->setParameter('hotelId', $hotelId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function listAllReviews()
    {
        return $this->createQueryBuilder('review')
            ->select()
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

    public function getReviewByHotelId($hotelId)
    {
        return $this->createQueryBuilder('review')
            ->select()
            ->where('review.hotelId = :hotel_id')
            ->setParameter('hotel_id', $hotelId)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}