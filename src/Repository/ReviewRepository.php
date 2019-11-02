<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ReviewRepository extends EntityRepository
{
    public function getScoreAverage($hotelId)
    {
        return $this->createQueryBuilder('review')
            ->select('avg(review.score) as score')
            ->where('review.hotelId = :hotel_id')
            ->setParameter('hotel_id', $hotelId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}