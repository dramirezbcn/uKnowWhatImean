<?php

namespace Tests\Infrastructure\UserBundle\Repository;

use Domain\User\Model\User;
use Infrastructure\UserBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /** @var  UserRepository */
    private $userRepository;

    protected function setUp()
    {
        self::bootKernel();
        $this->userRepository = static::$kernel->getContainer()->get('user.repository.user');
    }

    public function testRepositoryStore()
    {
        $user = new User('userNameTest');
        $storedUser = $this->userRepository->store($user);

        self::assertEquals($user->getName(), $storedUser->getName());
    }

    public function testRepositoryGetUser()
    {
        $user = new User('userNameTest');
        $storedUser = $this->userRepository->store($user);

        $userDb = $this->userRepository->getUser($storedUser->getId());

        self::assertEquals($userDb, $user);
    }

    public function testRepositoryDelete()
    {
        $user = new User('userNameTest');
        $storedUser = $this->userRepository->store($user);
        $storedUserId = $storedUser->getId();

        $this->userRepository->remove($storedUser);

        $userDb = $this->userRepository->getUser($storedUserId);

        self::assertNull($userDb);
    }
}
