<?php

namespace Domain\Game\Factory;

use Domain\Board\Model\Board;
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
     * @param Board $board
     * @return Game
     */
    public function create(User $firstUser, User $secondUser, Board $board): Game;
}
