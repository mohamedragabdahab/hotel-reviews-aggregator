<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ReviewRepository extends EntityRepository
{
    public function getScoreAverage(int $hotelId, int $rounding = 0)
    {
        return $this->createQueryBuilder('review')
            ->select("ROUND(AVG(review.score), $rounding) as scoreAverage")
            ->where('review.hotelId = :hotelId')
            ->setParameter('hotelId', $hotelId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getScoreAverageBetween(int $hotelId, \DateTime $from, \DateTime $to, int $rounding = 0)
    {
        return $this->createQueryBuilder('review')
            ->select("ROUND(AVG(review.score), $rounding) as scoreAverage")
            ->where('review.hotelId = :hotelId')
            ->andWhere('review.createdAt >= :from')
            ->andWhere('review.createdAt <= :to')
            ->setParameter('hotelId', $hotelId)
            ->setParameter('from', $from->format('Y-m-d'))
            ->setParameter('to', $to->format('Y-m-d'))
            ->getQuery()
            ->getOneOrNullResult();
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