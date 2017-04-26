<?php

namespace Infrastructure\GameBundle\Factory;

use Domain\Game\Factory\GameFactoryInterface;
use Domain\Game\Model\Game;
use Domain\User\Model\User;

/**
 * Class GameFactory
 * @package Infrastructure\GameBundle\Factory
 */
class GameFactory implements GameFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(User $firstUser, User $secondUser): Game
    {
        return new Game($firstUser, $secondUser);
    }
}