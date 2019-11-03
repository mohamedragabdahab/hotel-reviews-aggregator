<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ReviewRepository extends EntityRepository
{
    public function getScoreAverage(int $hotelId)
    {
        return $this->createQueryBuilder('review')
            ->select('ROUND(AVG(review.score), 2) as scoreAverage')
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

    public function getReviewByHotelId(int $hotelId)
    {
        return $this->createQueryBuilder('review')
            ->select()
            ->where('review.hotelId = :hotel_id')
            ->setParameter('hotel_id', $hotelId)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}