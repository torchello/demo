<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Entity\UserInfo;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadUser1($manager);
        $this->loadUser2($manager);
        $this->loadUser3($manager);

        $manager->flush();
    }

    protected function loadUser1(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('alex@gmail.com');
        $user->setPassword('password');
        $user->setRegDate(new \DateTime());
        $user->setRole('user');

        $user->addInfo(new UserInfo(UserInfo::ITEM_COUNTRY, 'Zimbabwe'));
        $user->addInfo(new UserInfo(UserInfo::ITEM_FIRST_NAME, 'Alex'));
        $user->addInfo(new UserInfo(UserInfo::ITEM_STATE, UserInfo::STATE_ACTIVE));

        $manager->persist($user);
    }

    protected function loadUser2(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@gmail.com');
        $user->setPassword('password');
        $user->setRegDate(new \DateTime());
        $user->setRole('admin');

        $user->addInfo(new UserInfo(UserInfo::ITEM_COUNTRY, 'China'));
        $user->addInfo(new UserInfo(UserInfo::ITEM_FIRST_NAME, 'Admin'));
        $user->addInfo(new UserInfo(UserInfo::ITEM_STATE, UserInfo::STATE_ACTIVE));

        $manager->persist($user);
    }

    protected function loadUser3(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('usern@gmail.com');
        $user->setPassword('password');
        $user->setRegDate(new \DateTime());
        $user->setRole('user');

        $user->addInfo(new UserInfo(UserInfo::ITEM_COUNTRY, 'Germany'));
        $user->addInfo(new UserInfo(UserInfo::ITEM_FIRST_NAME, 'John Doe'));
        $user->addInfo(new UserInfo(UserInfo::ITEM_STATE, UserInfo::STATE_INACTIVE));

        $manager->persist($user);
    }
}
