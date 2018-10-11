<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Travel;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $user1 = new User();
        $user1 -> setEmail('Kodackblack@gmail.com');
        $user1 -> setPassword('orangeisthenewblack');
        $user1 ->setFirstname('Octave');
        $user1->setLastname('Dieuson');
        $manager->persist($user1);

        $user2 = new User();
        $user2 -> setEmail('50cent@gmail.com');
        $user2 -> setPassword('candyshop');
        $user2 -> setFirstname('James Jackson');
        $user2 ->setLastname('Curtis');
        $manager->persist($user2);

        $user3 = new User();
        $user3 -> setEmail('Kodackblack@gmail.com');
        $user3 -> setPassword('orangeisthenewblack');
        $user3 ->setFirstname('Octave');
        $user3->setLastname('Dieuson');
        $manager->persist($user3);

        $user4 = new User();
        $user4 -> setEmail('Kodackblack@gmail.com');
        $user4 -> setPassword('orangeisthenewblack');
        $user4 ->setFirstname('Octave');
        $user4->setLastname('Dieuson');
        $manager->persist($user4);

        $user5 = new User();
        $user5 -> setEmail('Kodackblack@gmail.com');
        $user5 -> setPassword('orangeisthenewblack');
        $user5 ->setFirstname('Octave');
        $user5->setLastname('Dieuson');
        $manager->persist($user5);

        $user6 = new User();
        $user6 -> setEmail('Kodackblack@gmail.com');
        $user6 -> setPassword('orangeisthenewblack');
        $user6 ->setFirstname('Octave');
        $user6->setLastname('Dieuson');
        $manager->persist($user6);

         $usa = new Travel();
         $usa -> setCountry('United States');
         $usa -> setClimate('Hot');
         $usa -> setCity('las vegas');
        $usa ->setSeason('Summer');
        $usa->setUser($user1);
        $usa ->setPrice('1140');
        $usa ->setPicture('/img/lasvegas.jpg');
        $usa ->setPicturetwo('/img/lasvegastwo.jpg');
         $manager->persist($usa);

        $Canada = new Travel();
        $Canada -> setCountry('Canada');
        $Canada -> setClimate('Cold');
        $Canada -> setCity('toronto');
        $Canada ->setSeason('Winter');
        $Canada ->setPrice('850');
        $Canada->setUser($user1);
        $Canada ->setPicture('/img/canada.jpg');
        $Canada ->setPicturetwo('/img/canadatwo.jpg');
        $manager->persist($Canada);

        $guadalajara = new Travel();
        $guadalajara -> setCountry('Mexico');
        $guadalajara -> setClimate('hot');
        $guadalajara -> setCity('guadalajara');
        $guadalajara ->setSeason('spring');
        $guadalajara ->setPrice('650');
        $guadalajara->setUser($user1);
        $guadalajara ->setPicture('/img/guadalajara.jpg');
        $guadalajara ->setPicturetwo('/img/guadalajaratwo.jpg');
        $manager->persist($guadalajara);

        $london = new Travel();
        $london -> setCountry('England');
        $london -> setClimate('cold');
        $london -> setCity('london');
        $london ->setSeason('Autumn');
        $london ->setPrice('15400');
        $london->setUser($user2);
        $london ->setPicture('/img/london.jpg');
        $london ->setPicturetwo('/img/londontwo.jpg');
        $manager->persist($london);

        $Australia = new Travel();
        $Australia -> setCountry('Australia');
        $Australia -> setClimate('hot');
        $Australia -> setCity('sydney');
        $Australia ->setSeason('summer');
        $Australia ->setPrice('18000');
        $Australia->setUser($user2);
        $Australia ->setPicture('/img/australia.jpg');
        $Australia ->setPicturetwo('/img/australiatwo.jpg');
        $manager->persist($Australia);

        $Pekin = new Travel();
        $Pekin -> setCountry('China');
        $Pekin -> setClimate('Tempered');
        $Pekin -> setCity('pekin');
        $Pekin ->setSeason('Autumn');
        $Pekin ->setPrice('13000');
        $Pekin->setUser($user2);
        $Pekin ->setPicture('/img/pekin.jpg');
        $Pekin ->setPicturetwo('/img/pekintwo.jpg');
        $manager->persist($Pekin);

        $manager->flush();
    }
}
