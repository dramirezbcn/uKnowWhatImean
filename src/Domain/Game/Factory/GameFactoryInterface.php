<?php

namespace Domain\Game\Factory;

use Domain\Game\Model\Game;
use Domain\User\Model\User;

/**
 * Interface GameFactoryInterface
 * @package Domain\Game\Factory
 */
interface GameFactoryInterface
{
    /**
     * @param User $firstUser
     * @param User $secondUser
     * @return Game
     */
    public function create(User $firstUser, User $secondUser): Game;
}
