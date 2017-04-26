<?php

namespace Tests\Application\UseCase\User;

use Application\UseCase\User\Request\CreateUserRequest;
use Application\UseCase\User\UserCommand;
use Domain\User\Model\User;
use Infrastructure\UserBundle\Factory\UserFactory;
use Infrastructure\UserBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserCommandTest extends KernelTestCase
{
    /** @var  UserCommand */
    private $userCommand;

    /** @var User $userMock */
    private $userMock;

    /** @var UserFactory $userFactoryMock */
    private $userFactoryMock;

    /** @var UserRepository $userRepositoryMock */
    private $userRepositoryMock;

    protected function setUp()
    {
        self::bootKernel();

        $this->userMock = \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn('nameTest')
            ->getMock();

        $this->userFactoryMock = \Mockery::mock(UserFactory::class)
            ->shouldReceive('create')
            ->andReturn($this->userMock)
            ->getMock();

        $this->userRepositoryMock = \Mockery::mock(UserRepository::class)
            ->shouldReceive('store')
            ->andReturn($this->userMock)
            ->shouldReceive('delete')
            ->andReturn(true)
            ->getMock();
    }

    public function testCommandCreate()
    {
        $this->userCommand = new UserCommand($this->userFactoryMock, $this->userRepositoryMock);

        $createUserRequest = new CreateUserRequest('nameTest');

        $storedUser = $this->userCommand->create($createUserRequest);

        self::assertEquals($createUserRequest->getName(), $storedUser->getName());
    }

    public function testCommandDelete()
    {
        $this->userCommand = new UserCommand($this->userFactoryMock, $this->userRepositoryMock);

        $deleted = $this->userCommand->delete($this->userMock->getId());

        self::assertTrue($deleted);
    }
}
