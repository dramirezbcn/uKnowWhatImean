<?php

namespace Infrastructure\UserBundle\Factory;

use Domain\User\Factory\UserFactoryInterface;
use Domain\User\Model\User;

/**
 * Class UserFactory
 * @package Infrastructure\UserBundle\Factory
 */
class UserFactory implements UserFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(string $name): User
    {
        return \Mockery::mock(User::class)
            ->shouldReceive('getName')
            ->andReturn($name)
            ->shouldReceive('getId')
            ->andReturn(1)
            ->getMock();
    }
}