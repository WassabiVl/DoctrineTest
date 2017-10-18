<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 18/10/2017
 * Time: 13:15
 */

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class F0sUserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->container->get('fos_user.user_manager');
        for ($i = 0; $i < 20; $i++) {
        // Create our user and set details
        $user = $userManager->createUser();
        $user->setUsername('username'.$i);
        $user->setEmail('email'.$i.'@domain.com');
        $user->setPlainPassword('password');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));

        // Update the user
        $userManager->updateUser($user, true);
        }
    }
}