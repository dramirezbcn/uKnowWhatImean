<?php

namespace Tests\Application\UseCase\User;

use Application\UseCase\User\Request\CreateUserRequest;
use Application\UseCase\User\UserCommand;
use Application\UseCase\User\UserQuery;
use Domain\User\Exception\UserNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserCommandTest extends KernelTestCase
{
    /** @var  UserCommand */
    private $userCommand;

    /** @var  UserQuery */
    private $userQuery;

    protected function setUp()
    {
        self::bootKernel();

        $this->userCommand = static::$kernel->getContainer()->get('user.use_case.user_command');
        $this->userQuery = static::$kernel->getContainer()->get('user.use_case.user_query');
    }

    public function testCommandCreate()
    {
        $createUserRequest = new CreateUserRequest('nameTest');

        $storedUser = $this->userCommand->create($createUserRequest);

        self::assertInternalType('int', $storedUser->getId());
        self::assertEquals($createUserRequest->getName(), $storedUser->getName());
    }

    public function testCommandDelete()
    {
        $this->expectException(UserNotFoundException::class);

        $createUserRequest = new CreateUserRequest('nameTest');

        $storedUser = $this->userCommand->create($createUserRequest);
        $storedUserId = $storedUser->getId();

        $this->userCommand->delete($storedUserId);

        $this->userQuery->getUser($storedUserId);
    }
}
