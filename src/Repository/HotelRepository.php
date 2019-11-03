<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class HotelRepository extends EntityRepository
{
    public function listAll()
    {
        return $this->createQueryBuilder('hotel')
            ->select()
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

    public function listChain(int $parentId)
    {
        return $this->createQueryBuilder('hotel')
            ->select()
            ->where('hotel.parentId = :parentId')
            ->setParameter('parentId', $parentId)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

    public function assignParent(int $hotelId, int $parentId)
    {
        return $this->createQueryBuilder('hotel')
            ->update()
            ->set('hotel.parentId', $parentId)
            ->where('hotel.id = :hotelId')
            ->setParameter('hotelId', $hotelId)
            ->getQuery()
            ->execute();
    }
}