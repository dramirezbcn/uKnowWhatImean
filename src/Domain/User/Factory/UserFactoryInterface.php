<?php

namespace Domain\User\Factory;

use Domain\User\Model\User;

/**
 * Interface UserFactoryInterface
 * @package Domain\User\Factory
 */
interface UserFactoryInterface
{
    /**
     * @param string $name
     * @return User
     */
    public function create(string $name): User;
}
