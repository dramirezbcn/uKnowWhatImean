<?php

namespace Tests\Infrastructure\UserBundle\Repository;

use Domain\User\Model\User;
use Infrastructure\UserBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /** @var  UserRepository */
    private $userRepository;

    /** @var User $user */
    private $user;

    protected function setUp()
    {
        self::bootKernel();
        $this->userRepository = static::$kernel->getContainer()->get('user.repository.user');

        $this->user = \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn('nameTest')
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();
    }

    public function testRepositoryStore()
    {
        $storedUser = $this->userRepository->store($this->user);

        self::assertEquals($this->user->getName(), $storedUser->getName());
    }

    public function testRepositoryDelete()
    {
        $deleted = $this->userRepository->delete($this->user);

        self::assertTrue($deleted);
    }

    public function testRepositoryGetUser()
    {
        $user = $this->userRepository->getUser($this->user->getId());

        self::assertEquals($this->user->getName(), $user->getName());
    }
}
