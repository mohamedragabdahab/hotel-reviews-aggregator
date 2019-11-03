<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadHotels($manager);
        $this->loadReviews($manager);
        $manager->flush();
    }

    public function loadHotels($manager)
    {
        $hotel = new Hotel();
        $hotel->setId(1);
        $hotel->setName('Hotel Alexanderplatz');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');
        $hotel->setRooms(150);
        $hotel->setParentId(null);
        $manager->persist($hotel);

        $hotel2 = new Hotel();
        $hotel2->setId(2);
        $hotel2->setName('Hotel Alexanderplatz-2');
        $hotel2->setAddress('Alexanderplatz 2, 10409, Berlin');
        $hotel2->setRooms(150);
        $hotel2->setParentId($hotel);
        $manager->persist($hotel2);

        $hotel3 = new Hotel();
        $hotel3->setId(3);
        $hotel3->setName('Hotel Alexanderplatz-3');
        $hotel3->setAddress('Alexanderplatz 3, 10409, Berlin');
        $hotel3->setRooms(150);
        $hotel3->setParentId($hotel);
        $manager->persist($hotel3);

        $hotel4 = new Hotel();
        $hotel4->setId(4);
        $hotel4->setName('Hotel Alexanderplatz-4');
        $hotel4->setAddress('Alexanderplatz 4, 10409, Berlin');
        $hotel4->setRooms(150);
        $hotel4->setParentId($hotel);
        $manager->persist($hotel4);

        $hotel5 = new Hotel();
        $hotel5->setId(5);
        $hotel5->setName('Hotel Alexanderplatz-5');
        $hotel5->setAddress('Alexanderplatz 5, 10409, Berlin');
        $hotel5->setRooms(150);
        $hotel5->setParentId($hotel);
        $manager->persist($hotel5);
    }

    public function loadReviews($manager)
    {
        // hotel 1
        $review = new Review();
        $review->setHotelId(1);
        $review->setText('Very nice stay');
        $review->setScore(10);
        $manager->persist($review);

        $review = new Review();
        $review->setHotelId(1);
        $review->setText('Average');
        $review->setScore(5);
        $manager->persist($review);

        $review = new Review();
        $review->setHotelId(1);
        $review->setText('Very nice stay, I enjoyed it a lot.');
        $review->setScore(9);
        $manager->persist($review);

        $review = new Review();
        $review->setHotelId(1);
        $review->setText('Worst experience ever.');
        $review->setScore(1);
        $manager->persist($review);

        // hotel 2
        $review = new Review();
        $review->setHotelId(2);
        $review->setText('The receptionist was not smiling.');
        $review->setScore(5);
        $manager->persist($review);

        $review = new Review();
        $review->setHotelId(2);
        $review->setText('Very nice stay, the reception was really fast.');
        $review->setScore(10);
        $manager->persist($review);
    }
}
