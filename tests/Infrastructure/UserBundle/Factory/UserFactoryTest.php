<?php

namespace Tests\Infrastructure\UserBundle\Repository;

use Infrastructure\UserBundle\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UserFactoryTest
 * @package Tests\Infrastructure\UserBundle\Repository
 */
class UserFactoryTest extends KernelTestCase
{
    /** @var  UserFactory */
    private $userFactory;

    protected function setUp()
    {
        self::bootKernel();
    }

    public function testFactory()
    {
        $this->userFactory = static::$kernel->getContainer()->get('user.factory.user');

        $createdUser = $this->userFactory->create('nameTest');

        self::assertEquals($createdUser->getName(), 'nameTest');
    }
}
