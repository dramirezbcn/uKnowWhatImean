<?php

namespace Tests\Application\UseCase\User;

use Application\UseCase\User\Request\CreateUserRequest;
use Application\UseCase\User\UserCommand;
use Application\UseCase\User\UserQuery;
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

    /** @var UserQuery $userQueryMock */
    private $userQueryMock;

    protected function setUp()
    {
        self::bootKernel();

        $this->userMock = \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn('nameTest')
            ->shouldReceive('getId')
            ->andReturn(1)
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

        $this->userQueryMock = \Mockery::mock(UserQuery::class)
            ->shouldReceive('getUser')
            ->andReturn($this->userMock)
            ->getMock();

        $this->userCommand = new UserCommand($this->userFactoryMock, $this->userRepositoryMock, $this->userQueryMock);
    }

    public function testCommandCreate()
    {
        $createUserRequest = new CreateUserRequest('nameTest');

        $storedUser = $this->userCommand->create($createUserRequest);

        self::assertEquals($createUserRequest->getName(), $storedUser->getName());
    }

    public function testCommandDelete()
    {
        $deleted = $this->userCommand->delete($this->userMock->getId());

        self::assertTrue($deleted);
    }
}
