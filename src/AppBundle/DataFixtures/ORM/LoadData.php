<?php

namespace Fillin\ShopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Party;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $party1 = new Party();
        $party1->setTitle('Happy New Year');
        $party1->setDescription('Awesome! Join us. We have fun. Incredibly cool party.');
        $party1->setCity('Cherkasy');
        $party1->setGender('any');
        $party1->setCount(3);
        $party1->setDonate(250);

        $party2 = new Party();
        $party2->setTitle('Beautiful night');
        $party2->setDescription('Wow! it is We have fun. Unforgettable event. Waiting for you.');
        $party2->setCity('Kyiv');
        $party2->setGender('female');
        $party2->setCount(4);
        $party2->setDonate(125);

        $user1 = new User();
        $user1->setName('Pavel');
        $user1->setEmail('enterprise@gmail.com');
        $user1->setPhone('+380931866085');
        $user1->setGender('male');
        $user1->setParty($party1);

        $user2 = new User();
        $user2->setName('Olya');
        $user2->setEmail('goodolya@gmail.com');
        $user2->setPhone('+380967894463');
        $user2->setGender('female');
        $user2->setParty($party1);

        $user3 = new User();
        $user3->setName('Inna');
        $user3->setEmail('innasuper@gmail.com');
        $user3->setPhone('+380637893368');
        $user3->setGender('female');
        $user3->setParty($party2);

        $manager->persist($party1);
        $manager->persist($party2);
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);

        $manager->flush();
    }
}
