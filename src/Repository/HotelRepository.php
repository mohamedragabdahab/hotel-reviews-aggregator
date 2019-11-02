<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class HotelRepository extends EntityRepository
{
    public function listAllHotels()
    {
        return $this->createQueryBuilder('hotel')
            ->select()
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}